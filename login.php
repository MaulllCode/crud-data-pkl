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
    <!-- <link rel="stylesheet" href="bootstraps/style/style.css" type="text/css" /> -->
    <link rel="shortcut icon" href="gambar/logophp.png">
    <!-- <meta http-equiv="refresh" content="10" /> -->
    <script src="https://kit.fontawesome.com/d0157de78d.js" crossorigin="anonymous"></script>
</head>

<body>

    <div id="head" class="text-bg-dark p-3">
        <div class="text-center">
            <h1>Form Login</h1>
        </div>
    </div>

    <div id="body" class="container p-3">

        <?php
        session_start();
        include 'koneksi.php';

        if (isset($_SESSION['login'])) {
            echo "<script>alert('Anda telah Login!');window.location.href='index.php';</script>";
        }

        //jika rememberme di klik
        if (!empty($_POST["remember"])) {
            //buat cookie
            setcookie("username", $_POST["username"], time() + (3600 * 365 * 24 * 60 * 60));
            setcookie("password", $_POST["password"], time() + (3600 * 365 * 24 * 60 * 60));
        } else {
            if (isset($_COOKIE["username"])) {
                setcookie("username", "");
            }
            if (isset($_COOKIE["password"])) {
                setcookie("password", "");
            }
        }

        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $result = mysqli_query($kon, $sql);

            if ($result > 0) {

                $data = mysqli_fetch_assoc($result);

                // cek jika user login sebagai admin
                if ($data['level'] == "admin") {

                    // buat session login dan username
                    $_SESSION['username'] = $username;
                    $_SESSION['level'] = "admin";
                    $_SESSION['login'] = 1;
                    // alihkan ke halaman dashboard admin
                    echo "<script>alert('Selamat, Login berhasil sebagai Admin!');window.location.href='index.php';</script>";

                    // cek jika user login sebagai pegawai
                } else if ($data['level'] == "user") {
                    // buat session login dan username
                    $_SESSION['username'] = $username;
                    $_SESSION['level'] = "user";
                    $_SESSION['login'] = 1;
                    // alihkan ke halaman dashboard pegawai
                    echo "<script>alert('Selamat, Login berhasil sebagai User!');window.location.href='home.php';</script>";
                } else {
                    echo "<script>alert('Email atau password Anda salah atau belum terdaftar. Silahkan coba lagi!');window.location.href='login.php';</script>";
                }
                $_SESSION['username'] = $row['username'];
                echo "<script>alert('Selamat, Login berhasil!');window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('2Email atau password Anda salah atau belum terdaftar. Silahkan coba lagi!')</script>;window.location.href='login.php';";
            }
        }
        ?>

        <form action="" method="post" class="form-floating" enctype="multipart/form-data">
            <div class="control-group after-add-more">
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email@gmail.com" required pattern="[A-z0-9._%+-]+@[gmail]+\.[com]{2,4}$" oninvalid="this.setCustomValidity('Masukan Alamat email dengan benar')" oninput="setCustomValidity('')">
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Passowrd" required oninvalid="this.setCustomValidity('Masukan Password dengan benar')" oninput="setCustomValidity('')">
                </div>
                <hr>
            </div>
            <div class="input-group mb-2">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember" id="remember" <?php if (isset($_COOKIE["username"])) { ?> checked <?php } ?>>
                        <label class="custom-control-label" for="customCheck1">Ingat saya?</label>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <button type="submit" name="login" class="btn btn-primary"><i class="fa-solid fa-right-to-bracket"></i> Masuk</button>
                </div>
                <div class="col d-flex align-item-center mt-2">
                    <p>Anda belum punya akun? <a href="register.php">Daftar</a></p>
                </div>
            </div>
        </form>
    </div>

    <div id="footer" class="text-bg-dark p-3">
        <div class="text-center">
            <small>&copy; 2022 - <strong>maulana adji sentosa</strong></small>
        </div>
        <!-- <div class="row">
            <div class="col justify-content-start">
                <small>© 2022 - <strong>maulana adji sentosa</strong></small>
            </div>
            <div class="col d-flex align-items-center justify-content-end">
                <a href="#" target="_blank"><i class="fa-brands fa-telegram"></i></a>
                <a href="#" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div> -->
    </div>

</body>

</html>