<?php
session_start();
require_once '../function.php';

$username = $_SESSION['user_name'];
$user = query("SELECT * FROM users WHERE username = '$username'")[0];

$id_user = $user['id'];
$alamat = query("SELECT*FROM address WHERE id_user = $id_user")[0];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta required name="viewport" content="width=device-width, initial-scale=1">

    <?php require_once '../../../themes/frontend/parts/link-head.php' ?>
    <link rel="stylesheet" href="../../../css/frontend/user_style.css">



    <title>ANIGASTORE - Ubah Profile</title>
</head>

<body>

    <?php require_once '../../../themes/frontend/parts/header.php' ?>
    <!-- End header area -->

    <?php require_once '../../../themes/frontend/parts/branding-area.php' ?>
    <!-- End site branding area -->

    <?php require_once '../../../themes/frontend/parts/main-menu.php' ?>
    <!-- End mainmenu area -->

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2 class="text-capitalize">Profil Anda</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Atur Profil Anda</h3>
                </div>
                <div class="card-body">
                    <form class="row needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" required name="id_user" value="<?= $user['id']; ?>">
                        <input type="hidden" required name="id_alamat" value="<?= $alamat['id']; ?>">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="username" value="<?= $user['username']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password (Biarkan jika tidak ingin ubah password)</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="password" value="<?= $user['password']; ?>" id="password">
                                    <div class="invalid-feedback">
                                        Silahkan perbaiki Password.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" required name="full_name" id="full_name" placeholder="Nama Lengkap" value="<?= $user['full_name']; ?>">
                                    <div class="invalid-feedback">
                                        Silahkan perbaiki Nama Lengkap.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Panggilan</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" required name="nick_name" id="nick_name" placeholder="Nama Panggilan" value="<?= $user['nick_name']; ?>">
                                    <div class="invalid-feedback">
                                        Silahkan perbaiki Nama Panggilan.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No Telp</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" required name="phone" id="phone" placeholder="No Telp" value="<?= $user['phone']; ?>">
                                    <div class="invalid-feedback">
                                        Silahkan perbaiki No Telp.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" required name="email" id="email" placeholder="Email" value="<?= $user['email']; ?>">
                                    <div class="invalid-feedback">
                                        Silahkan perbaiki Email.
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-10">
                            <div class="form-group">
                                <label>Nama Rumah / Nomor Rumah</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="additional" id="additional" placeholder="Nama Rumah / Nomor Rumah (Opsional)" value="<?= $alamat['additional']; ?>">
                                    <div class="invalid-feedback">
                                        Silahkan perbaiki Nama Rumah / Nomor Rumah.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Kode POS</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" required name="kode_pos" onkeypress="return onlyNumber(event)" minlength="3" maxlength="6"  id="kode_pos" placeholder="Kode POS" value="<?= $alamat['kode_pos']; ?>">
                                    <div class="invalid-feedback">
                                        Silahkan perbaiki Kode POS.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>RT</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" required name="rt" id="rt" onkeypress="return onlyNumber(event)" minlength="1" maxlength="3"  placeholder="RT" value="<?= $alamat['rt']; ?>">
                                    <div class="invalid-feedback">
                                        Silahkan perbaiki RT.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>RW</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" required name="rw" id="rw" onkeypress="return onlyNumber(event)" minlength="1" maxlength="3"  placeholder="RW" value="<?= $alamat['rw']; ?>">
                                    <div class="invalid-feedback">
                                        Silahkan perbaiki RW.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Dusun</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" required name="dusun" id="dusun" placeholder="Dusun" value="<?= $alamat['dusun']; ?>">
                                    <div class="invalid-feedback">
                                        Silahkan perbaiki Dusun.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Desa</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" required name="desa" id="desa" placeholder="Desa" value="<?= $alamat['desa']; ?>">
                                    <div class="invalid-feedback">
                                        Silahkan perbaiki Userame.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" required name="kecamatan" id="kecamatan" placeholder="Kecamatan" value="<?= $alamat['kecamatan']; ?>">
                                    <div class="invalid-feedback">
                                        Silahkan perbaiki Kecamatan.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kabupaten</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" required name="kabupaten" id="kabupaten" placeholder="Kabupaten" value="<?= $alamat['kabupaten']; ?>">
                                    <div class="invalid-feedback">
                                        Silahkan perbaiki Kabupaten.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" required name="provinsi" id="provinsi" placeholder="Provinsi" value="<?= $alamat['provinsi']; ?>">
                                    <div class="invalid-feedback">
                                        Silahkan perbaiki Provinsi.
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="col-md-12">
                            <label>Foto Profil</label>
                            <div class="custom-file mb-2">
                                <input type="file" class="custom-file-input form-control" name="img" id="img" onchange="showImage(this);">
                                <input type="hidden" name="old_img" value="<?= $user['img']; ?>">
                                <label class="custom-file-label" for="img">Pilih Foto</label>
                                <div class="invalid-feedback">
                                    Silahkan perbaiki Foto Profil
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mx-auto d-block">
                                    <p class="text-center">Foto Baru</p>
                                    <img class="rounded" src="#" alt="" id="show-image" style="width: 100%;">
                                </div>
                                <div class="col-md-3 mx-auto d-block">
                                    <p class="text-center">Foto Lama</p>
                                    <img class="rounded" src="../../../assets/img/users/<?= $user['img']; ?>" alt="" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="form-group ">
                                <button type="submit" class="btn btn-primary  start" name="edit">
                                    <i class="fas fa-upload"></i>
                                    <span> Perbarui Profil</span>
                                </button>
                                <a href="detail.php" class="btn btn-warning  cancel">
                                    <i class="fas fa-times-circle"></i>
                                    <span> Batal</span>
                                </a>
                            </div>
                        </div>
                    </form>
                    <!-- /input-group -->
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    

    <?php require_once '../../../themes/frontend/parts/brands-area.php' ?>
    <!-- End brands area -->

    <?php require_once '../../../themes/frontend/parts/footer.php' ?>
    <!-- End footer bottom area -->

    <?php require_once '../../../themes/frontend/parts/script-body.php' ?>
    <?php
    if (isset($_POST['edit'])) {
        $upload = uploadImage('../../../assets/img/users/', $_POST, 'edit-user');
        if ($upload == "success") {
            echo "
                <script type='text/javascript'>
                
                Swal.fire({
                    title:'Success!',
                    text:'Profil anda berhasil diperbarui',
                    icon:'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                    document.location.href='../user/detail.php';
                    }
                })
                </script>
                ";
        } else if ($upload == "tooLarge") {
            echo "
                <script type='text/javascript'>
                Swal.fire({
                    title:'Error!',
                    text:'Gambar Terllau besar, coba kecilkan ukuran gambar',
                    icon:'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                    document.location.href='../user/detail.php';
                    }
                })
                </script>
                ";
        } else if ($upload == "notImage") {
            echo "
                <script type='text/javascript'>
                Swal.fire({
                    title:'Error!',
                    text:'Hanya gambar JPG, JPEG dan PNG yang diperbolehkan',
                    icon:'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                    document.location.href='../user/detail.php';
                    }
                })
                </script>
            ";
        }
    }

    ?>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        function showImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show-image')
                        .attr('src', e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        // input form khusus nomor
        function onlyNumber(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            } else {
                return true;
            }
        }
    </script>
</body>

</html>