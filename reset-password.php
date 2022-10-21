<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crud | Form Reset Password</title>
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
            <h1>Form Reset Password</h1>
        </div>
        <div class="card-body">

            <?php
            session_start();
            include 'koneksi.php';
            ?>

            <form action="" method="post" class="container form-floating" enctype="multipart/form-data">
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
        <div class="card-footer">
            <small>copyright © 2022 - <strong>maulana</strong></small>
        </div>
    </div>
</body>

</html>