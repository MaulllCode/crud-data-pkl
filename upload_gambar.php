<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crud | Form Upload Gambar</title>
    <link href="bootstraps/css/bootstrap.css" rel="stylesheet">
    <script src="bootstraps/js/bootstrap.bundle.min.js"></script>
    <script src="bootstraps/js/bootstrap.min.js"></script>
    <script src="bootstraps/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="bootstraps/style/style.css" type="text/css" />
    <link rel="shortcut icon" href="gambar/logophp.png">
    <script src="https://kit.fontawesome.com/d0157de78d.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="card m-3">
        <div class="card-header">
            <h1>Form Upload Gambar</h1>
        </div>
        <div class="card-body">

            <?php

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

            // Check if image file is a actual image or fake image
            if (isset($_POST["upload_gambar"])) {

                $target_dir = "gambar/";
                $target_file = $target_dir . 'gambar' . '.' . basename($_FILES["gambar"]["name"]);
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                $check = getimagesize($_FILES["gambar"]["tmp_name"]);
                if ($check !== false) {
                    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                        echo "<script>alert('Foto berhasil diupload !');window.location.href='index.php';</script>";
                    } else {
                        echo "<script>alert('Foto gagal diupload !');window.location.href='index.php';</script>";
                    }
                } else {
                    echo "<script>alert('Pastikan menggunakan File Gambar !');window.location.href='index.php';</script>";
                }
            }


            ?>

            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Masukan File Foto</label>
                    <input type="file" name="gambar" class="form-control" required>
                    <p style="color: red">Pastikan menggunakan File Foto !</p>
                    <hr>
                    <button type="submit" name="upload_gambar" class="btn btn-primary">Upload</button>
                    <a class="btn btn-success" href="index.php" role="button">Kembali</a>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <small>copyright © 2022 - <strong>maulana</strong></small>
        </div>
    </div>
</body>

</html>