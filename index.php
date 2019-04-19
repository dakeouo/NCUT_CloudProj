<html>
<head>
	<?php $title = "首頁";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div id="headerImg"></div>
		<div class="content">
			<div class="content-area">
				<label class="title">熱門飲品</label>
				<div class="area-block">
					<ul>
					<?php for($i=0;$i<5;$i++){ ?>
						<li>
							<div class="img"></div>
							<label class="sub-title">商品名稱</label>
						</li>
					<?php } ?>
					</ul>
				</div>
			</div>
			<div class="content-area">
				<label class="title">暢銷排名</label>
				<div class="area-block">
					<ul>
					<?php for($i=0;$i<5;$i++){ ?>
						<li>
							<div class="img"></div>
							<label class="sub-title">商品名稱</label>
						</li>
					<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php include_once "temp/footer.php" ?>
</body>
</html>