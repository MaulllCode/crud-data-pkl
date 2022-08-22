<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crud Import Data | Maulana adji sentosa</title>
    <link href="bootstraps/css/bootstrap.css" rel="stylesheet">
    <script src="bootstraps/js/bootstrap.bundle.min.js"></script>
    <script src="bootstraps/js/bootstrap.min.js"></script>
    <script src="bootstraps/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="style/style.css" />

</head>

<body>
    <div class="card">
        <div class="card-header">
            <h1>Form Import Data</h1>
        </div>
        <div class="card-body">
            <?php

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

                            $sql = "INSERT INTO data (nama, alamat, email, no, kota, jk) VALUES ('$nama', '$alamat', '$email', '$no', '$kota', '$jk')";

                            $result = mysqli_query($kon, $sql);

                            $msg = true;
                        } else {
                            $count = 1;
                        }
                    }

                    if ($result) {
                        echo "<script>alert('Data berhasil diupload !');window.location.href='index.php';</script>";
                    } else {
                        echo "<script>alert('Data gagal diupload !');window.location.href='index.php';</script>";
                    }
                } else {
                    echo "<script>alert('Pastikan menggunakan File Excel !');window.location.href='index.php';</script>";
                }
            }
            ?>

            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Masukan File Excel</label>
                    <input type="file" name="import_file" class="form-control" required>
                    <p style="color: red">Pastikan menggunakan File Excel !</p>
                    <hr>
                    <button type="submit" name="save_excel_data" class="btn btn-primary">Import</button>
                    <a class="btn btn-success" href="index.php" role="button">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>