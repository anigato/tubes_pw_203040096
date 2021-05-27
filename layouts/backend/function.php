<?php 
require '../../../php/function.php';

// fungsi mempersingkat deskripsi
function shortString($string, $longChar)
{
    if (strlen($string) >= $longChar) {
        $data = substr($string, 0, $longChar) . "...";
    } else {
        $data = $string;
    }
    return $data;
}

//tambah produk
function tambah($data,$img)
{
    $conn = koneksi();

    $name = htmlspecialchars($data['name']);
    $brand = htmlspecialchars($data['brand']);
    $category = htmlspecialchars($data['category']);
    $capacity = htmlspecialchars($data['capacity']);
    $stok = htmlspecialchars($data['stok']);
    $weight = htmlspecialchars($data['weight']);
    $price = htmlspecialchars($data['price']);
    $sku = substr($brand, 0, 3) .'-'. $capacity . '-' . $category . '-' . $price;
    $description = htmlspecialchars($data['description']);
    $img = $img;
    $date_add = date('Y-m-d');

    $query = "insert into products values (null,'$sku','$name','$category','$brand','$stok','$capacity','$price','$weight','$img','$description','$date_add','')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

//hapus produk
function hapus($id)
{
    $query = query("SELECT img FROM products WHERE id = $id")[0];
    unlink("../../../assets/img/products/" . $query['img']);

    $conn = koneksi();
    mysqli_query($conn, "delete from products where id = $id");
    return mysqli_affected_rows($conn);
}

//ubah produk
function ubah($data,$img)
{
    $conn = koneksi();

    $id = $data['id'];
    $name = htmlspecialchars($data['name']);
    $brand = htmlspecialchars($data['brand']);
    $category = htmlspecialchars($data['category']);
    $capacity = htmlspecialchars($data['capacity']);
    $stok = htmlspecialchars($data['stok']);
    $weight = htmlspecialchars($data['weight']);
    $price = htmlspecialchars($data['price']);
    $sku = substr($brand, 0, 3) .'-'. $capacity . '-' . $category . '-' . $price;
    $description = htmlspecialchars($data['description']);
    $date_modified = date('Y-m-d');

    $old_img = htmlspecialchars($data['old_img']);

    if (empty($img)) {
        $image = $old_img;
    } else {
        $image = $img;
    }

    $query = "update products set sku = '$sku', name = '$name', category = '$category', id_brand = '$brand', stok = '$stok', capacity = '$capacity', price = '$price', weight = '$weight', img = '$image', description = '$description' ,date_modified = '$date_modified' where id = $id ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//tambah admin
function registrasi_admin($data, $img)
{
    $conn = koneksi();
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $img = $img;

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //query tambah user
    $q_add = "insert into user_admin values ('','$username','$password','$img')";
    mysqli_query($conn, $q_add);

    return mysqli_affected_rows($conn);
}

//hapus admin
function delete_admin($id)
{
    $query = query("SELECT img FROM user_admin WHERE id = $id")[0];

    if (empty($query['img'])) {
        
    } else {
        unlink("../../../assets/img/users/" . $query['img']);
    }
    
    $conn = koneksi();
    mysqli_query($conn, "delete from user_admin where id = $id");
    
    return mysqli_affected_rows($conn);
}

//ubah admin
function ubah_admin($data, $img)
{
    $conn = koneksi();

    $id = $data['id'];
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $password = password_hash($password, PASSWORD_DEFAULT);
    // $img = htmlspecialchars($data['img']);
    $old_img = htmlspecialchars($data['old_img']);

    if (empty($img)) {
        $img = $old_img;
    } else {
        $img = $img;
    }

    $query = "update user_admin set username = '$username', password = '$password', img = '$img' where id = $id ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambah_brand($data,$img){
    $conn = koneksi();

    $name = htmlspecialchars($data['name']);
    $img = $img;

    $query = "insert into brands values (null,'$name','$img')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function ubah_brand($data, $img){
    $conn = koneksi();

    $id = $data['id'];
    $name = htmlspecialchars($data['name']);
    $old_img = htmlspecialchars($data['old_img']);

    if (empty($img)) {
        $image = $old_img;
    } else {
        $image = $img;
    }

    $query = "update brands set name = '$name', img = '$image' where id = $id ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function delete_brand($id)
{
    $query = query("SELECT img FROM brands WHERE id = $id")[0];

    if (empty($query['img'])) {
        
    } else {
        unlink("../../../assets/img/brands/" . $query['img']);
    }
    
    $conn = koneksi();
    mysqli_query($conn, "delete from brands where id = $id");
    
    return mysqli_affected_rows($conn);
}


function tambah_slidder($data){
    $conn = koneksi();

    $id_product = htmlspecialchars($data['id_product']);
    $title = htmlspecialchars($data['title']);
    $description = htmlspecialchars($data['description']);

    $query = "insert into slidders values (null,'$id_product',1,'$title','$description')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit_slidder($data){
    $conn = koneksi();
    
    $id = htmlspecialchars($data['id']);
    $id_product = htmlspecialchars($data['id_product']);
    $title = htmlspecialchars($data['title']);
    $description = htmlspecialchars($data['description']);

    $query = "update slidders set id_product = '$id_product', title = '$title', description = '$description'  where id = $id ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function delete_slidder($id)
{
    $conn = koneksi();
    mysqli_query($conn, "delete from slidders where id = $id");
    
    return mysqli_affected_rows($conn);
}

function status_slidder($status,$id){
    $conn = koneksi();

    $query = "update slidders set status = $status  where id = $id ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// order
function process($data){
    $conn = koneksi();
    $id = $data['id'];
    $query = "UPDATE orders SET status = 1 WHERE id = $id";
    mysqli_query($conn, $query);
    return "ok";
}
function send($data){
    $conn = koneksi();
    $id = $data['id'];
    $query = "UPDATE orders SET status = 4 WHERE id = $id";
    mysqli_query($conn, $query);
    return "ok";
}