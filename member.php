<?php include_once "model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = "個人資料";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<?php if($_GET){ ?>
		<div id="hide-form">
			<?php if(isset($_GET['mod'])){ ?>
			<div class="hide-ptype-form">
				<label id="total-title">修改密碼</label>
				<a href="member.php" id="total-btn" class="btn btn-second">返回</a>
				<form method="POST" action="method/chData.php">
					<input type="hidden" name="sid" value="<?php echo $_SESSION['uid']; ?>">
					<input type="hidden" name="mode" value="passwd-change">
					<input type="hidden" name="type" value="users-uid">
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
			</div>
			<div id="backend-content-area">
				<?php $data = $dataset->getUserSingleData($_SESSION['uid']);?>
				<div id="backend-user-title">
					<img src="<?php echo $dataset->main->myImg(null,"users"); ?>">
					<label><?php echo $data[0]['username']; ?></label>
				</div>
				<div id="backend-user-info">
					會員編號：<?php echo $data[0]['uid']; ?><br />
					性別：<?php echo $data[0]['sex']; ?><br />
					行動電話：<?php echo $data[0]['phone']; ?><br />
					電子郵件：<?php echo $data[0]['email']; ?><br />
					會員加入時間：<?php echo $data[0]['add_at']; ?><br />
					資料修改時間：<?php echo $data[0]['edit_at']; ?><br />
					<input type="button" name="button" class="btn btn-primary third" value="修改會員資料" onclick="javascript:location.href='./editmember.php'">
					<input type="button" name="button" class="btn btn-second third" value="修改密碼" onclick="javascript:location.href='./member.php?mod=1'">
					<input type="button" name="button" class="btn btn-red third" value="刪除會員資料" onclick="javascript:location.href='method/delData.php?type=users&id=<?php echo $data[0]['uid'];?>'">
				</div>
			</div>
		</div>
	</div>
	<?php include_once "temp/footer.php" ?>
</body>
</html>