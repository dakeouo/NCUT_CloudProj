<?php include_once "model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
<?php $title = "訂單成立";  include_once "temp/header.php"; ?>
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
				<label class="step-label">STEP3</label>
				<label class="step-name">訂單完成</label>
			</div>
			<div id="cart-content" align="center">
				<?php $orderID = date('Ymd').str_pad(hexdec(uniqid())%10000000,7,'0',STR_PAD_LEFT); 
				echo '<h1>您的訂單已成立</h1>';
				echo '<h2>訂單編號</h2>';
				echo '<h1 style="color: red;">'.$orderID.'</h1>';
				?>
				<a href="index.php" class="btn btn-primary" style="padding: 0.5em 15em;">確認</a>
			</div>
		</div>
	</div>
	<?php include_once "temp/footer.php" ?>
</body>
<script>

</script>
</html>