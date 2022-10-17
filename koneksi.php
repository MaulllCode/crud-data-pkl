<?php
$kon = mysqli_connect("localhost", "root", "", "crud-pkl");

if (!$kon) {
    echo "<script>alert('Koneksi error!');window.location.href='home    .php';</script>";
}
