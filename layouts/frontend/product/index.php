<?php
session_start();
require_once '../function.php';


$newProducts = query('SELECT * FROM products WHERE stok > 0 ORDER BY date_add DESC LIMIT 10');

$randomProducts = query('SELECT * FROM products WHERE stok > 0 ORDER BY RAND() LIMIT 10');

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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ANIGASTORE</title>

    <?php require_once '../../../themes/frontend/parts/link-head.php' ?>

</head>

<body>

    <?php require_once '../../../themes/frontend/parts/header.php' ?>
    <!-- End header area -->

    <?php require_once '../../../themes/frontend/parts/branding-area.php' ?>
    <!-- End site branding area -->

    <?php require_once '../../../themes/frontend/parts/main-menu.php' ?>
    <!-- End mainmenu area -->

    <div class="container">
        <?php require_once '../../../themes/frontend/parts/slidder.php' ?>
    </div>
    <!-- End slider area -->

    <?php require_once '../../../themes/frontend/parts/promo.php' ?>
    <!-- End promo area -->

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Produk Baru</h2>
                        <div class="product-carousel">
                            <?php foreach ($newProducts as $row) : ?>
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
                    <div class="latest-product mt-5">
                        <h2 class="section-title">Mungkin Kamu Suka</h2>
                        <div class="product-carousel">
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

    <?php require_once '../../../themes/frontend/parts/brands-area.php' ?>
    <!-- End brands area -->

    <!-- <?php require_once '../../../themes/frontend/parts/widget.php' ?> -->
    <!-- End product widget area -->

    <?php require_once '../../../themes/frontend/parts/footer.php' ?>
    <!-- End footer bottom area -->
    <?php require_once '../../../themes/frontend/parts/script-body.php' ?>
    
    <!-- Slider -->
    <script type="text/javascript" src="../../../themes/frontend/js/bxslider.min.js"></script>
    <script type="text/javascript" src="../../../themes/frontend/js/script.slider.js"></script>
    
</body>
</html>