<?php
session_start();
require '../../php/function.php';
// require 'function.php';

// cek user jika login lanjutkan jika ya redirect ke halaman admin
if (isset($_SESSION['username'])) {
    header("Location: dashboard/index.php");
    exit;
}

// cek cookie
if (isset($_COOKIE['username']) && isset($_COOKIE['hash']) && isset($_COOKIE['img'])) {
    $username = $_COOKIE['username'];
    $hash = $_COOKIE['hash'];
    $img = $_COOKIE['img'];

    //ambil username berdasarkan id
    $res = mysqli_query(koneksi(), "select*from user_admin where username = '$username'");
    $row = mysqli_fetch_assoc($res);

    //cehk cookie dan username
    if ($hash === hash('sha256', $row['id'], false)) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['hash'] = hash('sha256', $row['id'], false);
        $_SESSION['img'] = $row['img'];
        header("Location: dashboard/index.php");
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

    <!-- sweetalert -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet">
    </link>
    <link crossorigin="anonymous" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" rel="stylesheet">
    </link>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

    <!-- custom css -->
    <link rel="stylesheet" href="../../css/backend/login.css">
    <title>Admin Panel - Login</title>
</head>

<body>
    <?php
    //login
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $check_user = mysqli_query(koneksi(), "select*from user_admin where username = '$username'");

        if (mysqli_num_rows($check_user) > 0) {
            $row = mysqli_fetch_assoc($check_user);
            if (password_verify($password, $row["password"])) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['hash'] = hash('sha256', $row['id'], false);
                $_SESSION['img'] = $row['img'];

                // jika rememberme dicentang
                if (isset($_POST['remember'])) {
                    setcookie("username", $row['username'], time() + 86400, "/");
                    $hash = hash('sha256', $row['id']);
                    setcookie("hash", $hash, time() + 86400, "/");
                    setcookie("img", $row['img'], time() + 86400, "/");
                }

                if (hash('sha256', $row['id']) == $_SESSION['hash']) {
                    echo "
                        <script type='text/javascript'>
                            Swal.fire({
                                title:'Success!',
                                text:'Youre log in',
                                type:'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.value) {
                                document.location.href='dashboard/index.php';
                                }
                            })
                        </script>
                    ";
                    die;
                }
                header("Location: ../index.php");
                die;
            }
            echo "
                <script type='text/javascript'>
                    Swal.fire({
                        title:'Error!',
                        text:'Password Wrong',
                        type:'error',
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
        $error = true;
    }
    //error username login
    if (isset($error)) {
        echo "
            <script type='text/javascript'>
                Swal.fire({
                    title:'Error!',
                    text:'Username or Password Wrong',
                    type:'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                })
            </script>
        ";
    }

    ?>
    <div class="login-reg-panel">
        <div class="register-info-box">
            <h2>Are You an Admin on ANIGASTORE?</h2>
            <p>Please log in NOW</p>
        </div>
        <div class="white-panel">
            <div class="login-show">
                <h2>LOGIN</h2>
                <form action="" method="post">
                    <input type="text" placeholder="Username" name="username">
                    <input type="password" placeholder="Password" name="password">
                    <div class="remember">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <button type="submit" name="login" class="submit">Login</button>
                    <a href="">Forgot password?</a>
                </form>
            </div>
        </div>
    </div>
    <script src="../../js/backend/login.js"></script>
</body>

</html>