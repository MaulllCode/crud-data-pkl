<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crud | Form Login</title>
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
            <h1>Form Login</h1>
        </div>
    </div>

    <div id="body" class="container-fluid">

        <?php
        session_start();
        include 'koneksi.php';

        if (isset($_SESSION['login'])) {
            echo "<script>alert('Anda telah Login!');window.location.href='index.php';</script>";
        }

        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $result = mysqli_query($kon, $sql);

            if ($result) {

                $data = mysqli_fetch_assoc($result);

                // cek jika user login sebagai admin
                if ($data['level'] == "admin") {

                    // buat session login dan username
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['level'] = "admin";
                    $_SESSION['login'] = 1;
                    // alihkan ke halaman dashboard admin
                    echo "<script>alert('Selamat, Login berhasil sebagai Admin!');window.location.href='index.php';</script>";

                    // cek jika user login sebagai pegawai
                } else if ($data['level'] == "user") {
                    // buat session login dan username
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['level'] = "user";
                    $_SESSION['login'] = 1;
                    // alihkan ke halaman dashboard pegawai
                    echo "<script>alert('Selamat, Login berhasil sebagai User!');window.location.href='home.php';</script>";
                } else {
                    echo "<script>alert('Email atau password Anda salah atau belum terdaftar. Silahkan coba lagi!');window.location.href='login.php';</script>";
                }
                $_SESSION['username'] = $data['username'];
                echo "<script>alert('Selamat, Login berhasil!');window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('2Email atau password Anda salah atau belum terdaftar. Silahkan coba lagi!')</script>;window.location.href='login.php';";
            }
        }
        ?>

        <div class="card shadow-lg rounded container position-absolute top-50 start-50 translate-middle" style="height: auto; width: 400px;">
            <form action="" method="post" class="form-floating" enctype="multipart/form-data">
                <div class="control-group after-add-more">
                    <div class="mb-3 mt-3">
                        <label>Masukan Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email@gmail.com" required pattern="[A-z0-9._%+-]+@[gmail]+\.[com]{2,4}$" oninvalid="this.setCustomValidity('Masukan Alamat email dengan benar')" oninput="setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label>Masukan Kata sandi</label>
                        <input type="password" class="form-control" name="password" placeholder="Kata sandi" required oninvalid="this.setCustomValidity('Masukan Kata sandi dengan benar')" oninput="setCustomValidity('')">
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" name="login" class="btn btn-primary"><i class="fa-solid fa-right-to-bracket"></i> Masuk</button>
                </div>
                <hr>
                <div class="text-center">
                    <p>Anda belum punya akun? <a href="register.php">Daftar</a></p>
                </div>
            </form>
        </div>
    </div>

</body>

<footer id="footer" class="container-fluid position-absolute bottom-0 start-50 translate-middle-x">
    <small>&copy; 2022 - <strong>maulana adji sentosa</strong></small>
</footer>

</html>