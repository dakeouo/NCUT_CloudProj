<?php include_once "model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
<?php $title = "訂單資訊";  include_once "temp/header.php"; ?>
<?php if($_POST){$cartModel->setCartItem($_SESSION['cart_token'],$_POST['itemId'],$_POST['unit'],$_POST['total']);}?>
</head>
<body onload="init()">
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div id="contentImg"></div>
		<div class="content">
			<div id="schedule-bar">
				<label class="step-label">STEP1</label>
				<label class="step-name">購物車</label>
				<img src="<?php echo $dataset->main->myImg("arrow.png"); ?>">
				<label class="step-label">STEP2</label>
				<label class="step-name">訂單資訊</label>
				<img src="<?php echo $dataset->main->myImg("arrow.png"); ?>">
				<label class="step-label step-gray">STEP3</label>
				<label class="step-name step-name-gary">訂單完成</label>
			</div>
			<div id="cart-content">
				<div id="order-msg">
					<?php if($_POST){
						echo '訂購&nbsp;<font color="red">'.count($_POST['itemId']).'</font>&nbsp;項商品，總金額共&nbsp;<font color="red">NT$'.$_POST['total'].'</font>&nbsp;。';
					}else{
						$data = $cartModel->mysql->getOrder($_SESSION['cart_token']);
						echo '訂購&nbsp;<font color="red">'.$data['item'].'</font>&nbsp;項商品，總金額共&nbsp;<font color="red">NT$'.$data['total'].'</font>&nbsp;。';
					}
					?>
				</div>
				<div id="order-form">
					<form method="POST" action="">
						<input type="hidden" name="token" value="<?php echo $_SESSION['cart_token']; ?>">
						取貨人&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="text" name="name" style="width: 15em;"><br />
						行動電話&nbsp;
						<input type="phone" name="phone" style="width: 15em;"><br />
						取貨門市&nbsp;
						<?php $dataset->getShop(); ?><br />
						預計取貨時間&nbsp;
						<?php $dataset->getIntervalTime(); ?><br />
						<input type="submit" name="submit" class="btn btn-primary fit" value="送出訂單">
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include_once "temp/footer.php" ?>
</body>
<script>
	
</script>
</html>