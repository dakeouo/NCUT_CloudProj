<?php include_once "temp/check.php"; ?>
<?php include_once "../model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = "門市資料修改";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div class="content">
			<div id="backend-title-area">
				<label id="total-title"><?php echo $title;?></label>
				<a href="shops.php" id="total-btn" class="btn btn-second">返回</a>
			</div>
			<div id="backend-content-area">
				<div id="backend-form-photo"><div>
					<img src="<?php echo $dataset->main->myImg(null,"shops"); ?>">
				</div></div>
				<div id="backend-form-input">
					<?php $data = $dataset->getShopSingleData($_GET['sid']);?>
					<form method="POST" action="../authcheck.php">
						<input type="hidden" name="mode" value="back-shop-edit">
						<input type="hidden" name="sid" value="<?php echo $data[0]['sid'] ?>">
						門市編號：<?php echo $data[0]['sid']; ?><br />
						門市名稱：<input type="text" name="name" value="<?php echo $data[0]['name'] ?>" required><br />
						行政區：<?php $dataset->getZone($data[0]['zone_id']); ?><br />
						電話：<input type="text" name="phone_id" placeholder="區碼" style="width: 50px" value="<?php echo $data[0]['phone_id'] ?>" required>-
						<input type="tel" name="phone" placeholder="電話" value="<?php echo $data[0]['phone'] ?>" required><br />
						地址：<input type="text" name="address" style="width: 450px" value="<?php echo $data[0]['address'] ?>" required><br />
						<input type="submit" name="submit" class="btn btn-primary third" value="確定修改">
						<input type="button" name="button" class="btn btn-second third" value="重置店家密碼" onclick="">
						<input type="button" name="button" class="btn btn-red third" value="刪除門市資料" onclick="javascript:location.href='delData.php?type=shops&id=<?php echo $data[0]['sid'];?>'">
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include_once "../temp/footer.php" ?>
</body>
</html>