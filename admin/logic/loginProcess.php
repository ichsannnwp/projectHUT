<?php
session_start();
include "../../connection.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);

if(empty($username) || empty($password)){
    header("Location: ../login.php?error=empty");
    exit;
}

$sql = "SELECT * FROM admin WHERE username = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    if (password_verify($password, $row['password'])) {
        
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $row['username'];
        
        header("Location: ../dashboard.php");
        exit;

    } else {
        header("Location: ../login.php?error=wrong_password");
        exit;
    }
} else {
    header("Location: ../login.php?error=user_not_found");
    exit;
}

$stmt->close();
$koneksi->close();
?>