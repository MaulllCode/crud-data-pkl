<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crud | Form Ubah Data</title>
    <link href="bootstraps/css/bootstrap.css" rel="stylesheet">
    <script src="bootstraps/js/bootstrap.bundle.min.js"></script>
    <script src="bootstraps/js/bootstrap.min.js"></script>
    <script src="bootstraps/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="shortcut icon" href="gambar/logophp.png">
    <link rel="stylesheet" href="fontawesome/css/all.min.css" type="text/css">
</head>

<body>

    <div id="head" class="container-fluid">
        <div class="text-center">
            <h1>Form Ubah Data</h1>
        </div>
    </div>

    <div id="body" class="container-fluid">

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
                echo "<script>alert('hanya Admin yang dapat mengakses halaman!');window.location.href='home.php';</script>";
            }
        }

        if (!isset($_SESSION['login'])) {
            echo "<script>window.location.href='home.php';alert('Anda belum melakukan login!');</script>";
        }

        $array_kota = array(
            'Kabupaten Bangkalan',
            'Kabupaten Banyuwangi',
            'Kabupaten Blitar',
            'Kabupaten Bojonegoro',
            'Kabupaten Bondowoso',
            'Kabupaten Gresik',
            'Kabupaten Jember',
            'Kabupaten Jombang',
            'Kabupaten Kediri',
            'Kabupaten Lamongan',
            'Kabupaten Lumajang',
            'Kabupaten Madiun',
            'Kabupaten Magetan',
            'Kabupaten Malang',
            'Kabupaten Mojokerto',
            'Kabupaten Nganjuk',
            'Kabupaten Ngawi',
            'Kabupaten Pacitan',
            'Kabupaten Pamekasan',
            'Kabupaten Pasuruan',
            'Kabupaten Ponorogo',
            'Kabupaten Probolinggo',
            'Kabupaten Sampang',
            'Kabupaten Sidoarjo',
            'Kabupaten Situbondo',
            'Kabupaten Sumenep',
            'Kabupaten Trenggalek',
            'Kabupaten Tuban',
            'Kabupaten Tulungagung',
            'Kota Batu',
            'Kota Blitar',
            'Kota Kediri',
            'Kota Madiun',
            'Kota Malang',
            'Kota Mojokerto',
            'Kota Pasuruan',
            'Kota Probolinggo',
            'Kota Surabaya',
        );

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM data WHERE id = $id";
            $result = mysqli_query($kon, $sql);
            $data = mysqli_fetch_array($result);
        }

        if (isset($_POST['ubah_data'])) {

            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $email = $_POST['email'];
            $no = $_POST['no'];
            $kota = $_POST['kota'];
            $jk = $_POST['jk'];

            $namafile = $_FILES['file_gambar']['name'];
            $tipe_file =  array('png', 'jpg', 'jpeg', 'gif', '');
            $tmp = $_FILES['file_gambar']['tmp_name'];
            $date = date('dMY His');
            $new = $date . '-' . $namafile;

            $xp = explode('.', $namafile);
            $ekstensi = strtolower(end($xp));

            if ($namafile != "") {

                if (in_array($ekstensi, $tipe_file)) {

                    $get = "SELECT gambar FROM data WHERE id = '$id'";
                    $data = mysqli_query($kon, $get);
                    $lama = mysqli_fetch_array($data);

                    unlink("gambar/" . $lama['gambar']);

                    move_uploaded_file($tmp, 'gambar/' . $new);

                    $sql = "UPDATE data SET nama = '$nama', alamat = '$alamat', email = '$email', no = '$no', kota = '$kota', jk = '$jk', gambar = '$new' WHERE id = $id";

                    $result = mysqli_query($kon, $sql);

                    if ($result) {
                        echo "<script>alert('Data berhasil diubah');window.location.href='index.php';</script>";
                    } else {
                        echo "<script>alert('Data gagal diubah');window.location.href='index.php';</script>";
                    }
                } else {
                    echo "<script>
        alert('Pastikan menggunakan File Foto !');
        window.location.href = 'index.php';
        </script>";
                }
            } else {
                $sql2 = "UPDATE data SET nama = '$nama', alamat = '$alamat', email = '$email', no = '$no', kota = '$kota', jk = '$jk' WHERE id = $id";

                $result = mysqli_query($kon, $sql2);

                if ($result) {
                    echo "<script>alert('Data berhasil diubah');window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('Data gagal diubah');window.location.href='index.php';</script>";
                }
            }
        }

        ?>

        <div class="card container shadow-lg">
            <form action="" method="post" class="form-floating" enctype="multipart/form-data">
                <div class="mb-3 mt-3">
                    <label>Nama</label>
                    <input type="text" value="<?php echo htmlspecialchars($data['nama'], ENT_QUOTES); ?>" class="form-control" name="nama" placeholder="Nama lengkap" required pattern="[a-zA-Z\s]{1,50}" oninvalid="this.setCustomValidity('Masukan Nama lengkap dengan benar')" oninput="setCustomValidity('')">
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <input type="text" value="<?php echo htmlspecialchars($data['alamat'], ENT_QUOTES); ?>" class="form-control" name="alamat" placeholder="Alamat domisili" required pattern="[a-zA-Z0-9\s]{1,50}" oninvalid="this.setCustomValidity('Masukan Alamat domisili dengan benar')" oninput="setCustomValidity('')">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" value=" <?php echo htmlspecialchars($data['email'], ENT_QUOTES); ?>" class="form-control" name="email" placeholder="Email@gmail.com" required pattern="[A-z0-9._%+-]+@[gmail]+\.[com]{2,4}$" oninvalid="this.setCustomValidity('Masukan Alamat email dengan benar')" oninput="setCustomValidity('')">
                </div>
                <div class="mb-3">
                    <label>No Telp</label>
                    <input type="tel" pattern="\d{10,15}" value="<?php echo htmlspecialchars($data['no'], ENT_QUOTES); ?>" class="form-control" name="no" placeholder="08XXXXXXXXXX" required oninvalid="this.setCustomValidity('Masukan No telp dengan benar')" oninput="setCustomValidity('')">
                </div>
                <div class="mb-3">
                    <label>Kota</label>
                    <select class="form-select" name="kota" required oninvalid="this.setCustomValidity('Pilih Kota dengan benar')" oninput="setCustomValidity('')">
                        <option value="<?php echo htmlspecialchars($data['kota'], ENT_QUOTES); ?>">-- Pilihan Kota --</option>
                        <?php
                        foreach ($array_kota as $kota) {
                            if ($data['kota'] == $kota) {
                                echo "<option value='$kota' selected>$kota</option>";
                            } else {
                                echo "<option value='$kota'>$kota</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class=" mb-3">
                    <label>Jenis Kelamin</label>
                    <select class="form-select" name="jk" required oninvalid="this.setCustomValidity('Pilih Jenis kelamin dengan benar')" oninput="setCustomValidity('')">
                        <option value="<?php echo htmlspecialchars($data['jk'], ENT_QUOTES); ?>">-- Pilihan Jenis Kelamin --</option>
                        <?php
                        $array_jk = array('laki-laki', 'perempuan');
                        foreach ($array_jk as $jk) {
                            if ($data['jk'] == $jk) {
                                echo "<option value='$jk' selected>$jk</option>";
                            } else {
                                echo "<option value='$jk'>$jk</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class=" mb-3">
                    <label>Foto</label> <br>
                    <img src="gambar/<?php echo htmlentities($data['gambar'], ENT_QUOTES); ?>" width="100px" height="100px"> <br> <br>
                    <input class="form-control" type="file" name="file_gambar" />
                    <p style="color: red">Pastikan menggunakan File Foto</p>
                </div>
                <hr>
                <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                    <button type="submit" name="ubah_data" class="btn btn-primary"><i class="fa-solid fa-pencil"></i> Ubah Data</button>
                    <a class="btn btn-success" href="index.php" role="button"><i class="fa-solid fa-backward-step"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>

</body>

<footer id="footer" class="container-fluid">
    <small>&copy; 2022 - <strong>maulana adji sentosa</strong></small>
</footer>

</html>