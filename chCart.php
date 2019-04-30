<?php
session_start();
include_once "model/cartModel.php";
$cartModel = new CartModel();
$meth = $_GET['method'];
$pid = $_GET['pid'];
$token = $_SESSION['cart_token'];
$cartModel->CartItem($meth, $pid, $token);
$cartModel->main->goBack();
?>