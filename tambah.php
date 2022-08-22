<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crud Tambah Data | Maulana adji sentosa</title>
    <link href="bootstraps/css/bootstrap.css" rel="stylesheet">
    <script src="bootstraps/js/bootstrap.bundle.min.js"></script>
    <script src="bootstraps/js/bootstrap.min.js"></script>
    <script src="bootstraps/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="style/style.css" />

</head>

<body>
    <div class="card">
        <div class="card-header">
            <h1>Form Tambah Data</h1>
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
                    $tmp = $_FILES['file_gambar']['tmp_name'][$x];
                    $tipe_file = $_FILES['file_gambar']['type'][$x];
                    $ukuran = $_FILES['file_gambar']['size'][$x];

                    if ($ukuran > 2097152) {
                        echo "<script>
                        alert('Ukuran Foto terlalu besar !');
                        window.location.href = 'index.php';
                    </script>";
                    } else {

                        $ekstensi =  array('png', 'jpg', 'jpeg');
                        $date = date('dmY His');
                        $gbr = $date . '-' . $namafile;

                        if (in_array($tipe_file, $ekstensi)) {
                            echo "<script>
                        alert('Pastikan menggunakan File Foto !');
                        window.location.href = 'index.php';
                        </script>";
                        } else {

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
                        }
                    }
                }
            }
            ?>

            <form action="" method="post" class="form-floating" enctype="multipart/form-data">
                <div class="control-group after-add-more">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama[]" placeholder="Masukan Nama" required>
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat[]" placeholder="Masukan Alamat" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email[]" placeholder="Masukan Email" required>
                    </div>
                    <div class="mb-3">
                        <label>No Telp</label>
                        <input type="text" class="form-control" name="no[]" placeholder="Masukan No Telp" required>
                    </div>
                    <div class="mb-3">
                        <label>Kota</label>
                        <select class="form-control" name="kota[]" required>
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
                        <select class="form-control" name="jk[]" required>
                            <option value>-- Pilihan Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Foto</label>
                        <input class="form-control" type='file' name="file_gambar[]" required />
                        <p style="color: red">Pastikan menggunakan File Foto</p>
                    </div>
                    <hr>
                </div>
                <button type="submit" name="tambah_data" class="btn btn-primary">Tambahkan Data</button>
                <button class="btn btn-info tambah-form" type="button">Tambah Form Data</button>
                <a class="btn btn-success" href="index.php" role="button">Kembali</a>
            </form>

            <div class="d-none copy">
                <div class="control-group ">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama[]" placeholder="Masukan Nama" required>
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat[]" placeholder="Masukan Alamat" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email[]" placeholder="Masukan Email" required>
                    </div>
                    <div class="mb-3">
                        <label>No Telp</label>
                        <input type="text" class="form-control" name="no[]" placeholder="Masukan No Telp" required>
                    </div>
                    <div class="mb-3">
                        <label>Kota</label>
                        <select class="form-control" name="kota[]" required>
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
                        <select class="form-control" name="jk[]" required>
                            <option value>-- Pilihan Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Foto</label>
                        <input class="form-control" type="file" name="file_gambar[]" required />
                        <p style="color: red">Pastikan menggunakan File Foto</p>
                    </div>
                    <button class="btn btn-danger remove" type="button">Hapus Form</button>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $(".tambah-form").click(function() {
            var html = $(".copy").html();
            $(".after-add-more").after(html);
            alert("Form Berhasil ditambahkan !");
        });
        $("body").on("click", ".remove", function() {
            $(this).parents(".control-group").remove();
            alert("Form Berhasil dihapus !");
        });
    });
</script>