<html>
<head>
	<?php $title = "商品";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div id="contentImg"></div>
		<div class="content">
			<div class="content-area" id="area1">
				<label class="title">飲品總覽</label>
				<div class="area-block">
					<ul>
					<?php for($i=0;$i<30;$i++){ ?>
						<li>
							<div class="img"></div>
							<label class="sub-title">商品名稱</label><br />
							<label class="sub-price">NT$100</label><br />
							<div class="btn-block">
								<a href="" class="btn btn-primary">加入購物車</a>
							</div>
						</li>
					<?php } ?>
					</ul>
					<?php echo '<input type="hidden" id="item1" value="'.$i.'">' ?>
				</div>
			</div>
		</div>
	</div>
	<?php include_once "temp/footer.php" ?>
</body>
<script>
	$(function() {
		var item = parseInt($("#item1").attr("value")/5);
		if($("#item1").attr("value")%5) item++;
		var h = item*19.8 + 5;
    	$("#area1").css("height", h+"em");
	});
</script>
</html>