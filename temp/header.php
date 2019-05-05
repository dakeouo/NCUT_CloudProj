<?php session_start(); ?>
<meta charset="utf-8">
<?php echo '<title>'.$title.' | NCUT TeaShop</title>'; ?>
<link rel="stylesheet" type="text/css" href="asset/css/shop.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
include_once "model/cartModel.php"; $cartModel = new CartModel();
if(!isset($_SESSION['cart_token'])){
	$_SESSION['cart_token'] = md5(uniqid(""));
	if(isset($_SESSION['uid'])) $uid = $_SESSION['uid'];
	else $uid = "A00000";
	$cartModel->createCart($_SESSION['cart_token'],$uid);
}
?>
