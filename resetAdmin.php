<?php
include "connection.php"; // Pastikan koneksi benar

echo "<h3>🛠️ Perbaikan Akun Admin</h3>";

$username = 'admin';
$password_asli = 'admin123';

// 1. Cek apakah user 'admin' ada?
$cek_user = mysqli_query($koneksi, "SELECT * FROM admin WHERE username = '$username'");

if(mysqli_num_rows($cek_user) > 0){
    $data = mysqli_fetch_assoc($cek_user);
    echo "✅ User 'admin' ditemukan.<br>";
    echo "Password Database saat ini: " . $data['password'] . "<br><br>";
    
    // 2. Cek apakah passwordnya cocok?
    if(password_verify($password_asli, $data['password'])){
        echo "✅ <h2 style='color:green'>Status: Password AMAN & COCOK!</h2>";
        echo "Jika masih gagal login, cek file login_process.php kamu.<br>";
    } else {
        echo "❌ <strong style='color:red'>Status: Password TIDAK COCOK.</strong><br>";
        echo "Sedang memperbaiki...<br>";
        
        // 3. Update password dengan Hash baru yang fresh
        $hash_baru = password_hash($password_asli, PASSWORD_DEFAULT);
        $update = mysqli_query($koneksi, "UPDATE admin SET password = '$hash_baru' WHERE username = '$username'");
        
        if($update){
            echo "✅ <strong style='color:green'>BERHASIL! Password sudah direset ke: admin123</strong><br>";
            echo "Hash baru: " . $hash_baru . "<br>";
        } else {
            echo "❌ Gagal update database: " . mysqli_error($koneksi);
        }
    }
} else {
    echo "❌ User 'admin' tidak ditemukan.<br>";
    echo "Sedang membuat user baru...<br>";
    
    // Buat user baru jika tidak ada
    $hash_baru = password_hash($password_asli, PASSWORD_DEFAULT);
    $insert = mysqli_query($koneksi, "INSERT INTO admin (username, password) VALUES ('$username', '$hash_baru')");
    
    if($insert){
        echo "✅ <strong style='color:green'>User admin berhasil dibuat dengan password: admin123</strong>";
    } else {
        echo "❌ Gagal insert: " . mysqli_error($koneksi);
    }
}

echo "<br><hr><br>";
echo "👉 <a href='admin/login.php' style='font-size:20px; font-weight:bold;'>COBA LOGIN SEKARANG</a>";
?>