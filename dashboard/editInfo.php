<?php include_once "temp/check.php"; ?>
<?php include_once "../model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = "資料修改";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<?php if($_GET){ ?>
		<div id="hide-form">
			<?php if(isset($_GET['mod'])){ ?>
			<div class="hide-ptype-form">
				<label id="total-title">修改密碼</label>
				<a href="editInfo.php" id="total-btn" class="btn btn-second">返回</a>
				<form method="POST" action="../method/chData.php">
					<input type="hidden" name="sid" value="<?php echo $_SESSION['shopId']; ?>">
					<input type="hidden" name="mode" value="passwd-change">
					<input type="hidden" name="type" value="shops">
					舊密碼：<input type="password" name="old-passwd" required><br />
					新密碼：<input type="password" name="new-passwd" required><br />
					<input type="submit" name="submit" class="btn btn-primary fit" value="確定修改" onclick="">
				</form>
			</div>
			<?php } ?>
		</div>
	<?php } ?>
	<div class="container">
		<div class="content">
			<div id="backend-title-area">
				<label id="total-title"><?php echo $title;?></label>
				<a href="viewInfo.php" id="total-btn" class="btn btn-second">返回</a>
			</div>
			<div id="backend-content-area">
				<div id="backend-form-photo"><div>
					<img src="<?php echo $dataset->main->myImg(null,"shops"); ?>">
				</div></div>
				<div id="backend-form-input">
					<?php $data = $dataset->getShopSingleData($_SESSION['shopId']);?>
					<form method="POST" action="../method/chData.php">
						<input type="hidden" name="mode" value="back-shop-edit">
						<input type="hidden" name="sid" value="<?php echo $data[0]['sid'] ?>">
						門市編號：<?php echo $data[0]['sid']; ?><br />
						門市名稱：<input type="text" name="name" value="<?php echo $data[0]['name'] ?>" required><br />
						行政區：<?php $dataset->getZone($data[0]['zone_id']); ?><br />
						電話：<input type="text" name="phone_id" placeholder="區碼" style="width: 50px" value="<?php echo $data[0]['phone_id'] ?>" required>-
						<input type="tel" name="phone" placeholder="電話" value="<?php echo $data[0]['phone'] ?>" required><br />
						營業時間：<?php $dataset->getTimeOption("start_at",$data[0]['start_at']); ?> - <?php $dataset->getTimeOption("end_at",$data[0]['end_at']); ?><br />
						地址：<input type="text" name="address" style="width: 450px" value="<?php echo $data[0]['address'] ?>" required><br />
						<input type="submit" name="submit" class="btn btn-primary half" value="確定修改">
						<input type="button" name="button" class="btn btn-second half" value="修改密碼" onclick="javascript:location.href='./editInfo.php?mod=1'">
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include_once "../temp/footer.php" ?>
</body>
</html>