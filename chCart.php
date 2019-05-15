<?php
session_start();
include_once "model/dataset.php";
include_once "model/cartModel.php";
$dataset = new Dataset();
$cartModel = new CartModel();

$meth = $_GET['method'];
$pid = $_GET['pid'];
$token = $_SESSION['cart_token'];
$cartModel->CartItem($meth, $pid, $token);
$cartModel->main->goBack();
?>