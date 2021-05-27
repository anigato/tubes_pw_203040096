<?php
session_start();
require_once '../function.php';

$search = $_GET['search'];
$keyword = $_GET['keyword'];
switch ($search) {
    case 'all':
        $search = query('SELECT * FROM products ORDER BY RAND()');
        $title = "Semua Produk";
        break;
    case 'category':
        $search = query("SELECT * FROM products WHERE category = '$keyword'");
        $title = "Produk dengan Kategori $keyword";
        break;
    case 'brand':
        $search = query("SELECT * FROM products WHERE id_brand = $keyword");
        $br = query("select name from brands where id=$keyword")[0];
        $title = "Produk dengan Brand " . $br['name'];
        break;
    case 'key':
        $search = query("SELECT * FROM products WHERE name LIKE '%$keyword%' OR category LIKE '%$keyword%' OR capacity LIKE '%$keyword%'");
        $title = "Cari Produk dengan kata kunci '$keyword'";
        break;
}

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

    <?php require_once '../../../themes/frontend/parts/link-head.php' ?>

    <title>ANIGASTORE - <?= $title ?></title>
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
                        <h2 class="text-capitalize"><?= $title ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (empty($search)) : ?>
        <h2 class="text-center text-danger my-3">Produk Tidak Ditemukan</h2>
    <?php else : ?>
        <div class="single-product-area">
            <div class="zigzag-bottom"></div>
            <div class="container">
                <div class="row">
                    <?php foreach ($search as $row) : ?>
                        <?php if (isset($_SESSION['user_name'])) : ?>
                            <?php foreach ($wishlist as $wish) : ?>
                                <?php if ($wish['id_product'] == $row['id']) : ?>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="single-shop-product">
                                            <div class="product-upper">
                                                <img src="../../../assets/img/products/<?= $row["img"] ?>" alt="<?= $row["img"] ?>">
                                            </div>
                                            <h2 class="text-uppercase text-center"><a href="../product/detail.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></h2>
                                            <div class="product-carousel-price text-center">
                                                <ins><?= rupiah($row["price"]); ?></ins>
                                            </div>
                                            <div class="product-option-shop text-center">
                                                <form method="post" action="../cart/index.php" class="cart">
                                                    <div class="quantity">
                                                        <input type="hidden" name="id_product" value="<?= $row["id"] ?>">
                                                        <input type="hidden" name="img" value="<?= $row["img"] ?>">

                                                        <input type="hidden" id="qty" name="qty" value="1">
                                                        <button type="submit" class="add_to_cart_button"><i class="fas fa-cart-plus"></i> Tambah</button>
                                                    </div>
                                                </form>
                                                <a class="btn btn-danger" href="../wishlist/delete.php?id_user=<?= $id_user ?>&id_product=<?= $row['id'] ?>"><i class="fas fa-heart"></i> Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php continue 2; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <div class="col-md-3 col-sm-6">
                                <div class="single-shop-product">
                                    <div class="product-upper">
                                        <img src="../../../assets/img/products/<?= $row["img"] ?>" alt="<?= $row["img"] ?>">
                                    </div>
                                    <h2 class="text-uppercase text-center"><a href="../product/detail.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></h2>
                                    <div class="product-carousel-price text-center">
                                        <ins><?= rupiah($row["price"]); ?></ins>
                                    </div>

                                    <div class="product-option-shop text-center">
                                        <form method="post" action="../cart/index.php" class="cart">
                                            <div class="quantity">
                                                <input type="hidden" name="id_product" value="<?= $row["id"] ?>">
                                                <input type="hidden" name="img" value="<?= $row["img"] ?>">

                                                <input type="hidden" id="qty" name="qty" value="1">
                                                <button type="submit" class="add_to_cart_button"><i class="fas fa-cart-plus"></i> Tambah</button>
                                            </div>
                                        </form>
                                        <a class="btn btn-danger" href="../wishlist/delete.php?id_user=<?= $id_user ?>&id_product=<?= $row['id'] ?>"><i class="fas fa-heart"></i> Hapus</a>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="col-md-3 col-sm-6">
                                <div class="single-shop-product">
                                    <div class="product-upper">
                                        <img src="../../../assets/img/products/<?= $row["img"] ?>" alt="<?= $row["img"] ?>">
                                    </div>
                                    <h2 class="text-uppercase text-center"><a href="../product/detail.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></h2>
                                    <div class="product-carousel-price text-center">
                                        <ins><?= rupiah($row["price"]); ?></ins>
                                    </div>

                                    <div class="product-option-shop text-center">
                                        <form method="post" action="../cart/index.php" class="cart">
                                            <div class="quantity">
                                                <input type="hidden" name="id_product" value="<?= $row["id"] ?>">
                                                <input type="hidden" name="img" value="<?= $row["img"] ?>">

                                                <input type="hidden" id="qty" name="qty" value="1">
                                                <button type="submit" class="add_to_cart_button"><i class="fas fa-cart-plus"></i> Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php require_once '../../../themes/frontend/parts/brands-area.php' ?>
    <!-- End brands area -->

    <?php require_once '../../../themes/frontend/parts/footer.php' ?>
    <!-- End footer bottom area -->

    <?php require_once '../../../themes/frontend/parts/script-body.php' ?>
</body>

</html>