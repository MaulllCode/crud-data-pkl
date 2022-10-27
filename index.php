<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crud | Form Crud Data</title>
    <link href="bootstraps/css/bootstrap.css" rel="stylesheet">
    <script src="bootstraps/js/bootstrap.bundle.min.js"></script>
    <script src="bootstraps/js/bootstrap.min.js"></script>
    <script src="bootstraps/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="bootstraps/style/style.css" type="text/css">
    <link rel="shortcut icon" href="gambar/logophp.png">
    <link rel="stylesheet" href="fontawesome/css/all.min.css" type="text/css">
</head>

<body>

    <div id="head" class="container-fluid">
        <div class="row">
            <div class="col justify-content-start">
                <h1>Form Crud Data</h1>
            </div>
            <div class="col d-flex align-items-center justify-content-end">
                <?php
                session_start();
                if (!isset($_SESSION['login'])) {
                ?>
                    <a class="btn btn-primary" href="login.php">Masuk</a>
                    <a class="d-none btn btn-danger" href="logout.php">Keluar</a>
                <?php
                } else {
                ?>
                    <a class="d-none btn btn-primary" href="login.php">Masuk</a>
                    <a class="btn btn-danger" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div id="body" class="container-fluid ">

        <?php
        include 'koneksi.php';

        if (isset($_SESSION['level'])) {
            if ($_SESSION['level'] == "user") {
                header('location:home.php');
            }
        }

        if (!isset($_SESSION['login'])) {
            echo "<script>window.location.href='home.php';</script>";
        }

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

        <form class="container d-flex mb-3" role="search">
            <input class="form-control me-2" name="cari" type="search" placeholder="Pencarian" aria-label="Search">
            <button class="btn btn-success" type="submit">Cari</button>
        </form>

        <?php
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
            echo "<b>Hasil pencarian : " . $cari . "</b><br><br>";
        }
        ?>

        <form action="hapus.php" method="POST">
            <div class="table-responsive text-center">
                <table class="table table-bordered align-middle border-dark">
                    <thead>
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

                    $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

                    $limit = 10;

                    $limitStart = ($page - 1) * $limit;

                    if (isset($_GET['cari'])) {

                        $cari = $_GET['cari'];

                        $SqlQuery = mysqli_query($kon, "SELECT * FROM data WHERE nama LIKE '%" . $cari . "%'");
                    } else {

                        $SqlQuery = mysqli_query($kon, "SELECT * FROM data LIMIT " . $limitStart . "," . $limit);
                    }

                    $i = $limitStart + 0;

                    while ($data = mysqli_fetch_array($SqlQuery)) {

                        $i++;

                    ?>
                        <tbody class="table-group-divider">
                            <tr>
                                <th><?php echo $i; ?></th>
                                <td><?php echo ucfirst($data['nama']); ?></td>
                                <td><?php echo ucfirst($data['alamat']); ?></td>
                                <td><?php echo ucfirst($data['email']); ?></td>
                                <td><?php echo $data['no']; ?></td>
                                <td><?php echo ucfirst($data['kota']); ?></td>
                                <td><?php echo ucfirst($data['jk']); ?></td>
                                <td> <img src="gambar/<?php echo $data['gambar'] ?>" width='100px' height='100px'></td>
                                <td>
                                    <a href="ubah.php?id=<?= $data['id'] ?>" class="btn btn-warning"><i class="fa-solid fa-pencil"></i> Ubah</a>
                                    <a href="index.php?id=<?= $data['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus</a>
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
            </div>
            <div class="row mt-3">
                <div class="col justify-content-start">
                    <a class="btn btn-primary" href="tambah.php"><i class="fa-solid fa-circle-plus"></i> Tambah Data</a>
                    <a href="upload-excel.php" class="btn btn-info"><i class="fa fa-file-arrow-up"></i> Upload Data</a>
                    <button type="submit" name="hapus" class="btn btn-danger" onclick="return confirm('Yakin menghapus data?')"><i class="fa fa-trash"></i> Hapus Data</button>
                </div>

                <nav class=" col d-flex justify-content-end">
                    <ul class="pagination">
                        <?php
                        // Jika page = 1, maka previous disable
                        if ($page <= 1) {
                        ?>
                            <!-- link Previous Page disable -->
                            <li class="disabled"><a class="page-link" href="#">Previous</a></li>
                        <?php
                        } else {
                            $previous = ($page > 1) ? $page - 1 : 1;
                        ?>
                            <!-- link Previous Page -->
                            <li><a class="page-link" href="index.php?page=<?php echo $previous; ?>">Previous</a></li>
                        <?php
                        }
                        ?>

                        <?php
                        $SqlQuery = mysqli_query($kon, "SELECT * FROM data");

                        //Hitung semua jumlah data yang berada pada tabel Sisawa
                        $JumlahData = mysqli_num_rows($SqlQuery);

                        // Hitung jumlah halaman yang tersedia
                        $jumlahPage = ceil($JumlahData / $limit);

                        // Jumlah link number 
                        $jumlahNumber = 2;

                        // Untuk awal link number
                        $startNumber = ($page > $jumlahNumber) ? $page - $jumlahNumber : 1;

                        // Untuk akhir link number
                        $endNumber = ($page < ($jumlahPage - $jumlahNumber)) ? $page + $jumlahNumber : $jumlahPage;

                        for ($i = $startNumber; $i <= $endNumber; $i++) {
                            $linkActive = ($page == $i) ? ' class="active"' : '';
                        ?>
                            <li<?php echo $linkActive; ?>><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                        }
                            ?>

                            <!-- link Next Page -->
                            <?php
                            if ($page >= $jumlahPage) {
                            ?>
                                <li class="disabled"><a class="page-link" href="#">Next</a></li>
                            <?php
                            } else {
                                $next = ($page < $jumlahPage) ? $page + 1 : $jumlahPage;
                            ?>
                                <li><a class="page-link" href="index.php?page=<?php echo $next; ?>">Next</a></li>
                            <?php
                            }
                            ?>
                    </ul>
                </nav>
            </div>
        </form>
    </div>

</body>

<footer id="footer" class="container-fluid">
    <small>&copy; 2022 - <strong>maulana adji sentosa</strong></small>
</footer>

</html>