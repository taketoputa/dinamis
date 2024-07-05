<?php
    $db_host = "127.0.0.1:3308"; 
    $db_username = "root";
    $db_password = "";
    $db_name = "cf";
    $koneksi = new mysqli($db_host, $db_username, $db_password, $db_name);

// cek koneksi
if($koneksi === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}echo "Koneksi berhasil";

?>
