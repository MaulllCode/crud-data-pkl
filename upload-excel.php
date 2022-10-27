<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crud | Form Upload Data</title>
    <link href="bootstraps/css/bootstrap.css" rel="stylesheet">
    <script src="bootstraps/js/bootstrap.bundle.min.js"></script>
    <script src="bootstraps/js/bootstrap.min.js"></script>
    <script src="bootstraps/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="bootstraps/style/style.css" type="text/css" />
    <link rel="shortcut icon" href="gambar/logophp.png">
    <link rel="stylesheet" href="fontawesome/css/all.min.css" type="text/css">
</head>

<body>

    <div id="head" class="container-fluid">
        <div class="text-center">
            <h1>Form Upload Data</h1>
        </div>
    </div>

    <div id="body" class="container-fluid">

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

        include 'koneksi.php';
        require 'vendor/autoload.php';

        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


        if (isset($_POST['save_excel_data'])) {

            $filename = $_FILES['import_file']['name'];

            $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

            $allowed_ext = ["xls", "xlsx", "csv", "ods", "xlsx", "xlsm", "xlsb", "xltx", "xltm", "xlt", "xlm", "xlam", "xla", "xlc", "xlw", "xl", "xll"];


            if (in_array($file_ext, $allowed_ext)) {

                $inputFileNamePath = $_FILES['import_file']['tmp_name'];

                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
                $data = $spreadsheet->getActiveSheet()->toArray();

                $count = 0;

                foreach ($data as $row) {

                    if ($count > 0) {
                        $nama = $row[0];
                        $alamat = $row[1];
                        $email = $row[2];
                        $no = $row[3];
                        $kota = $row[4];
                        $jk = $row[5];

                        move_uploaded_file($inputFileNamePath, 'excel/' . $filename . date('dMY His'));

                        $sql = "INSERT INTO data (nama, alamat, email, no, kota, jk) VALUES ('$nama', '$alamat', '$email', '$no', '$kota', '$jk')";

                        $result = mysqli_query($kon, $sql);

                        $msg = true;
                    } else {
                        $count = 1;
                    }
                    // unlink('excel/' . $filename);
                }

                if ($result) {
                    echo "<script>alert('Data berhasil diupload !');window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('Data gagal diupload !');window.location.href='index.php';</script>";
                }
            } else {
                echo "<script>alert('Pastikan menggunakan File Excel !');window.location.href='upload-excel.php';</script>";
            }
        }


        ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group container">
                <label>Masukan File Excel</label>
                <input type="file" name="import_file" class="form-control" required oninvalid="this.setCustomValidity('Pastikan menggunakan File Excel !')" oninput="setCustomValidity('')">
                <p style="color: red">Pastikan menggunakan File Excel !</p>
                <hr>
                <button type="submit" name="save_excel_data" class="btn btn-primary"><i class="fa-solid fa-file-arrow-up"></i> Upload</button>
                <a class="btn btn-info" href="excel/template.xls" role="button"><i class="fa-solid fa-file-arrow-down"></i> Download template</a>
                <a class="btn btn-success" href="index.php" role="button"><i class="fa-solid fa-backward-step"></i> Kembali</a>
            </div>
        </form>
    </div>

</body>

<footer id="footer" class="container-fluid position-absolute bottom-0 start-50 translate-middle-x">
    <small>&copy; 2022 - <strong>maulana adji sentosa</strong></small>
</footer>

</html>