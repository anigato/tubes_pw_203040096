<?php

// require_once '../../../php/function.php';
require_once '../function.php';
$id_user = $_GET['id_user'];
$id_product = $_GET['id_product'];

// require_once 'session_isset.php';

if (hapus_wishlist($id_user,$id_product) > 0) {
    echo "<script>document.location.href='../product/index.php'</script>";
} else {
    echo "<script>document.location.href='../product/index.php'</script>";
}
?>