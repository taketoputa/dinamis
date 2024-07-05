<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // password kurang dari 6 atau gaada angkanya
    if (strlen($password) < 6 || !preg_match('/[0-9]/', $password)) {
        header("location: register.php?error=invalid_password");
        exit;
    }

    // hash pw
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // storing password
    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    if ($stmt = mysqli_prepare($koneksi, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);
        $param_email = $email;
        $param_password = $hashed_password;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            header("location: login.php?success=registered");
        }
        mysqli_stmt_close($stmt);
    }
}
closedb($koneksi);

?>


<!-- -------------------------------------------------------HTML ---------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anya Apparel | Register Page</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
    </style>
</head>
<body>
<div class="logintext">
        <form>
            <h1 class="signup-text">Sign Up</h1>
            <div class="input-container">
                <input type="text" placeholder="Enter your name" required>
            </div>
            <div class="input-container">
                <input type="email" placeholder="Enter your email" required>
            </div>
            <div class="input-container">
                <input type="password" placeholder="Enter your password" required>
            </div>
            <div class="input-container">
                <input type="password" placeholder="Confirm your password" required>
            </div>
            <div class="actions">
                <label><input type="checkbox"> Remember me</label>
            </div>
            <button type="submit" class="btn">Sign Up</button>
            <div class="signin-link">
                <p>Already have an account? <a href="./login.php">Sign in</a></p>
            </div>
        </form>
    </div>
</body>
</html>
