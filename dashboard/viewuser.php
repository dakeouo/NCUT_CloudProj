<?php include_once "temp/check.php"; ?>
<?php include_once "../model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = "會員資料瀏覽";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div class="content">
			<div id="backend-title-area">
				<label id="total-title"><?php echo $title;?></label>
				<a href="users.php" id="total-btn" class="btn btn-second">返回</a>
			</div>
			<div id="backend-content-area">
				<?php $data = $dataset->getUserSingleData($_GET['uid']);?>
				<div id="backend-user-title">
					<img src="../asset/img/test/user_default.png">
					<label><?php echo $data[0]['username']; ?></label>
				</div>
				<div id="backend-user-info">
					會員編號：<?php echo $data[0]['uid']; ?><br />
					性別：<?php echo $data[0]['sex']; ?><br />
					行動電話：<?php echo $data[0]['phone']; ?><br />
					電子郵件：<?php echo $data[0]['email']; ?><br />
					會員加入時間：<?php echo $data[0]['add_at']; ?><br />
					資料修改時間：<?php echo $data[0]['edit_at']; ?><br />
					<input type="button" name="button" class="btn btn-second third" value="重置會員密碼" onclick="">
					<input type="button" name="button" class="btn btn-red third" value="刪除會員資料" onclick="javascript:location.href='delData.php?type=users&id=<?php echo $data[0]['uid'];?>'">
				</div>
			</div>
		</div>
	</div>
	<?php include_once "../temp/footer.php" ?>
</body>
</html>