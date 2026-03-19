// This value is set via the api-config partial from .env (API_BASE_URL)
// For JS modules, use window.API_BASE_URL which is set in partials/api-config.blade.php
export const API_BASE_URL = window.API_BASE_URL || 'http://192.168.55.254:8000/api';