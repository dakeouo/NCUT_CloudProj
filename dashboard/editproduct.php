<?php include_once "temp/check.php"; ?>
<?php include_once "../model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = "修改商品資料";  include_once "temp/header.php"; ?>
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
				<?php $data = $dataset->getProductSingleData($_GET['pid']);?>
				<div id="backend-form-photo"><div>
					<img src="<?php echo $dataset->main->myImg($data[0]['path'],"products"); ?>">
				</div></div>
				<div id="backend-form-input">
					<form method="POST" action="../authcheck.php">
						<input type="hidden" name="mode" value="back-product-edit">
						<input type="hidden" name="pid" value="<?php echo $data[0]['pid'] ?>">
						商品名稱：<input type="text" name="name" value="<?php echo $data[0]['name'] ?>" required><br />
						類別：<?php $dataset->getpType(); ?><br />
						價格：NT$<input type="text" name="price" style="width: 50px" value="<?php echo $data[0]['price'] ?>" required><br />
						敘述：<input type="text" name="discribe" value="<?php echo $data[0]['discribe'] ?>" style="width: 450px" ><br />
						<input type="submit" name="submit" class="btn btn-primary half" value="確定修改">
						<input type="button" name="button" class="btn btn-red half" value="刪除商品資料" onclick="javascript:location.href='delData.php?type=products&id=<?php echo $data[0]['pid'];?>'">
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include_once "../temp/footer.php" ?>
</body>
</html>