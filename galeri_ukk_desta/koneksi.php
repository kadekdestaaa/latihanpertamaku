<?php
if (session_status() === PHP_SESSION_NONE) {
    // Jika belum, mulai sesi
    session_start();
}

$koneksi=mysqli_connect("localhost","root","","ukk_fotogaleri")
?>