<?php include_once "model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = "服務據點";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div id="contentImg">
			<?php echo '<div><img src="'.$dataset->main->myImg($GLOBALS['photoDef']['sub-header']).'"></div>' ?>
		</div>
		<div class="content">
			<div class="content-area" id="area1">
				<label class="title">服務據點</label>
				<div class="area-contact">
					<?php $coun = $dataset->getShopItem(); ?>
				</div>
			</div>
			<input type="hidden" id="coun" value="<?php echo $coun;?>">
		</div>
	</div>
	<?php include_once "temp/footer.php" ?>
</body>
<script>
	$(function() {
		var item = parseInt($("#coun").attr("value")/2);
		//if($("#item1").attr("value")%5) item++;
		var h = item*17 + 5;
    	$("#area1").css("height", h+"em");
	});
</script>
</html>