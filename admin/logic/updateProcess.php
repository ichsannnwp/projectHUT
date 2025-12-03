<?php
session_start();
include "../../connection.php";

// Pastikan hanya admin yang bisa akses
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: ../login.php");
    exit;
}

$id = $_POST['id'];
$nama = $_POST['nama'];
$nik = $_POST['nik'];
$tlp = $_POST['no_tlp'];
$alamat = $_POST['alamat'];
$kategori = $_POST['kategori'];

$stmt = $koneksi->prepare("UPDATE peserta SET nama=?, nik=?, no_tlp=?, alamat=?, kategori=? WHERE id=?");
$stmt->bind_param("sssssi", $nama, $nik, $tlp, $alamat, $kategori, $id);

if($stmt->execute()){
    header("Location: ../dashboard.php?msg=updated");
} else {
    header("Location: ../dashboard.php?error=failed");
}
?>