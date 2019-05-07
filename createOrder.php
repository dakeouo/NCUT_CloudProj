<?php include_once "model/dataset.php"; $dataset = new Dataset();?>
<?php include_once "model/CartModel.php"; $cartModel = new CartModel();?>
<html>
<head>
<?php $title = "訂單成立";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div id="contentImg">
			<?php echo '<div><img src="'.$dataset->main->myImg($GLOBALS['photoDef']['sub-header']).'"></div>' ?>
		</div>
		<div class="content">
			<div id="schedule-bar">
				<label class="step-label">STEP1</label>
				<label class="step-name">購物車</label>
				<img src="<?php echo $dataset->main->myImg("arrow.png"); ?>">
				<label class="step-label">STEP2</label>
				<label class="step-name">訂單資訊</label>
				<img src="<?php echo $dataset->main->myImg("arrow.png"); ?>">
				<label class="step-label">STEP3</label>
				<label class="step-name">訂單完成</label>
			</div>
			<?php
			$OrderInfo = array(
				"token" => $_POST['token'],
				"uid" => $_POST['uid'],
				"name" => $_POST['name'],
				"phone" => $_POST['phone'],
				"pid" => $_POST['shop_id'],
				"val_Time" => $_POST['val_Time'],
				"total" => $_POST['total']
			);
			//print_r($OrderInfo);
			$orderID = date('Ymd').str_pad(hexdec(uniqid())%10000000,7,'0',STR_PAD_LEFT);
			$isOrder = $cartModel->cart2Order($orderID,$OrderInfo);
			if($isOrder) unset($_SESSION['cart_token']);
			?>
			<div id="cart-content" align="center">
				<?php  
				echo '<h1>您的訂單已成立</h1>';
				echo '<b><font style="font-size:1.5em;">訂單編號</font><br />';
				echo '<font style="color: red; font-size:2.5em;">'.$orderID.'</font></b><br />';
				?>
				<font style="font-size:1.2em; color:#666; height:1.2em;">
					訂購的商品<br /><?php echo "<b>".$_POST['item']."</b>";?>
				</font><br /><br /><br />
				<a href="index.php" class="btn btn-primary" style="padding: 0.5em 15em;">確認</a>
			</div>
		</div>
	</div>
	<?php include_once "temp/footer.php" ?>
</body>
<script>

</script>
</html>