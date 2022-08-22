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
            <h1>Form Ubah Data</h1>
        </div>
        <div class="card-body">

            <?php

            include 'koneksi.php';

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
                $tipe_file = $_FILES['file_gambar']['type'];
                $ukuran = $_FILES['file_gambar']['size'];

                if ($ukuran > 2097152) {
                    echo "<script>
                    alert('Ukuran Foto terlalu besar !');
                    window.location.href = 'index.php';
                </script>";
                } else {

                    if ($namafile != "") {

                        $ekstensi =  array('png', 'jpg', 'jpeg');
                        $tmp = $_FILES['file_gambar']['tmp_name'];
                        $date = date('dmY His');
                        $new = $date . '-' . $namafile;

                        if (in_array($tipe_file, $ekstensi)) {
                            echo "<script>
                            alert('Pastikan menggunakan File Foto !');
                            window.location.href = 'index.php';
                            </script>";
                        } else {

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
            }
            ?>

            <form action="" method="post" class="form-floating" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" value="<?php echo $data['nama']; ?>" class="form-control" name="nama" placeholder="Masukan Nama" required>
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <input type="text" value="<?php echo $data['alamat']; ?>" class="form-control" name="alamat" placeholder="Masukan Alamat" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="text" value="<?php echo $data['email']; ?>" class="form-control" name="email" placeholder="Masukan Email" required>
                </div>
                <div class="mb-3">
                    <label>No Telp</label>
                    <input type="text" value="<?php echo $data['no']; ?>" class="form-control" name="no" placeholder="Masukan No Telp" required>
                </div>
                <div class="mb-3">
                    <label>Kota</label>
                    <select class="form-select" name="kota" required>
                        <option value="">-- Pilihan Kota --</option>
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
                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select class="form-select" name="jk" required>
                        <option value>-- Pilihan Jenis Kelamin --</option>
                        <?php
                        $array_jk = array('Laki-laki', 'Perempuan');
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
                <div class="mb-3">
                    <label>Foto</label> <br>
                    <img src="gambar/<?php echo $data['gambar']; ?>" width="100px" height="100px"> <br> <br>
                    <input class="form-control" type="file" name="file_gambar" />
                    <p style="color: red">Pastikan menggunakan File Foto</p>
                </div>
                <hr>
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                <button type="submit" name="ubah_data" class="btn btn-primary">Ubah Data</button>
                <a class="btn btn-success" href="index.php" role="button">Kembali</a>
            </form>
        </div>
    </div>
</body>

</html>