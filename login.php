<?php
// kita cek apakah user sudah berhasil login apa belum / sessionnya sudah dijalankan apa belum
// jika belum login akan ditendang di halaman login
session_start();
// jika sudah login maka tidak boleh ke hal login karena sudah masuk
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require 'login/functions.php';

// apakah tombol login sudah ditekan apa belum;
if (isset($_POST["login"])) {
    // mengambil data lewat post;
    $username = $_POST["username"];
    $password = $_POST["password"];

    // pengecekan username apakah sudah terdaftar didatabase;
    $result = mysqli_query($link, "SELECT * FROM admin WHERE username='$username' and password='$password'");
    // $result1 = mysqli_query($link, "SELECT * FROM laboran WHERE username='$username' and password='$password'");
    // $result2 = mysqli_query($link, "SELECT * FROM kepala_laboran WHERE username='$username' and password='$password'");


    // cek username 
    // jika hasilnya 1 maka ada username , dan lanjut pengecekan password
    if (mysqli_num_rows($result) == 1) {
        // set dulu sessionya

        $_SESSION["login"] = true;
        $_SESSION["akun"] = mysqli_fetch_assoc($result);
        // tendang jika benar
        header("Location: index.php");
        exit;
    } else {
        $result2 = mysqli_query($link, "SELECT * FROM laboran WHERE username='$username' and password='$password'");
        if (mysqli_num_rows($result2) == 1) {
            // set dulu sessionya

            $_SESSION["login"] = true;
            $_SESSION["akun"] = mysqli_fetch_assoc($result2);
            // tendang jika benar
            header("Location: index.php");
            exit;
        } else {
            $result3 = mysqli_query($link, "SELECT * FROM kepala_laboran WHERE username='$username' and password='$password'");
            if (mysqli_num_rows($result3) == 1) {
                // set dulu sessionya

                $_SESSION["login"] = true;
                $_SESSION["akun"] = mysqli_fetch_assoc($result3);
                // tendang jika benar
                header("Location: index.php");
                exit;
            }
        }
    }


    // jika eror maka keluar dari kondisi;
    $error = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/inventaris.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f5118bf943.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Start Form -->
    <div class="background d-flex align-items-center">
        <div class="form-container">
            <div class="undiksha"></div>
            <h3 class="welcome">Welcome</h3>
            <div class="shape1"></div>
            <div class="shape2"></div>
            <form method="post">
                <div class="new-chat-window">
                    <i class="fa fa-user"></i>
                    <input class="new-chat-window-input form-control" type="text" name="username" id="username"
                        placeholder="Username" required>
                </div>
                <div class="new-chat-window">
                    <i class="fa fa-user-lock"></i>
                    <input class="new-chat-window-input form-control" type="password" name="password" id="password"
                        placeholder="Password" required>
                </div>
                <label class="checkbox" for="remember">
                    <input class="checkbox__input" type="checkbox" name="remember" id="remember">
                    <div class="checkbox__box"></div>
                    Remember me
                </label>
                <button class="button" type="submit" name="login">Login</button>
                <!-- kondisi jika eror -->
                <?php if (isset($error)) : ?>
                <div class="text-center">
                    <span class="error" cstyle="color:red; font-style:italic">username / password yang anda
                        masukan salah
                    </span>
                </div>
                <?php endif; ?>
                <!-- end kondisi eror -->
            </form>
            <div class="footer-login">@web2021rombel3kelompok4@gmail.com</div>
        </div>
    </div>
    <!-- End Form -->
</body>

</html>