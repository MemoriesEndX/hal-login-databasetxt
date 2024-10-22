function validateForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Cek apakah username dan password kosong
    if (username === "" || password === "") {
        alert("Username dan password harus diisi!");
        return false;
    }

    // Contoh sederhana: anggap login berhasil jika username adalah "admin" dan password adalah "admin123"
    if (username === "admin" && password === "admin123") {
        alert("Login berhasil!");
        return true; // Form akan dikirim ke login.php
    } else {
        alert("Login gagal! Username atau password salah.");
        return false; // Mencegah form dikirim jika login gagal
    }
}