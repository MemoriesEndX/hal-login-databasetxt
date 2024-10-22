<?php
// File tempat menyimpan data registrasi
$file_path = 'C:\xampp\htdocs\dafarizqy3337230010.com\users.txt'; 

// Fungsi untuk menyimpan data user ke file
function saveUser($name, $email, $password) {
    global $file_path;
    
    // Jangan hash password, simpan langsung (plaintext)
    $user_data = $name . "|" . $email . "|" . $password . "\n";
    
    // Simpan ke file
    file_put_contents($file_path, $user_data, FILE_APPEND);
}

// Fungsi untuk memeriksa apakah email sudah terdaftar
function isEmailRegistered($email) {
    global $file_path;
    
    // Jika file tidak ada, berarti belum ada user yang terdaftar
    if (!file_exists($file_path)) {
        return false;
    }
    
    // Baca setiap baris di file
    $file = fopen($file_path, 'r');
    while ($line = fgets($file)) {
        list($stored_name, $stored_email, $stored_password) = explode('|', trim($line));
        
        // Jika email ditemukan, return true
        if ($email === $stored_email) {
            fclose($file);
            return true;
        }
    }
    fclose($file);
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Validasi apakah email sudah terdaftar
    if (isEmailRegistered($email)) {
        $error = "Email sudah terdaftar. Silakan gunakan email lain.";
    } else {
        // Simpan user baru
        saveUser($name, $email, $password);
        $success = "Registrasi berhasil!";
    }
}

include 'C:\xampp\htdocs\dafarizqy3337230010.com\registrasi.php'; // Panggil untuk menampilkan ulang form dengan pesan error atau sukses
?>
