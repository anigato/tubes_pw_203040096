<?php
session_start();
require_once '../function.php';

// cek user jika login lanjutkan jika ya redirect ke halaman admin
if (isset($_SESSION['user_name'])) {
    header("Location: ../product/index.php");
    exit;
}

// cek cookie
if (isset($_COOKIE['user_name']) && isset($_COOKIE['user_hash'])) {
    $username = $_COOKIE['user_name'];
    $hash = $_COOKIE['user_hash'];

    //ambil username berdasarkan id
    $res = mysqli_query(koneksi(), "select*from users where username = '$username'");
    $row = mysqli_fetch_assoc($res);

    //cehk cookie dan username
    if ($hash === hash('sha256', $row['id'], false)) {
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['user_hash'] = hash('sha256', $row['id'], false);
        header("Location: ../product/index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link crossorigin="anonymous" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" rel="stylesheet">
    </link>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../../../css/frontend/login.css">
    <title>ANIGASTORE - Login</title>
</head>

<body>
    <?php
    //login
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $check_user = mysqli_query(koneksi(), "select*from users where username = '$username'");

        if (mysqli_num_rows($check_user) > 0) {
            $row = mysqli_fetch_assoc($check_user);
            if (password_verify($password, $row["password"])) {
                $_SESSION['user_name'] = $_POST['username'];
                $_SESSION['user_hash'] = hash('sha256', $row['id'], false);

                if (isset($_POST['remember'])) {
                    setcookie("user_name", $row['username'], time() + 86400, "/");
                    $hash = hash('sha256', $row['id']);
                    setcookie("user_hash", $hash, time() + 86400, "/");
                }

                if (hash('sha256', $row['id']) == $_SESSION['user_hash']) {
                    echo "
                        <script type='text/javascript'>
                            Swal.fire({
                                title:'Success!',
                                text:'Anda Berhasil Masuk',
                                icon:'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.value) {
                                document.location.href='../product/index.php';
                                }
                            })
                        </script>
                    ";
                    die;
                }
                header("Location: ../user/login.php");
                die;
            } else {
                echo "
                <script type='text/javascript'>
                    Swal.fire({
                        title:'Maaf!',
                        text:'Password Salah',
                        icon:'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                        document.location.href='login.php';
                        }
                    })
                </script>
            ";
                die;
            }
        }
        $error = true;
    }

    //error username login
    if (isset($error)) {
        echo "
            <script type='text/javascript'>
                Swal.fire({
                    title:'Error!',
                    text:'Username atau Password Salah',
                    icon:'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                })
            </script>
        ";
    }

    //registrasi
    if (isset($_POST['register'])) {
        // cek username sudah ada atu belum
        $username = $_POST['username'];
        $res = mysqli_query(koneksi(), "select*from users where username ='$username'");
        if (mysqli_fetch_assoc($res)) {
            echo "
                <script type='text/javascript'>
                    Swal.fire({
                        title:'Error!',
                        text:'Username sudah digunakan, jika anda sudah memiliki akun, silahkan Masuk',
                        icon:'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    })
                </script>
            ";
        } else {
            $register = registrasi_user($_POST);
            if ($register == "success") {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $result = mysqli_query(koneksi(), "select*from users where username ='$username'");
                // validasi username dan passord
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    if (password_verify($password, $row['password'])) {
                        $_SESSION['user_name'] = $_POST['username'];
                        $_SESSION['user_hash'] = hash('sha256', $row['id'], false);

                        if (hash('sha256', $row['id']) == $_SESSION['user_hash']) {
                            echo "
                                <script type='text/javascript'>
                                    Swal.fire({
                                        title:'Success!',
                                        text:'Anda Berhasil Mendaftar',
                                        icon:'success',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.value) {
                                        document.location.href='../product/index.php';
                                        }
                                    })
                                </script>
                            ";
                            die;
                        }
                        header("Location: login.php");
                        die;
                    }
                }
            } else if ($register == "notAlfabet") {
                echo "
                <script type='text/javascript'>
                    Swal.fire({
                        title:'Error!',
                        text:'Username Hanya boleh huruf A-Z, a-z dan angka 0-9',
                        icon:'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    })
                </script>
            ";
            } else {
                echo "
                    <script type='text/javascript'>
                        Swal.fire({
                            title:'Error!',
                            text:'Silahkan Cek Form Lagi',
                            icon:'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        })
                    </script>
                ";
            }
        }
    }

    ?>
    <div class="login-reg-panel">
        <div class="login-info-box">
            <h2>Anda Memiliki Akun?</h2>
            <p>Klik tombol dibawah untuk masuk</p>
            <label id="label-register" for="log-reg-show">Masuk</label>
            <input type="radio" name="active-log-panel" id="log-reg-show" checked="checked">
        </div>

        <div class="register-info-box">
            <h2>Tidak memiliki Akun?</h2>
            <p>Daftar sekarang dengan klik tombol dibawah</p>
            <label id="label-login" for="log-login-show">Daftar</label>
            <input type="radio" name="active-log-panel" id="log-login-show">
        </div>

        <div class="white-panel">
            <div class="login-show">
                <h2><a href="../../backend/login.php">MASUK</a></h2>
                <form action="" method="post">
                    <input type="text" required placeholder="Username" name="username">
                    <input type="password" required placeholder="Password" name="password">
                    <div class="remember">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Ingat Saya</label>
                    </div>
                    <button type="submit" name="login" class="submit">Masuk</button>
                    <a href="">Lupa password?</a>
                </form>
                <div class="panel-small-device">
                    <h2>Tidak memiliki Akun?</h2>
                    <p>Daftar sekarang dengan klik tombol dibawah</p>
                    <label id="label-login" for="log-login-show">Daftar</label>
                    <input type="radio" name="active-log-panel" id="log-login-show">
                </div>
            </div>
            <div class="register-show">
                <h2>DAFTAR</h2>
                <form action="" method="post">
                    <input type="text" required placeholder="Username" name="username">
                    <input type="password" required placeholder="Password" name="password">
                    <!-- <input type="password" required placeholder="Confirm Password" name="confirm_password"> -->
                    <button type="submit" name="register" class="submit">Daftar</button>
                </form>
                <div class="panel-small-device">
                    <h2>Anda Memiliki Akun?</h2>
                    <p>Klik tombol dibawah untuk masuk</p>
                    <label id="label-register" for="log-reg-show">Masuk</label>
                    <input type="radio" name="active-log-panel" id="log-reg-show" checked="checked">
                </div>
            </div>
        </div>
    </div>
    <script src="../../../js/backend/login.js"></script>
</body>

</html>