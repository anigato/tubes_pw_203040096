<?php
require_once "../function.php";
session_start();

if (isset($_POST['id_product']) && isset($_POST['qty']) && isset($_POST['img'])) {
    $id = $_POST['id_product'];
    $qty = $_POST['qty'];
    $img = $_POST['img'];

    $conn = koneksi();
    $pro = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
    $product = $pro->fetch_assoc();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $index = -1;
    $cart = unserialize(serialize($_SESSION['cart']));

    for ($i = 0; $i < count($cart); $i++) {
        if ($cart[$i]['id'] == $id) {
            $index = $i;
            $_SESSION['cart'][$i]['qty'] += $qty;
            break;
        }
    }

    if ($index == -1) {
        $_SESSION['cart'][] = [
            'id' => $id,
            'img' => $product['img'],
            'name' => $product['name'],
            'price' => $product['price'],
            'qty' => $qty
        ];
    }
}

if (isset($_POST['id_product_update']) && isset($_POST['qty_update']) && isset($_POST['img_update'])) {
    $cart = unserialize(serialize($_SESSION['cart']));

    for ($i = 0; $i < count($cart); $i++) {
        if ($cart[$i]['id'] == $_POST['id_product_update']) {
            $index = $i;
            $_SESSION['cart'][$i]['qty'] = $_POST['qty_update'];
            break;
        }
    }
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

    <title>ANIGASTORE - Keranjang</title>
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
                        <h2 class="text-capitalize">Keranjang Saya</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-12 mb-4">
                    <table class="table table-condensed">


                        <?php
                        if (isset($_SESSION['cart'])) {
                        ?>
                            <tr>
                                <td></td>
                                <td>Foto</td>
                                <td>Nama Produk</td>
                                <td>Jumlah</td>
                                <td>Harga</td>
                                <td>Total</td>
                                <td></td>
                            </tr>
                            <?php
                            $cart = unserialize(serialize($_SESSION['cart']));
                            $index = 0;
                            $no = 1;
                            $total = 0;
                            $total_bayar = 0;

                            for ($i = 0; $i < count($cart); $i++) {
                                $total = $_SESSION['cart'][$i]['price'] * $_SESSION['cart'][$i]['qty'];
                                $total_bayar += $total;
                            ?>

                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><img src="../../../assets/img/products/<?= $cart[$i]['img']; ?>" class="rounded" width="70" alt=""></td>
                                    <td><a href="../product/detail.php?id=<?= $cart[$i]['id']; ?>"><?= $cart[$i]['name']; ?></a></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="id_product_update" value="<?= $cart[$i]['id']; ?>">
                                            <input type="hidden" name="img_update" value="<?= $cart[$i]['img']; ?>">
                                            <div class="row">
                                                <input type="number" class="form-control col-md-5" name="qty_update" value="<?= $cart[$i]['qty']; ?>">
                                                <button type="submit" class="form-control col-md-3 btn btn-sm"><i class="fas fa-check"></i></button>
                                            </div>
                                        </form>
                                    </td>
                                    <td><?= rupiah($cart[$i]['price']); ?></td>
                                    <td><?= rupiah($total); ?></td>
                                    <td>
                                        <a href="?delete=<?= $index; ?>">
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </a>
                                    </td>
                                </tr>

                            <?php
                                $index++;
                            }

                            // hapus produk dalam cart
                            if (isset($_GET['delete'])) {
                                $cart = unserialize(serialize($_SESSION['cart']));
                                unset($cart[$_GET['delete']]);
                                $cart = array_values($cart);
                                $_SESSION['cart'] = $cart;
                            } ?>
                            <tr>
                                <td colspan="4"><strong>Total Bayar</strong></td>
                                <td colspan="2"><strong><?= rupiah($total_bayar); ?></strong></td>
                                <td>
                                    <?php if (isset($_SESSION['user_name'])) : ?>
                                        <form action="" method="post">
                                            <button type="submit" name="checkout" class="btn btn-success btn-sm">Checkout</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php
                        } else {
                            echo "<h1 class='text-danger'>Anda Tidak memiliki produk di dalam keranjang</h1>";
                        }
                        ?>


                    </table>
                </div>


                <div class="col-md-4">
                    <div class="single-sidebar">
                        <?php require_once '../../../themes/frontend/parts/new-product.php' ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <?php require_once '../../../themes/frontend/parts/related-product.php' ?>
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
    if (isset($_POST['checkout'])) {
        $user = $_SESSION['user_name'];
        $user = query("SELECT*FROM users WHERE username = '$user'")[0];
        $uid = $user['id'];
        $addres = query("SELECT*FROM address WHERE id_user = $uid")[0];
        if (!empty($addres['provinsi'])) {
            $status = checkout();
            if ($status == 'outstock') {
                echo "
                <script type='text/javascript'>
                Swal.fire({
                    title:'Opps!',
                    text:'Maaf pesanan anda melebihi stok, silahkan cek kembali',
                    icon:'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                    document.location.href='../cart/index.php';
                    }
                })
                </script>
            ";
            } elseif ($status == 'success') {
                echo "
                <script type='text/javascript'>
                
                Swal.fire({
                    title:'Berhasil!',
                    text:'Anda berhasil memesan, silahkan lanjutkan pembayaran',
                    icon:'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                    document.location.href='../transaction/index.php';
                    }
                })
                </script>
            ";
            }
        } else {
            echo "
                <script type='text/javascript'>
                Swal.fire({
                    title:'Maaf!',
                    text:'Sebelum melakukan pemesanan, anda harus mengisi alamat dengan lengkap',
                    icon:'warning',
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