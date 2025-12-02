<?php
include "../connection.php";

// Cek apakah sudah login
if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit;
}

// Ambil data dari form
$nama = trim($_POST['nama']);
$nik = trim($_POST['nik']);
$no_tlp = trim($_POST['no_tlp']);
$alamat = trim($_POST['alamat']);
$kategori = trim($_POST['kategori']);
$user_id = $_SESSION['user_id'];

// Validasi NIK harus 16 digit
if(strlen($nik) != 16 || !ctype_digit($nik)){
    header("Location: ../index.php?error=invalid_nik&show_modal=1#participants");
    exit;
}

// Cek apakah NIK sudah terdaftar
$check_sql = "SELECT * FROM peserta WHERE nik = ?";
$check_stmt = $koneksi->prepare($check_sql);
$check_stmt->bind_param("s", $nik);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if($check_result->num_rows > 0){
    header("Location: ../index.php?error=nik_exists&show_modal=1#participants");
    exit;
}

// Insert data peserta baru
$sql = "INSERT INTO peserta (nama, nik, no_tlp, alamat, kategori, user_id) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("sssssi", $nama, $nik, $no_tlp, $alamat, $kategori, $user_id);

if($stmt->execute()){
    $_SESSION['flash_success'] = "Pendaftaran berhasil! Selamat berlomba 🎉";
    header("Location: ../index.php#participants");
    exit;
} else {
    header("Location: ../index.php?error=system&show_modal=1#participants");
    exit;
}

$stmt->close();
$koneksi->close();
?>