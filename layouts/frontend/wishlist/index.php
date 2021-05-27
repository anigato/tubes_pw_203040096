<?php
session_start();
require_once '../function.php';

$newProducts = query('SELECT * FROM products WHERE stok > 0 ORDER BY date_add DESC LIMIT 4');

$randomProducts = query('SELECT * FROM products WHERE stok > 0 ORDER BY RAND() LIMIT 7');

if (isset($_COOKIE['user_name'])) {
    $_SESSION['user_name'] = $_COOKIE['user_name'];
};

if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
    $user = query("SELECT*FROM users where username = '$user_name'")[0];

    $id_user = $user['id'];
    $wishlist = query("SELECT*FROM wishlists WHERE id_user = $id_user");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta required name="viewport" content="width=device-width, initial-scale=1">

    <?php require_once '../../../themes/frontend/parts/link-head.php' ?>
    <link rel="stylesheet" href="../../../css/frontend/user_style.css">



    <title>ANIGASTORE - Daftar Keinginan</title>
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
                        <h2 class="text-capitalize">Daftar Keinginan Anda</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Produk Terbaru</h2>
                        <?php foreach ($newProducts as $row) : ?>
                            <hr>
                            <div class="thubmnail-recent">
                                <img src="../../../assets/img/products/<?= $row["img"] ?>" alt="<?= $row["img"] ?>" class="img-tumbnail rounded recent-thumb">
                                <h2><a class="text-uppercase" href="../product/detail.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></h2>
                                <div class="product-sidebar-price">
                                    <ins><?= rupiah($row["price"]); ?></ins>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3>Daftar Keinginan</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-condensed">
                                    <tr>
                                        <td>Foto</td>
                                        <td>Nama</td>
                                        <td>Harga</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php foreach ($wishlist as $wish) : ?>

                                        <?php
                                        $id = $wish['id_product'];
                                        $product = query("SELECT*FROM products where id = $id");
                                        ?>

                                        <?php foreach ($product as $row) : ?>
                                            <tr>
                                                <td><img src="../../../assets/img/products/<?= $row['img'] ?>" class="rounded" width="70" alt=""></td>
                                                <td><a href="../product/detail.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></td>
                                                <td><?= rupiah($row['price']) ?></td>
                                                <td>
                                                    <a href="../wishlist/delete.php?id_user=<?= $id_user ?>&id_product=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
                                                </td>
                                                <td>
                                                    <form method="post" action="../cart/index.php" class="cart">
                                                        <div class="quantity">
                                                            <input type="hidden" name="id_product" value="<?= $row["id"] ?>">
                                                            <input type="hidden" name="img" value="<?= $row["img"] ?>">

                                                            <input type="hidden" id="qty" name="qty" value="1">
                                                            <button type="submit" class="btn btn-sm btn-primary add_to_cart_button"><i class="fas fa-cart-plus"></i></button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>

                                </table>
                            </div>
                        </div>
                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">Mungkin Kamu Suka</h2>
                            <div class="related-products-carousel">
                                <?php foreach ($randomProducts as $row) : ?>
                                    <?php if (isset($_SESSION['user_name'])) : ?>
                                        <?php foreach ($wishlist as $wish) : ?>
                                            <?php if ($wish['id_product'] == $row['id']) : ?>
                                                <div class="single-product">
                                                    <div class="product-f-image">
                                                        <img src="../../../assets/img/products/<?= $row['img'] ?>" alt="">
                                                        <div class="product-hover">
                                                            <a href="../wishlist/delete.php?id_user=<?= $id_user ?>&id_product=<?= $row['id'] ?>" class="add-to-wish-link wishlist"><i class="fas fa-heart" style="color: red;"></i></a>

                                                            <a href="../product/detail.php?id=<?= $row['id'] ?>" class="view-details-link"><i class="fa fa-link"></i> Lihat Detail</a>
                                                        </div>
                                                    </div>

                                                    <h2><a class="text-uppercase" href="../product/detail.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></h2>

                                                    <div class="product-carousel-price">
                                                        <h2><ins><?= rupiah($row["price"]); ?></ins></h2>
                                                    </div>
                                                </div>
                                                <?php continue 2; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <div class="single-product">
                                            <div class="product-f-image">
                                                <img src="../../../assets/img/products/<?= $row['img'] ?>" alt="">
                                                <div class="product-hover">
                                                    <a href="../wishlist/add.php?id_user=<?= $id_user ?>&id_product=<?= $row['id'] ?>" class="add-to-wish-link wishlist"><i class="far fa-heart" style="color: red;"></i></a>

                                                    <a href="../product/detail.php?id=<?= $row['id'] ?>" class="view-details-link"><i class="fa fa-link"></i> Lihat Detail</a>
                                                </div>
                                            </div>

                                            <h2><a class="text-uppercase" href="../product/detail.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></h2>

                                            <div class="product-carousel-price">
                                                <h2><ins><?= rupiah($row["price"]); ?></ins></h2>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="single-product">
                                            <div class="product-f-image">
                                                <img src="../../../assets/img/products/<?= $row['img'] ?>" alt="">
                                                <div class="product-hover">
                                                    <a href="../product/detail.php?id=<?= $row['id'] ?>" class="view-details-link"><i class="fa fa-link"></i> Lihat Detail</a>
                                                </div>
                                            </div>

                                            <h2><a class="text-uppercase" href="../product/detail.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></h2>

                                            <div class="product-carousel-price">
                                                <h2><ins><?= rupiah($row["price"]); ?></ins></h2>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                </div>
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
                    type:'success',
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
                    type:'error',
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
                    type:'error',
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