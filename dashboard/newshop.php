<?php include_once "temp/check.php"; ?>
<?php include_once "../model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = "新增店家";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div class="content">
			<div id="backend-title-area">
				<label id="total-title"><?php echo $title;?></label>
				<a href="shops.php" id="total-btn" class="btn btn-second">返回</a>
			</div>
			<div id="backend-content-area">
				<div id="backend-form-photo"><div>
					<img src="<?php echo $dataset->main->myImg(null,"shops"); ?>">
				</div></div>
				<div id="backend-form-input">
					<form method="POST" action="../method/chData.php">
						<input type="hidden" name="mode" value="back-shop-add">
						門市名稱：<input type="text" name="name" required><br />
						行政區：<?php $dataset->getZone(); ?><br />
						電話：<input type="text" name="phone_id" placeholder="區碼" style="width: 50px" required>-
						<input type="tel" name="phone" placeholder="電話" required><br />
						營業時間：<?php $dataset->getTimeOption("start_at"); ?> - <?php $dataset->getTimeOption("end_at"); ?><br />
						地址：<input type="text" name="address" style="width: 450px" required><br />
						<input type="submit" name="submit" class="btn btn-green half" value="確定新增">
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include_once "../temp/footer.php" ?>
</body>
</html>