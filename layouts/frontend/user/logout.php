<?php
session_start();
session_destroy();
// unset($_SESSION["username"]);

setcookie("user_name","",time() - 3600, "/");
setcookie("user_hash", "", time() - 3600, "/");
header("Location: ../product/index.php");
die;
?>