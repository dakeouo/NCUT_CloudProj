<?php include_once "model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = "首頁";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div id="headerImg"></div>
		<div class="content">
			<div class="content-area" id="area1">
				<label class="title">熱門飲品</label>
				<div class="area-block">
					<?php $coun = $dataset->getRank(); ?>
				</div>
			</div>
			<div class="content-area" id="area2">
				<label class="title">各類飲品排名</label>
				<div style="position: relative;top: 2em;">
					<table>
						<tbody>
							<th>類別</th>
							<th>排名</th>
							<th>名稱</th>
							<th>價格</th>
						</tbody>
						<?php $coun = $dataset->getTypeRank(3); ?>
					</table>
				</div>
				<input type="hidden" id="coun" value="<?php echo $coun;?>">
			</div>
		</div>
	</div>
	<?php include_once "temp/footer.php" ?>
</body>
<script>
	$(function() {
		var h = 21.5;
    	$("#area1").css("height", h+"em");
    	item = parseInt($("#coun").attr("value"));
		var h = 11 + item*2.6;
    	$("#area2").css("height", h+"em");
	});
</script>
</html>