#!/usr/bin/env bash

set -Eeuo pipefail

readonly SCRIPT_DIR="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" && pwd)"
readonly BACKEND_DIR="${SCRIPT_DIR}/backend"
readonly ENV_FILE="${BACKEND_DIR}/.env"
readonly ENV_EXAMPLE_FILE="${BACKEND_DIR}/.env.example"
readonly MYSQL_MAX_ATTEMPTS="${MYSQL_MAX_ATTEMPTS:-60}"
readonly MYSQL_WAIT_SECONDS="${MYSQL_WAIT_SECONDS:-2}"

if [[ -t 1 && -z "${NO_COLOR:-}" ]]; then
    readonly COLOR_RED='\033[0;31m'
    readonly COLOR_GREEN='\033[0;32m'
    readonly COLOR_YELLOW='\033[1;33m'
    readonly COLOR_BLUE='\033[0;34m'
    readonly COLOR_RESET='\033[0m'
else
    readonly COLOR_RED=''
    readonly COLOR_GREEN=''
    readonly COLOR_YELLOW=''
    readonly COLOR_BLUE=''
    readonly COLOR_RESET=''
fi

log_info() {
    printf '%b[INFO]%b %s\n' "${COLOR_BLUE}" "${COLOR_RESET}" "$*"
}

log_success() {
    printf '%b[OK]%b %s\n' "${COLOR_GREEN}" "${COLOR_RESET}" "$*"
}

log_warn() {
    printf '%b[WARN]%b %s\n' "${COLOR_YELLOW}" "${COLOR_RESET}" "$*"
}

log_error() {
    printf '%b[ERROR]%b %s\n' "${COLOR_RED}" "${COLOR_RESET}" "$*" >&2
}

on_error() {
    local exit_code=$?
    local line_number="${1:-unknown}"

    log_error "Deployment gagal pada baris ${line_number} (exit code ${exit_code})."
    exit "${exit_code}"
}

trap 'on_error "$LINENO"' ERR

require_command() {
    if ! command -v "$1" >/dev/null 2>&1; then
        log_error "Command '$1' tidak ditemukan. Instal command tersebut sebelum menjalankan deployment."
        exit 1
    fi
}

generate_secret() {
    if command -v openssl >/dev/null 2>&1; then
        openssl rand -hex 24
    else
        head -c 48 /dev/urandom | od -An -tx1 | tr -d ' \n'
    fi
}

set_env_value() {
    local escaped_value
    local key="$1"
    local value="$2"

    escaped_value="${value//\\/\\\\}"
    escaped_value="${escaped_value//&/\\&}"
    escaped_value="${escaped_value//|/\\|}"

    if grep -qE "^[#[:space:]]*${key}=" "${ENV_FILE}"; then
        sed -i -E "s|^[#[:space:]]*${key}=.*$|${key}=${escaped_value}|" "${ENV_FILE}"
    else
        printf '%s=%s\n' "${key}" "${value}" >> "${ENV_FILE}"
    fi
}

