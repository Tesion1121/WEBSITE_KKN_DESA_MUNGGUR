// ============================================================
// API Service — Desa Munggur
// Centrally manages same-origin calls to the Laravel API
// ============================================================

const API_BASE_URL = "/api";

const Api = {
  // Get storage token
  getToken() {
    return localStorage.getItem("admin_token");
  },

  // Save storage token
  saveToken(token) {
    localStorage.setItem("admin_token", token);
  },

  // Remove storage token
  removeToken() {
    localStorage.removeItem("admin_token");
  },

  // Check login status
  isLoggedIn() {
    return !!this.getToken();
  },

  // Parse response safely — throws descriptive error if not valid JSON
  async parseResponse(response, endpoint) {
    const contentType = response.headers.get("content-type") || "";

    // If response is not OK, try to extract error message
    if (!response.ok) {
      if (contentType.includes("application/json")) {
        const errorData = await response.json();
        throw new Error(errorData.message || `Server error (${response.status})`);
      }
      // Server returned HTML or other non-JSON (e.g. Laravel error page)
      throw new Error(`Server error ${response.status} pada ${endpoint}`);
    }

    // Response is OK — parse JSON safely
    if (contentType.includes("application/json")) {
      return response.json();
    }

    // Response is OK but not JSON (shouldn't happen, but handle gracefully)
    const text = await response.text();
    try {
      return JSON.parse(text);
    } catch {
      throw new Error(`Response dari ${endpoint} bukan format JSON yang valid`);
    }
  },

  // Common fetch function
  async request(endpoint, options = {}) {
    const url = `${API_BASE_URL}${endpoint}`;
    
    // Set headers
    const headers = options.headers || {};
    const token = this.getToken();
    if (token) {
      headers["Authorization"] = `Bearer ${token}`;
    }
    
    // Default to JSON content type if not sending FormData
    if (!(options.body instanceof FormData) && !headers["Content-Type"]) {
      headers["Content-Type"] = "application/json";
    }

    // Always request JSON response from Laravel
    headers["Accept"] = "application/json";

    const config = {
      ...options,
      headers
    };

    try {
      const response = await fetch(url, config);
      
      // Handle unauthorized
      if (response.status === 401 && endpoint !== "/login") {
        this.removeToken();
        window.location.href = "/login";
        return;
      }

      return response;
    } catch (error) {
      console.error(`API Error on ${endpoint}:`, error);
      throw error;
    }
  },

  // GET Request
  async get(endpoint) {
    const res = await this.request(endpoint, { method: "GET" });
    return this.parseResponse(res, endpoint);
  },

  // POST Request
  async post(endpoint, data) {
    const body = data instanceof FormData ? data : JSON.stringify(data);
    const res = await this.request(endpoint, {
      method: "POST",
      body
    });
    return this.parseResponse(res, endpoint);
  },

  // PUT Request
  async put(endpoint, data) {
    const res = await this.request(endpoint, {
      method: "PUT",
      body: JSON.stringify(data)
    });
    return this.parseResponse(res, endpoint);
  },

  // DELETE Request
  async delete(endpoint) {
    const res = await this.request(endpoint, { method: "DELETE" });
    return this.parseResponse(res, endpoint);
  },

  // Upload Image File
  async uploadImage(file) {
    const formData = new FormData();
    formData.append("image", file);
    
    const res = await this.request("/upload", {
      method: "POST",
      body: formData
    });
    return this.parseResponse(res, "/upload");
  }
};
