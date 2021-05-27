<?php
require '../session_isset.php';
// require '../../../php/function.php';
require '../function.php';
$slidder = query("select*from slidders");
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
                            <h1>slidder</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">List All slidder</li>
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
                            <div class="card">

                                <div class="card-header">
                                    <h3 class="card-title">List All slidder</h3>
                                </div>
                                <!-- /.card-header -->

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th>NO</th>
                                                <th>PRODUCT</th>
                                                <th>TITLE</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($slidder as $row) : ?>
                                                <tr class="text-center">
                                                    <td><?= $i++; ?></td>
                                                    <?php
                                                    $id_pro = $row['id_product'];
                                                    $products = query("SELECT * FROM products WHERE id = $id_pro");

                                                    foreach ($products as $pro) :
                                                    ?>
                                                        <td><?= $pro['name']; ?></td>
                                                    <?php endforeach ?>
                                                    <td><?= $row["title"]; ?></td>
                                                    <td>
                                                        <?php
                                                        switch ($row["status"]) {
                                                            case 0:
                                                                echo "Inactive";
                                                                break;
                                                            case 1:
                                                                echo "Active";
                                                                break;
                                                        } ?>
                                                    </td>

                                                    <td rowspan="2" class="row">
                                                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-info col-md-6 update-link">Edit</a>
                                                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger col-md-6 delete-link">Delete</a>
                                                        <?php
                                                        switch ($row["status"]) {
                                                            case 0:
                                                                echo '<a href="status.php?status=1&id='.$row['id'].'" class="btn btn-sm btn-success col-md-12 status-link">Activate</a>';
                                                                break;
                                                            case 1:
                                                                echo '<a href="status.php?status=0&id='.$row['id'].'" class="btn btn-sm btn-warning col-md-12 status-link">Inactivate</a>';
                                                                break;
                                                        } ?>
                                                        
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="text-center">
                                                <th>NO</th>
                                                <th>PRODUCT</th>
                                                <th>TITLE</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card -->
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

    <?php require_once '../../../themes/backend/parts/script-body.php' ?>
    <?php require_once '../../../themes/backend/parts/script-dataTable.php' ?>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        jQuery(document).ready(function($) {
            $('.delete-link').on('click', function() {
                var getLink = $(this).attr('href');

                Swal.fire({
                    title: 'Warning!',
                    text: 'Are you sure you want to delete it? data will be lost',
                    type: 'warning',
                    // html:true,
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, Delete It!',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'One slidder has been deleted',
                            type: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = getLink;
                            }
                        })

                    }
                });
                return false;
            });
        });

        jQuery(document).ready(function($) {
            $('.update-link').on('click', function() {
                var getLink = $(this).attr('href');

                Swal.fire({
                    title: 'Warning!',
                    text: 'Are you sure you want to edit it?',
                    type: 'question',
                    // html:true,
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = getLink;
                    }
                });
                return false;
            });
        });

        jQuery(document).ready(function($) {
            $('.status-link').on('click', function() {
                var getLink = $(this).attr('href');

                Swal.fire({
                    title: 'Warning!',
                    text: 'Are you sure you want to change it?',
                    type: 'question',
                    // html:true,
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = getLink;
                    }
                });
                return false;
            });
        });
    </script>
</body>

</html>