<?php
function authenticate_user($koneksi, $email, $password) {
    $sql = "SELECT password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    // bind ke parameternya
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    // bind hasil ke variabel
    mysqli_stmt_bind_result($stmt, $hashed_password);
    // ambil hasil
    if (mysqli_stmt_fetch($stmt)) {
        // verifikasi password
        if (password_verify($password, $hashed_password)) {
            return true;
        }
    }
    mysqli_stmt_close($stmt);
    return false;
}
?>
