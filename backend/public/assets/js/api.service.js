// ============================================================
// API Service — Desa Munggur
// Centrally manages calls to local Laravel backend
// ============================================================

const API_BASE_URL = "http://localhost:8000/api";

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

    const config = {
      ...options,
      headers
    };

    try {
      const response = await fetch(url, config);
      
      // Handle unauthorized
      if (response.status === 401 && endpoint !== "/login") {
        this.removeToken();
        window.location.href = "login.html";
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
    return res.json();
  },

  // POST Request
  async post(endpoint, data) {
    const body = data instanceof FormData ? data : JSON.stringify(data);
    const res = await this.request(endpoint, {
      method: "POST",
      body
    });
    return res.json();
  },

  // PUT Request
  async put(endpoint, data) {
    const res = await this.request(endpoint, {
      method: "PUT",
      body: JSON.stringify(data)
    });
    return res.json();
  },

  // DELETE Request
  async delete(endpoint) {
    const res = await this.request(endpoint, { method: "DELETE" });
    return res.json();
  },

  // Upload Image File
  async uploadImage(file) {
    const formData = new FormData();
    formData.append("image", file);
    
    const res = await this.request("/upload", {
      method: "POST",
      body: formData
    });
    return res.json();
  }
};
