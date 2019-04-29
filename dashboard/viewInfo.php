<?php include_once "temp/check.php"; ?>
<?php include_once "../model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = "瀏覽資料";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div class="content">
			<div id="backend-title-area">
				<label id="total-title"><?php echo $title;?></label>
			</div>
			<div id="backend-content-area">
				<div id="backend-form-photo"><div>
					<img src="<?php echo $dataset->main->myImg(null,"shops"); ?>">
				</div></div>
				<div id="backend-form-input">
					<?php $data = $dataset->getShopSingleData($_SESSION['shopId']);?>
					門市編號：<?php echo $data[0]['sid']; ?><br />
					門市名稱：<?php echo $data[0]['name']; ?><br />
					電話：(<?php echo $data[0]['phone_id'].')'.$data[0]['phone']; ?><br />
					營業時間：<?php echo $data[0]['start_at'].' - '.$data[0]['end_at']; ?><br />
					地址：<?php echo $data[0]['address']; ?><br />
					<input type="button" name="button" class="btn btn-primary fit" value="修改資料" onclick="javascript:location.href='editInfo.php'">
				</div>
			</div>
		</div>
	</div>
	<?php include_once "../temp/footer.php" ?>
</body>
</html>