<?php
include 'koneksi.php';
$id = $_POST['pilih'];
// print_r($id);

foreach ($id as $value) {

    $sql = "DELETE FROM data WHERE id = $value";
    $result = mysqli_query($kon, $sql);

    if ($result) {
        echo "<script>alert('Data berhasil dihapus');window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus');window.location.href='index.php';</script>";
    }
}
