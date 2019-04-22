<?php include_once "temp/check.php"; ?>
<?php include_once "../model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = "店家管理";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div class="content">
			<div id="backend-title-area">
				<label id="total-title"><?php echo $title;?></label>
				<a href="newshop.php" id="total-btn" class="btn btn-green">新增店家</a>
			</div>
			<div id="backend-content-area">
				<table id="back-table">
					<tbody>
						<th>店家編號</th>
						<th>門市名稱</th>
						<th>行政區</th>
						<th>電話</th>
						<th>地址</th>
						<th>修改</th>
					</tbody>
					<?php $dataset->getShopData(); ?>
				</table>
			</div>
		</div>
	</div>
	<?php include_once "../temp/footer.php" ?>
</body>
</html>