<?php

require '../session_isset.php';
// require '../../../php/function.php';
require '../function.php';
$id = $_GET['id'];
$status = $_GET['status'];

// require 'session_isset.php';

if (status_slidder($status,$id) > 0) {
    echo "<script>document.location.href='index.php'</script>";
} else {
    echo "<script>document.location.href='index.php'</script>";
}
?>