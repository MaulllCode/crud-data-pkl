<?php
include 'koneksi.php';

session_start();

if (isset($_SESSION['level'])) {
    // jika level admin
    if ($_SESSION['level'] == "admin") {
    }
    // jika kondisi level user maka akan diarahkan ke halaman lain
    else if ($_SESSION['level'] == "user") {
        // header('location:home.php');
        echo "<script>alert('hanya Admin yang dapat mengakses halaman');window.location.href='home.php';</script>";
    }
}

if (!isset($_SESSION['login'])) {
    echo "<script>window.location.href='home.php';alert('Anda belum melakukan login!');</script>";
}

$id = $_POST['pilih'];

if (!$id) {
    echo "<script>window.location.href='index.php';alert('Pilih data yang ingin dihapus!');</script>";
} else {

    foreach ($id as $value) {

        $sql1 = "SELECT * FROM data WHERE id = $value";
        $result = mysqli_query($kon, $sql1);

        $gambar = "SELECT gambar FROM data WHERE id = $value";
        $result1 = mysqli_query($kon, $gambar);
        $data = mysqli_fetch_array($result1);

        $folder = "gambar/" . $data['gambar'];

        unlink("$folder");

        $sql = "DELETE FROM data WHERE id = $value";
        $result = mysqli_query($kon, $sql);

        if ($result) {
            echo "<script>alert('Data berhasil dihapus !');window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Data gagal dihapus !');window.location.href='index.php';</script>";
        }
    }
}
