<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crud | Form Registrasi</title>
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
            <h1>Form Registrasi</h1>
        </div>
        <div class="card-body">

            <?php

            session_start();
            include 'koneksi.php';

            if (isset($_SESSION['login'])) {
                echo "<script>alert('Anda telah memiliki akun!');window.location.href='index.php';</script>";
            }

            if (isset($_POST['register'])) {

                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = md5($_POST['password']);
                $cpassword = md5($_POST['cpassword']);

                if ($password == $cpassword) {
                    $sql = "SELECT * FROM users WHERE email='$email'";
                    $result = mysqli_query($kon, $sql);
                    if (!$result->num_rows > 0) {
                        $sql = "INSERT INTO users (username, email, password)
                                VALUES ('$username', '$email', '$password')";
                        $result = mysqli_query($kon, $sql);
                        if ($result) {
                            echo "<script>alert('Selamat, Registrasi berhasil!');window.location.href='login.php';</script>";
                            $username = "";
                            $email = "";
                            $_POST['password'] = "";
                            $_POST['cpassword'] = "";
                        } else {
                            echo "<script>alert('Maaf, Registrasi gagal!');window.location.href='login.php';</script>";
                        }
                    } else {
                        echo "<script>alert('Maaf, email yang anda gunakan telah terdaftar!')</script>";
                    }
                } else {
                    echo "<script>alert('Mohon masukan password dengan sesuai!')</script>";
                }
            }
            ?>

            <form action="" method="post" class="container form-floating" enctype="multipart/form-data">
                <div class="control-group after-add-more">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="username" placeholder="Nama lengkap" required pattern="[a-zA-Z\s]{1,50}" oninvalid="this.setCustomValidity('Masukan Nama lengkap dengan benar')" oninput="setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email@gmail.com" required pattern="[A-z0-9._%+-]+@[gmail]+\.[com]{2,4}$" oninvalid="this.setCustomValidity('Masukan Alamat email dengan benar')" oninput="setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" required oninvalid="this.setCustomValidity('Masukan Password dengan benar')" oninput="setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label>Komfirmasi Password</label>
                        <input type="password" class="form-control" name="cpassword" placeholder="Password" required oninvalid="this.setCustomValidity('Masukan Password dengan benar')" oninput="setCustomValidity('')">
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <button type="submit" name="register" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i> Daftar</button>
                    </div>
                    <div class="col d-flex align-item-center mt-2">
                        <p>Anda sudah punya akun? <a href="login.php">Masuk</a></p>
                    </div>
                </div>
            </form>

        </div>

        <div class="card-footer">
            <small>copyright © 2022 - <strong>maulana</strong></small>
        </div>

    </div>
</body>

</html>