<?php

session_start();
if (!isset($_SESSION['login'])) {
    echo "<script>alert('Anda belum melakukan login!');window.location.href='login.php';</script>";
}
session_destroy();

echo "<script>alert('Anda telah logout!');window.location.href='index.php';</script>";
