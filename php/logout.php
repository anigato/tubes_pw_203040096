<?php
session_start();
session_destroy();
// unset($_SESSION["username"]);

setcookie("username","",time() - 3600, "/");
setcookie("hash", "", time() - 3600, "/");
setcookie("img","",time() - 3600, "/");
header("Location: ../index.php");
die;
?>