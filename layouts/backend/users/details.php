<?php
require '../session_isset.php';
// require '../../../php/function.php';
require '../function.php';
$id = $_GET['id'];
$user = query("SELECT * FROM users WHERE id = '$id'")[0];
$alamat = query("SELECT*FROM address WHERE id_user = $id")[0];
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN Panel</title>
    <?php require_once '../../../themes/backend/parts/link-header.php' ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php require_once '../../../themes/backend/parts/navbar.php'; ?>
        <!-- endnavbar -->

        <!-- sidebar -->
        <?php require_once '../../../themes/backend/parts/sidebar.php'; ?>
        <!-- endsidebar -->

        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Order Details</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">List All order</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row gutters-sm">
                        <div class="col-lg-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <?php if (empty($user["img"])) : ?>
                                            <div class="mx-auto">
                                                <?= getProfilePicture($user["username"]) ?>
                                            </div>
                                        <?php else : ?>
                                            <img src="../../../assets/img/users/<?= $user["img"]; ?>" alt="" class="img-tumbnail img-circle" width="35rem">
                                        <?php endif ?>

                                        <div class="mt-3">
                                            <h4><?= $user['username'] ?></h4>
                                            <p class="text-secondary mb-1"><?= $user['full_name'] ?></p>
                                            <p class="text-muted font-size-sm"><?= $user['phone'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="mb-0">Username</h6>
                                        </div>
                                        <div class="col-md-7 text-secondary"><?= $user['username'] ?></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="mb-0">Nama Lengkap</h6>
                                        </div>
                                        <div class="col-md-7 text-secondary"><?= (empty($user['full_name'])) ? "Belum Diatur" : $user['full_name']; ?></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="mb-0">Nama Panggilan</h6>
                                        </div>
                                        <div class="col-md-7 text-secondary"><?= (empty($user['nick_name'])) ? "Belum Diatur" : $user['nick_name']; ?></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-md-7 text-secondary"><?= (empty($user['email'])) ? "Belum Diatur" : $user['email']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row gutters-sm">
                                <div class="col-md-12 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Alamat</i>Pengiriman Anda</h6>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <h6 class="mb-0">Nama / Nomor Rumah</h6>
                                                </div>
                                                <div class="col-md-7 text-secondary"><?= (empty($alamat['additional'])) ? "Belum Diatur" : $alamat['additional']; ?></div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <h6 class="mb-0">Nomor Telp.</h6>
                                                </div>
                                                <div class="col-md-7 text-secondary"><?= (empty($user['phone'])) ? "Belum Diatur" : $user['phone']; ?></div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <h6 class="mb-0">RT</h6>
                                                </div>
                                                <div class="col-md-7 text-secondary"><?= (empty($alamat['rt'])) ? "Belum Diatur" : $alamat['rt']; ?></div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <h6 class="mb-0">RW</h6>
                                                </div>
                                                <div class="col-md-7 text-secondary"><?= (empty($alamat['rw'])) ? "Belum Diatur" : $alamat['rw']; ?></div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <h6 class="mb-0">Dusun</h6>
                                                </div>
                                                <div class="col-md-7 text-secondary"><?= (empty($alamat['dusun'])) ? "Belum Diatur" : $alamat['dusun']; ?></div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <h6 class="mb-0">Desa</h6>
                                                </div>
                                                <div class="col-md-7 text-secondary"><?= (empty($alamat['desa'])) ? "Belum Diatur" : $alamat['desa']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <h6 class="mb-0">Kecamatan</h6>
                                                </div>
                                                <div class="col-md-7 text-secondary"><?= (empty($alamat['kecamatan'])) ? "Belum Diatur" : $alamat['kecamatan']; ?></div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <h6 class="mb-0">Kabupaten</h6>
                                                </div>
                                                <div class="col-md-7 text-secondary"><?= (empty($alamat['kabupaten'])) ? "Belum Diatur" : $alamat['kabupaten']; ?></div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <h6 class="mb-0">Provinsi</h6>
                                                </div>
                                                <div class="col-md-7 text-secondary"><?= (empty($alamat['provinsi'])) ? "Belum Diatur" : $alamat['provinsi']; ?></div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <h6 class="mb-0">Kode POS</h6>
                                                </div>
                                                <div class="col-md-7 text-secondary"><?= (empty($alamat['kode_pos'])) ? "Belum Diatur" : $alamat['kode_pos']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- end main content -->


        <!-- footer -->
        <?php require_once '../../../themes/backend/parts/footer.php'; ?>
        <!-- endfooter -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

    </div>


    <?php require_once '../../../themes/backend/parts/script-body.php' ?>
    <!-- Page specific script -->
    <?php
    if (isset($_POST['process'])) {
        $process = process($_POST);
        if ($process == "ok") {
            echo "
                <script type='text/javascript'>
                var getLink = '../orders/detail.php?id=" . $id_order . "';
                Swal.fire({
                    title:'Success!',
                    text:'Order has been Processed',
                    type:'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    window.location.href = getLink;
                })
                </script>
                ";
        }
    }

    if (isset($_POST['send'])) {
        $send = send($_POST);
        if ($send == "ok") {
            echo "
                <script type='text/javascript'>
                var getLink = '../orders/detail.php?id=" . $id_order . "';
                Swal.fire({
                    title:'Success!',
                    text:'Order has been shipped',
                    type:'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    window.location.href = getLink;
                })
                </script>
                ";
        }
    }

    ?>
</body>

</html>