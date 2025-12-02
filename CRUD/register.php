<?php
include 'connection.php';

if(isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - JRF</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">
    <div class="footprints"></div>
    
    <div class="auth-container">
        <div class="auth-header">
            <img src="logo.png" alt="JRF Logo" class="auth-logo">
            <h1>Register</h1>
        </div>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                if($_GET['error'] == 'username_exists') echo "❌ Username sudah terdaftar!";
                elseif($_GET['error'] == 'password_mismatch') echo "❌ Password dan Re-Password harus sama";
                elseif($_GET['error'] == 'empty_fields') echo "❌ Semua field harus diisi!";
                ?>
            </div>
        <?php endif; ?>

        <form action="logic/registerProcess.php" method="post">
            <div class="form-group">
                <label for="username">Username :</label>
                <input type="text" name="username" id="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password :</label>
                <input type="password" name="password" id="password" required>
            </div>
            
            <div class="form-group">
                <label for="re_password">Re - Password :</label>
                <input type="password" name="re_password" id="re_password" required>
            </div>
            
            <button type="submit" class="btn-submit">Register</button>
        </form>
        
        <div class="auth-link">
            Sudah Punya Akun? <a href="login.php">Login</a>
        </div>
    </div>
</body>
</html>