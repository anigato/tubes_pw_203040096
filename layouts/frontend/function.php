<?php
require_once '../../../php/function.php';

// fungsi mempersingkat deskripsi
function shortDesc($desc, $longChar)
{
    if (strlen($desc) >= $longChar) {
        $data = substr($desc, 0, $longChar) . ".....";
    } else {
        $data = $desc;
    }
    return $data;
}

function registrasi_user($data)
{
    $conn = koneksi();
    $username = htmlspecialchars($data['username']);
    $pass = htmlspecialchars($data['password']);

    // enkripsi password
    $password = password_hash($pass, PASSWORD_DEFAULT);

    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        return "notAlfabet";
    }

    //query tambah user
    $query = "insert into users values ('','$username',null,'$password',null,null,null,null)";
    mysqli_query($conn, $query);

    $user = query("SELECT id FROM users where username = '$username'")[0];
    $id_user = $user['id'];

    $q_address = "insert into address values ('',$id_user,'','','','','','','','','')";
    mysqli_query($conn, $q_address);

    return "success";
}
function ubah_user($data, $img)
{
    $conn = koneksi();

    $id_user = $data['id_user'];
    $id_alamat = $data['id_alamat'];
    $username = htmlspecialchars($data['username']);
    $email = htmlspecialchars($data['email']);
    $password = htmlspecialchars($data['password']);
    $full_name = htmlspecialchars($data['full_name']);
    $nick_name = htmlspecialchars($data['nick_name']);
    $phone = htmlspecialchars($data['phone']);
    $additional = htmlspecialchars($data['additional']);
    $rt = htmlspecialchars($data['rt']);
    $rw = htmlspecialchars($data['rw']);
    $dusun = htmlspecialchars($data['dusun']);
    $desa = htmlspecialchars($data['desa']);
    $kecamatan = htmlspecialchars($data['kecamatan']);
    $kabupaten = htmlspecialchars($data['kabupaten']);
    $provinsi = htmlspecialchars($data['provinsi']);
    $kode_pos = htmlspecialchars($data['kode_pos']);

    $old_img = htmlspecialchars($data['old_img']);

    if (empty($img)) {
        $img = $old_img;
    } else {
        $img = $img;
    }

    $query = "update users set username = '$username', email = '$email', password = '$password', full_name = '$full_name', nick_name = '$nick_name', phone = '$phone', img = '$img' where id = $id_user ";

    mysqli_query($conn, $query);

    $q_alamat = "update address set additional = '$additional',
    rt = '$rt',
    rw = '$rw',
    dusun = '$dusun',
    desa = '$desa',
    kecamatan = '$kecamatan',
    kabupaten = '$kabupaten',
    provinsi = '$provinsi',
    kode_pos = '$kode_pos'
    where id = $id_alamat ";

    mysqli_query($conn, $q_alamat);

    return mysqli_affected_rows($conn);
}

function tambah_wishlist($id_user, $id_product)
{
    $conn = koneksi();
    $query = "insert into wishlists values ('',$id_product,$id_user)";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function hapus_wishlist($id_user, $id_product)
{
    $conn = koneksi();
    $query = "DELETE FROM wishlists WHERE id_product = $id_product AND id_user = $id_user";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function checkout()
{
    $conn = koneksi();

    // if (!isset($_SESSION['cart'])) {
    //     header('Location: ../product/index.php');
    // }

    $cart = unserialize(serialize($_SESSION['cart']));
    $total_item = 0;
    $total_bayar = 0;

    for ($i = 0; $i < count($cart); $i++) {
        $total_item += $cart[$i]['qty'];
        $total_bayar += $cart[$i]['qty'] * $cart[$i]['price'];
    }

    $user = $_SESSION['user_name'];
    $user = query("SELECT id FROM users WHERE username = '$user'")[0];
    $id_user = $user['id'];

    $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $kode = "INV" . substr(str_shuffle($permitted_chars), 0, 6) . (int)date('dmY');
    $total_bayar += (int)substr(str_shuffle('0123456789'), 0, 3);
    // proses penyimpanan data
    $timestamp = date('Y-m-d H:i:s');
    mysqli_query($conn, "INSERT INTO orders VALUES ('','$kode',$id_user,'$timestamp',3,$total_item,$total_bayar,'')");

    $id_order = mysqli_insert_id($conn);

    for ($i = 0; $i < count($cart); $i++) {
        $id_produk = $cart[$i]['id'];
        $qty = $cart[$i]['qty'];
        $price = $cart[$i]['price'] * $qty;

        $product = query("SELECT*FROM products WHERE id = $id_produk")[0];

        $stok = $product['stok'] - $qty;

        if ($stok < 0) {
            $query = "DELETE FROM orders WHERE id = $id_order";
            mysqli_query($conn, $query);
            return "outstock";
        }

        $query = "INSERT INTO order_details  VALUES ('', $id_produk,$id_order, $qty,$price)";
        $order_detail = mysqli_query($conn, $query);
        if ($order_detail) {
            $query = "UPDATE products SET stok = $stok WHERE id = $id_produk";
            mysqli_query($conn, $query);
        }

        $product = query("SELECT*FROM products WHERE id = $id_produk")[0];
        if ($product['stok'] == 0) {
            $query = "UPDATE products SET status = 0 WHERE id = $id_produk";
            mysqli_query($conn, $query);
        }
    }

    // unset session
    unset($_SESSION['cart']);
    return "success";
}

function bayar($data)
{
    $conn = koneksi();
    $id = $data['id'];
    $payment = htmlspecialchars($data['payment']);
    $query = "UPDATE orders SET payment = '$payment', status = 2 WHERE id = $id";
    mysqli_query($conn, $query);
    return "ok";
}

function batal($data)
{
    $conn = koneksi();
    $id = $data['id'];

    $query = query("SELECT * FROM order_details WHERE id_order = $id");
    foreach ($query as $row) {
        $id_product = $row['id_product'];
        $qty = $row['qty'];

        $product = query("SELECT*FROM products WHERE id = $id_product")[0];
        $stok = $product['stok'] + $qty;
    }

    $query = "UPDATE orders SET status = 6 WHERE id = $id";
    $order_detail = mysqli_query($conn, $query);
    if ($order_detail) {
        $query = "UPDATE products SET stok = $stok WHERE id = $id_product";
        mysqli_query($conn, $query);
    }
    return "ok";
}
function terima($data)
{
    $conn = koneksi();
    $id = $data['id'];
    $query = "UPDATE orders SET status = 5 WHERE id = $id";
    mysqli_query($conn, $query);
    return "ok";
}

function ajukan_konfirmasi($data)
{
    $conn = koneksi();
    $id = $data['id'];
    $query = "UPDATE orders SET  status = 0 WHERE id = $id";
    mysqli_query($conn, $query);
}

// $im = imagecreatefrompng('example.png');
// $size = min(imagesx($im), imagesy($im));
// $im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]);
// if ($im2 !== FALSE) {
//     imagepng($im2, 'example-cropped.png');
//     imagedestroy($im2);
// }
// imagedestroy($im);
