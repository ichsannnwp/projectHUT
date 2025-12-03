<?php
session_start();
include "../../connection.php";

// Pastikan hanya admin yang bisa akses
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: ../login.php");
    exit;
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $stmt = $koneksi->prepare("DELETE FROM peserta WHERE id=?");
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()){
        header("Location: ../dashboard.php?msg=deleted");
    } else {
        header("Location: ../dashboard.php?error=failed");
    }
} else {
    header("Location: ../dashboard.php");
}
?>