read_env_value() {
    local key="$1"
    local first_character
    local last_character
    local value

    value="$(sed -n -E "s/^[[:space:]]*${key}=(.*)$/\1/p" "${ENV_FILE}" | tail -n 1)"
    value="${value%$'\r'}"

    if (( ${#value} >= 2 )); then
        first_character="${value:0:1}"
        last_character="${value: -1}"

        if [[ "${first_character}" == '"' && "${last_character}" == '"' ]] \
            || [[ "${first_character}" == "'" && "${last_character}" == "'" ]]; then
            value="${value:1:${#value}-2}"
        fi
    fi

    printf '%s' "${value}"
}

select_compose_command() {
    if docker compose version >/dev/null 2>&1; then
        COMPOSE_COMMAND=(docker compose)
    elif command -v docker-compose >/dev/null 2>&1; then
        COMPOSE_COMMAND=(docker-compose)
    else
        log_error "Docker Compose tidak ditemukan. Instal plugin 'docker compose' v2 atau binary 'docker-compose' v1."
        exit 1
    fi
}

compose() {
    "${COMPOSE_COMMAND[@]}" "$@"
}

update_repository() {
    local branch

    if [[ ! -d "${SCRIPT_DIR}/.git" ]]; then
        log_error "Direktori ${SCRIPT_DIR} bukan working tree Git."
        exit 1
    fi

    branch="$(git -C "${SCRIPT_DIR}" branch --show-current)"
    if [[ -z "${branch}" ]]; then
        log_error "HEAD sedang detached. Checkout branch deployment sebelum menjalankan script."
        exit 1
    fi

    log_info "Mengambil perubahan terbaru dari origin/${branch}..."
    git -C "${SCRIPT_DIR}" pull --ff-only origin "${branch}"
    log_success "Repository sudah sinkron pada branch ${branch}."
}

prepare_environment() {
    if [[ -f "${ENV_FILE}" ]]; then
        log_success "File backend/.env ditemukan."

        if [[ -n "${DEPLOY_APP_URL:-}" ]]; then
            set_env_value APP_URL "${DEPLOY_APP_URL%/}"
            log_success "APP_URL diperbarui dari DEPLOY_APP_URL."
        fi

        return
    fi

    if [[ ! -f "${ENV_EXAMPLE_FILE}" ]]; then
        log_error "File backend/.env.example tidak ditemukan."
        exit 1
    fi

    cp "${ENV_EXAMPLE_FILE}" "${ENV_FILE}"
    chmod 600 "${ENV_FILE}"

    set_env_value APP_ENV production
    set_env_value APP_DEBUG false
    set_env_value DB_CONNECTION mysql
    set_env_value DB_HOST db
    set_env_value DB_PORT 3306
    set_env_value DB_DATABASE laravel_db
    set_env_value DB_USERNAME laravel_user
    set_env_value DB_PASSWORD "$(generate_secret)"
    set_env_value DB_ROOT_PASSWORD "$(generate_secret)"

    if [[ -n "${DEPLOY_APP_URL:-}" ]]; then
        set_env_value APP_URL "${DEPLOY_APP_URL%/}"
    fi

    log_warn "backend/.env belum ada dan telah dibuat dari .env.example."
    if [[ -z "${DEPLOY_APP_URL:-}" ]]; then
        log_warn "APP_URL masih memakai nilai template. Ubah ke domain production di backend/.env setelah deployment."
    fi
    log_warn "Periksa juga konfigurasi production lain di backend/.env."
}

validate_environment() {
    local required_keys=(DB_DATABASE DB_USERNAME DB_PASSWORD)
    local app_debug
    local app_env
    local app_url
    local db_connection
    local db_host
    local key
    local value

    for key in "${required_keys[@]}"; do
        value="$(read_env_value "${key}")"
        if [[ -z "${value}" ]]; then
            log_error "${key} harus memiliki nilai di backend/.env."
            exit 1
        fi
    done

    db_connection="$(read_env_value DB_CONNECTION)"
    db_host="$(read_env_value DB_HOST)"
    if [[ "${db_connection}" != "mysql" || "${db_host}" != "db" ]]; then
        log_error "Deployment Docker memerlukan DB_CONNECTION=mysql dan DB_HOST=db di backend/.env."
        exit 1
    fi

    if [[ -z "$(read_env_value DB_ROOT_PASSWORD)" ]]; then
        log_warn "DB_ROOT_PASSWORD belum diset; Compose akan memakai fallback bawaan. Tetapkan password kuat untuk production baru."
    fi

    app_env="$(read_env_value APP_ENV)"
    app_debug="$(read_env_value APP_DEBUG)"
    app_url="$(read_env_value APP_URL)"
    if [[ "${app_env}" != "production" ]]; then
        log_warn "APP_ENV saat ini '${app_env:-kosong}', bukan 'production'."
    fi
    if [[ "${app_debug,,}" != "false" ]]; then
        log_warn "APP_DEBUG belum false. Nonaktifkan debug sebelum membuka aplikasi ke publik."
    fi
    if [[ -z "${app_url}" ]]; then
        log_warn "APP_URL masih kosong. Atur ke domain/IP publik VPS."
    elif [[ "${app_url}" == *localhost* || "${app_url}" == "http://127.0.0.1"* ]]; then
        log_warn "APP_URL masih mengarah ke lokal (${app_url}). Atur ke domain/IP publik VPS."
    fi
}

wait_for_mysql() {
    local attempt

    log_info "Menunggu MySQL siap menerima koneksi..."
    for ((attempt = 1; attempt <= MYSQL_MAX_ATTEMPTS; attempt++)); do
        if compose exec -T db sh -c \
            'MYSQL_PWD="$MYSQL_ROOT_PASSWORD" mysqladmin ping --host=127.0.0.1 --user=root --silent' \
            >/dev/null 2>&1; then
            log_success "MySQL siap setelah percobaan ${attempt}/${MYSQL_MAX_ATTEMPTS}."
            return
        fi

        printf '%b[WAIT]%b MySQL belum siap (%d/%d); mencoba lagi dalam %s detik...\r' \
            "${COLOR_YELLOW}" "${COLOR_RESET}" "${attempt}" "${MYSQL_MAX_ATTEMPTS}" "${MYSQL_WAIT_SECONDS}"
        sleep "${MYSQL_WAIT_SECONDS}"
    done

    printf '\n'
    log_error "MySQL tidak siap setelah ${MYSQL_MAX_ATTEMPTS} percobaan."
    compose logs --tail=100 db || true
    exit 1
}

ensure_application_key() {
    local app_key

    app_key="$(read_env_value APP_KEY)"
    if [[ -z "${app_key}" ]]; then
        log_info "APP_KEY kosong; membuat application key..."
        compose exec -T app php artisan key:generate --force
        log_success "APP_KEY berhasil dibuat."
    else
        log_success "APP_KEY sudah tersedia; key tidak diubah."
    fi
}

main() {
    require_command git
    require_command docker

    cd "${SCRIPT_DIR}"
    update_repository
    prepare_environment
    validate_environment

    cd "${BACKEND_DIR}"
    select_compose_command
    log_success "Menggunakan Docker Compose: ${COMPOSE_COMMAND[*]}"

    log_info "Memvalidasi backend/docker-compose.yml..."
    compose config --quiet

    log_info "Build image dan menjalankan container..."
    compose up -d --build
    wait_for_mysql

    log_info "Menginstal dependensi PHP production..."
    compose exec -T app composer install \
        --no-dev \
        --optimize-autoloader \
        --no-interaction \
        --prefer-dist

    ensure_application_key

    log_info "Menjalankan migration database..."
    compose exec -T app php artisan migrate --force

    log_info "Membuat symbolic link public storage..."
    compose exec -T app php artisan storage:link --force

    log_info "Membangun cache Laravel production..."
    compose exec -T app php artisan optimize:clear
    compose exec -T app php artisan config:cache
    if compose exec -T app php artisan route:cache; then
        log_success "Route cache berhasil dibuat."
    else
        log_warn "Route cache tidak dapat dibuat (route Closure belum cacheable); deployment dilanjutkan tanpa route cache."
        compose exec -T app php artisan route:clear
    fi
    compose exec -T app php artisan view:cache

    log_info "Mengatur permission storage dan bootstrap/cache..."
    compose exec -T --user root app sh -c \
        'mkdir -p storage bootstrap/cache && chgrp -R www-data storage bootstrap/cache && chmod -R 775 storage bootstrap/cache'

    log_success "Deployment selesai. Status container:"
    compose ps
}

main "$@"