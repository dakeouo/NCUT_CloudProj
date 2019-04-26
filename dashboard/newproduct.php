<?php include_once "temp/check.php"; ?>
<?php include_once "../model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = "新增商品";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div class="content">
			<div id="backend-title-area">
				<label id="total-title"><?php echo $title;?></label>
				<a href="products.php" id="total-btn" class="btn btn-second">返回</a>
			</div>
			<div id="backend-content-area">
				<div id="backend-form-photo"><div>
					<img src="<?php echo $dataset->main->myImg(null,"products"); ?>">
				</div></div>
				<div id="backend-form-input">
					<form method="POST" action="../authcheck.php">
						<input type="hidden" name="mode" value="back-product-add">
						商品名稱：<input type="text" name="name" required><br />
						類別：<?php $dataset->getpType(); ?><br />
						價格：NT$<input type="text" name="price" style="width: 50px" required><br />
						敘述：<input type="text" name="discribe" style="width: 450px" ><br />
						<input type="submit" name="submit" class="btn btn-green half" value="確定新增">
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include_once "../temp/footer.php" ?>
</body>
</html>