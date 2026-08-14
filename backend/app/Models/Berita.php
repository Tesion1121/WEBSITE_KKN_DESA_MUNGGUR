<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'isi',
        'ringkasan',
        'image_url',
        'penulis',
        'tanggal_terbit',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'tanggal_terbit' => 'date',
    ];

    protected $appends = ['imageUrl'];

    public function getImageUrlAttribute()
    {
        return $this->attributes['image_url'] ?? null;
    }

    /**
     * Auto-generate slug dari judul saat membuat berita baru.
     */
    protected static function booted(): void
    {
        static::creating(function (Berita $berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul) . '-' . time();
            }
            if (empty($berita->tanggal_terbit)) {
                $berita->tanggal_terbit = now()->toDateString();
            }
        });
    }
}
