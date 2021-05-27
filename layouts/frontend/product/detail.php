<?php
session_start();
require_once '../function.php';

$id = $_GET['id'];

$product = query("select*from products where id=$id")[0];

if (isset($_COOKIE['user_name'])) {
    $_SESSION['user_name'] = $_COOKIE['user_name'];
};

if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
    $user = query("SELECT*FROM users where username = '$user_name'")[0];

    $id_user = $user['id'];
    $wishlist = query("SELECT*FROM wishlists WHERE id_user = $id_user");

    $id_product = $product['id'];
    $check_wish = isset(query("SELECT*FROM wishlists WHERE id_user = $id_user AND id_product = $id_product")[0]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php require_once '../../../themes/frontend/parts/link-head.php' ?>

    <title>ANIGASTORE - <?= $product["name"] ?></title>
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
                        <h2 class="text-capitalize">Buy <?= $product["name"] ?> Now</h2>
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
                        <?php require_once '../../../themes/frontend/parts/new-product.php' ?>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="index.php">HOME</a>
                            <a href="#"><?= $product["category"] ?></a>
                            <?php
                            $id_brand = $row['id_brand'];
                            $brands = query("SELECT * FROM brands WHERE id = $id_brand");
                            foreach ($brands as $br) :
                            ?>
                                <a href="#" class="text-uppercase"><?= $br["name"] ?></a>
                            <?php endforeach ?>
                            <a href="#" class="text-uppercase"><?= $product["name"] ?></a>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="../../../assets/img/products/<?= $product["img"] ?>" alt="<?= $product["img"] ?>" class="img-tumbnail rounded">
                                    </div>
                                </div>
                                <div class="p">Bagikan :</div>
                                <div class="share mt-2">
                                    <div class="addthis_inline_share_toolbox_c0ma"></div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <?php
                                    if ($product["stok"] > 50) {
                                        echo "<span class='badge badge-success'>Stok Masih Banyak</span>";
                                    } else if ($product["stok"] > 10) {
                                        echo "<span class='badge badge-warning'>Stok Sudah Sedikit</span>";
                                    } else {
                                        echo "<span class='badge badge-danger'>Stok Hampir Habis</span>";
                                    }
                                    ?>
                                    <h2 class="font-weight-bold text-uppercase"><?= $product["name"] ?></h2>

                                    <div class="product-inner-price">
                                        <h3 class="text-danger font-weight-bold"><?= rupiah($product["price"]); ?></h3>
                                    </div>

                                    <table class="table mt-3">
                                        <tr>
                                            <td>Kapasitas</td>
                                            <td>:</td>
                                            <td><?php
                                                $cate = $product["category"];
                                                $capa = $product["capacity"];
                                                if (preg_match("/SSD/i", $cate)) {
                                                    echo $capa, strlen($capa) == 1 ? " TB" : " GB";
                                                } else {
                                                    echo $capa, " GB";
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td>Berat</td>
                                            <td>:</td>
                                            <td><?= $product["weight"] ?>gr</td>
                                        </tr>
                                        <tr>
                                            <td>Stok</td>
                                            <td>:</td>
                                            <td><?= $product["stok"] ?>pcs</td>
                                        </tr>
                                    </table>
                                    <form method="post" action="../cart/index.php" class="cart">
                                        <div class="quantity">
                                            <input type="hidden" name="id_product" value="<?= $product["id"] ?>">
                                            <input type="hidden" name="img" value="<?= $product["img"] ?>">

                                            <input type="text" class="form-control mb-2" placeholder="Jumlah" id="qty" name="qty" value="1" min="1" max="<?= $product["stok"] ?>" onkeypress="return onlyNumber(event)" required>
                                            <button type="submit" class="btn btn-primary add_to_cart_button"><i class="fas fa-cart-plus"></i> Masukan Ke Keranjang</button>
                                        </div>
                                    </form>
                                    <?php if (!empty($check_wish)) : ?>
                                        <a href="../wishlist/delete.php?id_user=<?= $id_user ?>&id_product=<?= $product['id'] ?>" class="btn btn-danger mt-3"><i class="fas fa-heart"></i> Hapus Keinginan</a>
                                    <?php elseif (!isset($_SESSION['user_name'])) : ?>
                                    <?php else : ?>
                                        <a href="../wishlist/add.php?id_user=<?= $id_user ?>&id_product=<?= $product['id'] ?>" class="btn btn-danger mt-3"><i class="far fa-heart"></i> Tambah Keinginan</a>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                        <div class="keterangan mt-3">
                            <div>
                                <div>
                                    <nav>
                                        <div class="nav nav-tabs" id="desc-tab" role="tablist">
                                            <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Deskripsi</a>
                                            <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Ulasan</a>
                                            <a class="nav-link" id="disscusion-tab" data-toggle="tab" href="#disscusion" role="tab" aria-controls="disscusion" aria-selected="false">Diskusi</a>
                                        </div>
                                    </nav>
                                </div>
                                <div class="mt-3">
                                    <div class="tab-content" id="desc-tabContent">
                                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                            <div class="row">
                                                <h3>Spesifikasi</h3>
                                                <table class="table mt-3">
                                                    <tr>
                                                        <td>SKU Produk</td>
                                                        <td>:</td>
                                                        <td><?= $product["sku"] ?></td>
                                                    </tr>
                                                    <?php
                                                    $id_brand = $row['id_brand'];
                                                    $brands = query("SELECT * FROM brands WHERE id = $id_brand");

                                                    foreach ($brands as $br) : ?>
                                                        <tr>
                                                            <td>Merk</td>
                                                            <td>:</td>
                                                            <td><?= $br["name"] ?></td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                    <tr>
                                                        <td>Kategori</td>
                                                        <td>:</td>
                                                        <td><?= $product["category"] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kapasitas</td>
                                                        <td>:</td>
                                                        <td><?php
                                                            $cate = $product["category"];
                                                            $capa = $product["capacity"];
                                                            if (preg_match("/SSD/i", $cate)) {
                                                                echo $capa, strlen($capa) == 1 ? " TB" : " GB";
                                                            } else {
                                                                echo $capa, " GB";
                                                            }
                                                            ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Berat</td>
                                                        <td>:</td>
                                                        <td><?= $product["weight"] ?>gr</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Stok</td>
                                                        <td>:</td>
                                                        <td><?= $product["stok"] ?>pcs</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <?= htmlspecialchars_decode($product["description"], ENT_QUOTES); ?>
                                        </div>
                                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                            <div class="submit-review">
                                                <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                <div class="rating-chooser">
                                                    <p>Your rating</p>
                                                    <div class="rating-wrap-post">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                <p><input type="submit" value="Submit"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php require_once '../../../themes/frontend/parts/related-product.php' ?>
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
    <!-- share button -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e9e4256855b7795"></script>

    <!-- disqus -->
    <script>
        (function() {
            var d = document,
                s = d.createElement('script');
            s.src = 'https://anigastore.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();

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
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <script id="dsq-count-scr" src="//anigastore.disqus.com/count.js" async></script>
</body>

</html>