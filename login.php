<?php
session_start();

$file_path = 'C:\xampp\htdocs\dafarizqy3337230010.com\users.txt';

// Fungsi untuk memeriksa kredensial login
function checkLogin($username, $password) {
    global $file_path;
    
    // Jika file tidak ada, login gagal
    if (!file_exists($file_path)) {
        return false;
    }
    
    // Buka file users.txt
    $file = fopen($file_path, 'r');
    
    // Baca setiap baris di file
    while ($line = fgets($file)) {
        list($stored_name, $stored_email, $stored_password) = explode('|', trim($line));
        
        // Cocokkan username/email dan password
        if (($username === $stored_name || $username === $stored_email) && $password === $stored_password) {
            fclose($file); // Tutup file
            return true; // Login berhasil
        }
    }
    
    fclose($file); // Tutup file
    return false; // Login gagal
}

// Mendapatkan input username dan password
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Cek login admin
    if ($username === "admin" && $password === "admin") {
        $_SESSION["username"] = $username;
        header("Location: dashboard.html");
        exit(); // Pastikan untuk menghentikan eksekusi setelah redirect
    } 
    
    // Periksa kredensial login dari file
    if (checkLogin($username, $password)) {
        $_SESSION["username"] = $username; // Simpan username ke session
        header("Location: dashboard.html");
        exit(); // Pastikan untuk menghentikan eksekusi setelah redirect
    } else {
        header("Location: login.html?login_error");
        exit(); // Pastikan untuk menghentikan eksekusi setelah redirect
    }
}
?>
