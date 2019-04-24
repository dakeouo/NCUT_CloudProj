<?php include_once "temp/check.php"; ?>
<?php include_once "../model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = " 商品管理";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div class="content">
			<div id="backend-title-area">
				<label id="total-title"><?php echo $title;?></label>
				<a href="newproduct.php" id="total-btn" class="btn btn-green">新增商品</a>
				<a href="ptype.php" id="total-btn" class="btn btn-second">商品類別管理</a>
			</div>
			<div id="backend-content-area">
				<table id="back-table">
					<tbody>
						<th>商品編號</th>
						<th>圖片</th>
						<th>商品名稱</th>
						<th>類別</th>
						<th>單價</th>
						<th>修改</th>
					</tbody>
					<!-- <?php $dataset->getShopData(); ?> -->
				</table>
			</div>
		</div>
	</div>
	<?php include_once "../temp/footer.php" ?>
</body>
</html>