<?php
require '../session_isset.php';
// require '../../../php/function.php';
require '../function.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN Panel | Add New User Admin</title>
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
                            <h1>User Admin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add New User Admin</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Add New User Admin</h3>
                                </div>
                                <div class="card-body">
                                    <form class="row needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="username" id="username" placeholder="username" required>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid Userame.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid Password.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Image</label>
                                                <div class="custom-file mb-2">
                                                    <input type="file" class="custom-file-input form-control" name="img" id="img" onchange="showImage(this);">
                                                    <label class="custom-file-label" for="img">Choose an image (Optional)</label>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3 mx-auto d-block">
                                                        <img class="rounded" src="#" alt="" id="show-image" style="width: 100%;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <button type="submit" class="btn btn-primary  start" name="tambah">
                                                    <i class="fas fa-upload"></i>
                                                    <span> Add New User Admin</span>
                                                </button>
                                                <a href="index.php" class="btn btn-warning  cancel">
                                                    <i class="fas fa-times-circle"></i>
                                                    <span> Cancel</span>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
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

    <!-- bs-custom-file-input -->
    <script src="../../../themes/js/input-form/bs-custom-file-input.min.js"></script>
    <?php require_once '../../../themes/backend/parts/script-body.php' ?>
   

    <?php
    if (isset($_POST['tambah'])) {
        $username = $_POST['username'];
        $res = mysqli_query(koneksi(), "select*from user_admin where username ='$username'");
        if (mysqli_fetch_assoc($res)) {
            echo "
                <script type='text/javascript'>
                    Swal.fire({
                        title:'Error!',
                        text:'Username has been used.',
                        type:'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    })
                </script>
            ";
        } else {
            
            $upload = uploadImage('../../../assets/img/users/',$_POST,'upload-user-admin');
            if ($upload == "success") {
                echo "
                    <script type='text/javascript'>
                    
                    Swal.fire({
                        title:'Success!',
                        text:'New User Admin added Successfully',
                        type:'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                        document.location.href='index.php';
                        }
                    })
                    </script>
                ";
            } else if($upload == "tooLarge") {
                echo "
                    <script type='text/javascript'>
                    Swal.fire({
                        title:'Error!',
                        text:'Your Image is too Large, Please choose another image with minim size',
                        type:'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                        document.location.href='add.php';
                        }
                    })
                    </script>
                ";
            }else if($upload == "notImage") {
                echo "
                    <script type='text/javascript'>
                    Swal.fire({
                        title:'Error!',
                        text:'Only JPG, JPEG and PNG files are allowed',
                        type:'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                        document.location.href='add.php';
                        }
                    })
                    </script>
                ";
            }
        }
    }

    ?>

    <!-- Page specific script -->
    <script>
        // validasi form
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
        // menampilkan gambar ketika dipilih
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
        
        
    </script>
</body>

</html>