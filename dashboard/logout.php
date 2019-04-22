<?php
include_once "../model/main.php";
$main = new Main();
session_start();
unset($_SESSION['shopId']);
unset($_SESSION['shopName']);
$main->myUrl("dashboard");
?>