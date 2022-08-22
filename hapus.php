<?php
include 'koneksi.php';

$id = $_POST['pilih'];

if (!$id) {
    echo "<script>alert('Pilih Form yang ingin dihapus !');window.location.href='index.php';</script>";
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
