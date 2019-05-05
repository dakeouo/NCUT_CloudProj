<?php include_once "temp/check.php"; ?>
<?php include_once "../model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = " 檢視歷史訂單";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div class="content">
			<div id="backend-title-area">
				<label id="total-title"><?php echo $title;?></label>
				<a href="orders.php" id="total-btn" class="btn btn-second">返回</a>
			</div>
			<div id="backend-content-area">
				<table id="back-table">
					<tbody>
						<th>訂單編號</th>
						<th>狀態</th>
						<th>訂購者</th>
						<th>總金額</th>
						<th>預計取貨時間</th>
						<th>成立時間</th>
						<th>檢視</th>
					</tbody>
					<?php $coun = $dataset->getOrderData("history"); ?>
				</table>
			</div>
			<input type="hidden" name="" id="coun" value="<?php echo $coun; ?>">
		</div>
	</div>
	<?php include_once "../temp/footer.php" ?>
</body>
<script>
	$(function() {
		var item = parseInt($("#coun").attr("value"));
		if(item < 8) item = 0;
		var h = 40 + (item-8)*4.38;
    	$("#backend-content-area").css("height", h+"em");
	});
</script>
</html>