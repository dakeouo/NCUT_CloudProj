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
					<ul>
					<?php for($i=0;$i<5;$i++){ ?>
						<li>
							<div class="img"></div>
							<label class="sub-title">商品名稱</label><br />
							<label class="sub-price">NT$100</label>
						</li>
					<?php } ?>
					</ul>
					<?php echo '<input type="hidden" id="item1" value="'.$i.'">' ?>
				</div>
			</div>
			<div class="content-area" id="area2">
				<label class="title">飲品排名</label>
				<div class="area-block">
					<ul>
					<?php for($i=0;$i<5;$i++){ ?>
						<li>
							<div class="img"></div>
							<label class="sub-price">
								<?php echo "第".($i+1)."名"; ?>
							</label><br />
							<label class="sub-title">商品名稱</label>
						</li>
					<?php } ?>
					</ul>
					<?php echo '<input type="hidden" id="item2" value="'.$i.'">' ?>
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
		var h = item*18.8 + 5;
    	$("#area1").css("height", h+"em");
    	item = parseInt($("#item2").attr("value")/5);
		if($("#item2").attr("value")%5) item++;
		var h = item*18.8 + 5;
    	$("#area2").css("height", h+"em");
	});
</script>
</html>