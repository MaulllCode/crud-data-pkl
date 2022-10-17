<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crud | Form Tambah Data</title>
    <link href="bootstraps/css/bootstrap.css" rel="stylesheet">
    <script src="bootstraps/js/bootstrap.bundle.min.js"></script>
    <script src="bootstraps/js/bootstrap.min.js"></script>
    <script src="bootstraps/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="bootstraps/style/style.css" type="text/css" />
    <link rel="shortcut icon" href="gambar/logophp.png">
    <script src="https://kit.fontawesome.com/d0157de78d.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h1>Form Tambah Data</h1>
        </div>
        <div class="card-body">
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

            if (isset($_POST['tambah_data'])) {

                $nama = $_POST['nama'];
                $alamat = $_POST['alamat'];
                $email = $_POST['email'];
                $no = $_POST['no'];
                $kota = $_POST['kota'];
                $jk = $_POST['jk'];

                $jumlahFile = count($_FILES['file_gambar']['name']);

                foreach ($_FILES['file_gambar']['name'] as $x => $value) {

                    $namafile = $_FILES['file_gambar']['name'][$x];
                    $tipe_file =  array('png', 'jpg', 'jpeg');
                    $tmp = $_FILES['file_gambar']['tmp_name'][$x];
                    $date = date('dMY His');
                    $gbr = $date . '-' . $namafile;

                    $xp = explode('.', $namafile);
                    $ekstensi = strtolower(end($xp));

                    if ($namafile != "") {

                        if (in_array($ekstensi, $tipe_file)) {

                            move_uploaded_file($tmp, 'gambar/' . $gbr);

                            $sql = "INSERT INTO data VALUES (NULL, '$nama[$x]', '$alamat[$x]', '$email[$x]', '$no[$x]', '$kota[$x]', '$jk[$x]', '$gbr')";

                            $result = mysqli_query($kon, $sql);

                            if ($result) {
                                echo "<script>
                                alert('Data berhasil ditambahkan !');
                                window.location.href = 'index.php';
                            </script>";
                            } else {
                                echo "<script>
                                alert('Data gagal ditambahkan !');
                                window.location.href = 'index.php';
                            </script>";
                            }
                        } else {
                            echo "<script>
                        alert('Pastikan menggunakan File Foto !');
                        window.location.href = 'index.php';
                        </script>";
                        }
                    } else {
                        $sql2 = "INSERT INTO data VALUES nama = '$nama', alamat = '$alamat', email = '$email', no = '$no', kota = '$kota', jk = '$jk' =  WHERE id = $id";

                        $result = mysqli_query($kon, $sql2);

                        if ($result) {
                            echo "<script>alert('Data berhasil ditambahkan');window.location.href='index.php';</script>";
                        } else {
                            echo "<script>alert('Data gagal ditambahkan');window.location.href='index.php';</script>";
                        }
                    }
                }
            }

            ?>

            <form action="" method="post" class="form-floating" enctype="multipart/form-data">
                <div class="control-group after-add-more">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama[]" placeholder="Nama lengkap" required pattern="[a-zA-Z\s]{1,50}" oninvalid="this.setCustomValidity('Masukan Nama lengkap dengan benar')" oninput="setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat[]" placeholder="Alamat domisili" required pattern="[a-zA-Z0-9\s]{1,50}" oninvalid="this.setCustomValidity('Masukan Alamat domisili dengan benar')" oninput="setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email[]" placeholder="Email@gmail.com" required pattern="[A-z0-9._%+-]+@[gmail]+\.[com]{2,4}$" oninvalid="this.setCustomValidity('Masukan Alamat email dengan benar')" oninput="setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label>No Telp</label>
                        <input type="tel" pattern="\d{10,15}" class="form-control" name="no[]" placeholder="08XXXXXXXXX" required oninvalid="this.setCustomValidity('Masukan No telp dengan benar')" oninput="setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label>Kota</label>
                        <select class="form-control" name="kota[]" required oninvalid="this.setCustomValidity('Pilih Kota dengan benar')" oninput="setCustomValidity('')">
                            <option value="">-- Pilihan Kota --</option>
                            <?php
                            sort($array_kota);
                            foreach ($array_kota as $kota) {
                                echo "<option value='$kota'>$kota</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="jk[]" required oninvalid="this.setCustomValidity('Pilih Jenis kelamin dengan benar')" oninput="setCustomValidity('')">
                            <option value>-- Pilihan Jenis Kelamin --</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Foto</label>
                        <input class="form-control" type='file' name="file_gambar[]" required oninvalid="this.setCustomValidity('Masukan File foto dengan benar')" oninput="setCustomValidity('')" />
                        <p style="color: red">Pastikan menggunakan File Foto</p>
                    </div>
                    <hr>
                </div>
                <div>
                    <button type="submit" name="tambah_data" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Tambahkan Data</button>
                    <button class="btn btn-info tambah-form" type="button"><i class="fa-solid fa-circle-plus"></i> Tambah Form Data</button>
                    <a class="btn btn-success" href="index.php" role="button"><i class="fa-solid fa-backward-step"></i> Kembali</a>
                </div>
            </form>

            <div class="control-group d-none copy">
                <div class="control-group">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama[]" placeholder="Nama lengkap" required pattern="[a-zA-Z\s]{1,50}" oninvalid="this.setCustomValidity('Masukan Nama lengkap dengan benar')" oninput="setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat[]" placeholder="Alamat domisili" required pattern="[a-zA-Z0-9\s]{1,50}" oninvalid="this.setCustomValidity('Masukan Alamat domisili dengan benar')" oninput="setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email[]" placeholder="Email@gmail.com" required pattern="[A-z0-9._%+-]+@[gmail]+\.[com]{2,4}$" oninvalid="this.setCustomValidity('Masukan Alamat email dengan benar')" oninput="setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label>No Telp</label>
                        <input type="tel" pattern="\d{10,15}" class="form-control" name="no[]" placeholder="08XXXXXXXXXX" required oninvalid="this.setCustomValidity('Masukan No telp dengan benar')" oninput="setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label>Kota</label>
                        <select class="form-control" name="kota[]" required oninvalid="this.setCustomValidity('Pilih Kota dengan benar')" oninput="setCustomValidity('')">
                            <option value="">-- Pilihan Kota --</option>
                            <?php
                            sort($array_kota);
                            foreach ($array_kota as $kota) {
                                echo "<option value='$kota'>$kota</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="jk[]" required oninvalid="this.setCustomValidity('Pilih Jenis kelamin dengan benar')" oninput="setCustomValidity('')">
                            <option value>-- Pilihan Jenis Kelamin --</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Foto</label>
                        <input class="form-control" type="file" name="file_gambar[]" required oninvalid="this.setCustomValidity('Masukan File foto dengan benar')" oninput="setCustomValidity('')" />
                        <p style="color: red">Pastikan menggunakan File Foto</p>
                    </div>
                    <button class="btn btn-danger remove" type="button"><i class="fa fa-trash"></i> Hapus Form</button>
                    <hr>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <small>copyright © 2022 - <strong>maulana</strong></small>
        </div>

    </div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {

        var max = 3;
        $(".tambah-form").click(function() {
            if ($('body').find('.after-add-more').length < max) {
                var html = $(".copy").html();
                $('body').find('.after-add-more:last').after(html);
                alert("Form Berhasil ditambahkan !");
            } else {
                alert('Maximum ' + max + ' groups are allowed.');
            }
        });
        $("body").on("click", ".remove", function() {
            $(this).parents(".control-group").remove();
            alert("Form Berhasil dihapus !");
        });
    });
</script>