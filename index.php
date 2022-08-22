<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crud | Maulana adji sentosa</title>
    <link href="bootstraps/css/bootstrap.css" rel="stylesheet">
    <script src="bootstraps/js/bootstrap.bundle.min.js"></script>
    <script src="bootstraps/js/bootstrap.min.js"></script>
    <script src="bootstraps/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="style/style.css" />

</head>

<body>
    <div class="card">
        <div class="card-header">
            <h1>Form Crud Data</h1>
        </div>
        <div class="card-body">

            <?php

            include 'koneksi.php';

            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $sql1 = "SELECT * FROM data WHERE id = $id";
                $result = mysqli_query($kon, $sql1);

                $gambar = "SELECT gambar FROM data WHERE id = $id";
                $result1 = mysqli_query($kon, $gambar);
                $data = mysqli_fetch_array($result1);

                $folder = "gambar/" . $data['gambar'];

                unlink("$folder");

                $sql = "DELETE FROM data WHERE id = $id";

                $result = mysqli_query($kon, $sql);

                if ($result) {
                    echo "<script>alert('Data berhasil dihapus');window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('Data gagal dihapus');window.location.href='index.php';</script>";
                }
            }

            ?>

            <form action="hapus.php" method="POST">
                <div class="table-responsive text-center">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Email</th>
                                <th scope="col">No Telepon</th>
                                <th scope="col">Kota</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Aksi</th>
                                <th scope="col">Pilih</th>
                            </tr>
                        </thead>

                        <?php

                        include "koneksi.php";

                        $sql = "SELECT * FROM data id";

                        $result = mysqli_query($kon, $sql);

                        $i = 0;

                        while ($data = mysqli_fetch_array($result)) {

                            $i++;

                        ?>
                            <tbody class="table-group-divider">
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['alamat']; ?></td>
                                    <td><?php echo $data['email']; ?></td>
                                    <td><?php echo $data['no']; ?></td>
                                    <td><?php echo $data['kota']; ?></td>
                                    <td><?php echo $data['jk']; ?></td>
                                    <td> <img src="gambar/<?php echo $data['gambar'] ?>" width='100px' height='100px'></td>
                                    <td>
                                        <a href="ubah.php?id=<?= $data['id'] ?>" class="btn btn-warning">Edit</a>
                                        <a href="index.php?id=<?= $data['id'] ?>" class="btn btn-danger">Hapus</a>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="pilih[]" value="<?php echo $data['id'] ?>">
                                    </td>
                                </tr>
                            </tbody>
                        <?php
                        }
                        ?>
                    </table>
                    <hr>
                </div>
                <a class="btn btn-primary" href="tambah.php" role="button">Tambah Data Baru</a>
                <a href="upload_excel.php" class="btn btn-info">Import Data</a>
                <button type="submit" name="hapus" class="btn btn-danger">Hapus Data</button>
            </form>
        </div>
    </div>
</body>

</html>

<!-- <script>
    function myFunction() {
        var element = document.body;
        element.classList.toggle("dark-mode");
    }
</script> -->