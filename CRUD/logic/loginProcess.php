<?php
include "../connection.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);

if(empty($username) || empty($password)){
    header("Location: ../login.php?error=empty_fields");
    exit;
}

// Cek di tabel user
$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0){
    header("Location: ../login.php?error=user_not_found");
    exit;
}

$user = $result->fetch_assoc();

if(password_verify($password, $user['password'])){
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    
    header("Location: ../index.php");
    exit;
} else {
    header("Location: ../login.php?error=wrong_password");
    exit;
}

$stmt->close();
$koneksi->close();
?>