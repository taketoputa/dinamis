<?php
require_once 'config.php';
function closedb($koneksi) {
    mysqli_close($koneksi);
}
?>
