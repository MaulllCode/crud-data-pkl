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
    <link rel="stylesheet" href="bootstraps\style\style.css" />
    <link rel="shortcut icon" href="gambar/logophp.png">
    <link rel="stylesheet" href="fontawesome/css/all.min.css" type="text/css">
</head>

<body>

    <nav id="head" class="navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <h1>Form Crud Data</h1>
            </a>
            <?php
            session_start();
            if (!isset($_SESSION['login'])) {
            ?>
                <div>
                    <a class="btn btn-primary" href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
                    <a class="btn btn-outline-primary" href="register.php"><i class="fa-solid fa-user-pen"></i> Daftar</a>
                </div>
            <?php
            } else {
            ?>
                <a class="btn btn-danger" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
            <?php
            }
            ?>
        </div>
    </nav>

    <!-- <div id="head" class="container-fluid">
        <div class="row">
            <div class="col d-flex justify-content-start">
                <h1>Form Crud Data</h1>
            </div>
            <div class="col d-flex align-items-center justify-content-end">
                <?php
                session_start();
                if (!isset($_SESSION['login'])) {
                ?>
                    <div>
                        <a class="btn btn-primary" href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
                        <a class="btn btn-outline-primary" href="register.php"><i class="fa-solid fa-user-pen"></i> Daftar</a>
                    </div>
                <?php
                } else {
                ?>
                    <a class="btn btn-danger" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div> -->

    <div id="body" class="container-fluid">

        <!-- <form class="container d-flex mb-3" role="search">
            <input class="form-control me-2" name="cari" type="search" placeholder="Pencarian" aria-label="Search" oninvalid="this.setCustomValidity('Masukan Nama pencarian dengan benar!')" oninput="setCustomValidity('')" required>
            <button class="btn btn-success" type="submit">Cari</button>
        </form> -->

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
                            </tr>
                        </tbody>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </form>

        <nav class="d-flex justify-content-end mt-3">
            <ul class="pagination">
                <?php
                // Jika page = 1, maka previous disable
                if ($page <= 1) {
                ?>
                    <!-- link Previous Page disable -->
                    <li class="disabled"><a class="page-link" href="#">&laquo;</a></li>
                <?php
                } else {
                    $previous = ($page > 1) ? $page - 1 : 1;
                ?>
                    <!-- link Previous Page -->
                    <li><a class="page-link" href="home.php?page=<?php echo $previous; ?>">Sebelumnya</a></li>
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
                    <li<?php echo $linkActive; ?>><a class="page-link" href="home.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                }
                    ?>

                    <!-- link Next Page -->
                    <?php
                    if ($page >= $jumlahPage) {
                    ?>
                        <li class="disabled"><a class="page-link" href="#">&raquo;</a></li>
                    <?php
                    } else {
                        $next = ($page < $jumlahPage) ? $page + 1 : $jumlahPage;
                    ?>
                        <li><a class="page-link" href="home.php?page=<?php echo $next; ?>">Selanjutnya</a></li>
                    <?php
                    }
                    ?>
            </ul>
        </nav>
    </div>

</body>

<footer id="footer" class="container-fluid">
    <small>&copy; 2022 - <strong>maulana adji sentosa</strong></small>
</footer>

</html>