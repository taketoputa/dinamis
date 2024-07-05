<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // select dari db
    $sql = "SELECT id, email, password FROM users WHERE email = ?";
    if ($stmt = mysqli_prepare($koneksi, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        $param_email = $email;

        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        // cek email exist/no
        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($password, $hashed_password)) {
                    // password correct
                    session_start();
                    $_SESSION['id'] = $id;
                    $_SESSION['email'] = $email;
                    header("location: welcome.php");
                } else {
                    // password ga valid
                    header("location: login.php?error=invalid_password");
                }
            }
        } else {
            // email gaada
            header("location: login.php?error=email_not_found");
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Something went wrong with the SQL preparation.";
    }
}

closedb($koneksi);
?>

<!-- -------------------------------------------------------------- HTML ------------------------------------------------------------------------------- -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anya Apparel | Login Page</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
    </style>
</head>
<body>
<div class="logintext">
        <form>
            <h1 class="login-text">Login</h1>
            <div class="input-container">
                <input type="email" placeholder="Enter your email" required>
                <i></i>
            </div>
            <div class="input-container">
                <input type="password" placeholder="Confirm a password" required>
                <i></i>
            </div>
            <div class="actions">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="signup-link">
                <p>Don't have an account? <a href="./register.php">Sign up now</a></p>
            </div>
        </form>
    </div>
</body>
</html>
