// auth.js

export function isAuthenticated() {
    const token = localStorage.getItem('token'); // Supondo que você armazene o token de autenticação no local storage
    return !!token; // Retorna true se houver um token, caso contrário, retorna false
  }
