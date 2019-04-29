<?php include_once "model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = "個人資料";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div class="content">
			<div id="backend-title-area">
				<label id="total-title"><?php echo $title;?></label>
				<a href="member.php" id="total-btn" class="btn btn-second">返回</a>
			</div>
			<div id="backend-content-area">
				<?php $data = $dataset->getUserSingleData($_SESSION['uid']);?>
				<div id="backend-user-info">
					<form method="POST" action="method/chData.php">
						<input type="hidden" name="mode" value="user-edit">
						<input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">
						會員編號：<?php echo $data[0]['uid']; ?><br />
						會員姓名：<input type="text" name="username" value="<?php echo $data[0]['username']; ?>"><br />
						<div class="form-block">
							性別：<?php
							echo '<input type="radio" name="sex" value="0" ';
							if($data[0]['sex'] == 0) echo 'checked';
							echo '>男&nbsp;&nbsp;';
							echo '<input type="radio" name="sex" value="1" ';
							if($data[0]['sex'] == 1) echo 'checked';
							echo '>女&nbsp;&nbsp;';
							echo '<input type="radio" name="sex" value="2" ';
							if($data[0]['sex'] == 2) echo 'checked';
							echo '>不願透漏&nbsp;&nbsp;';
							?>
						</div>
						行動電話：<input type="text" name="phone" value="<?php echo $data[0]['phone']; ?>"><br />
						電子郵件：<input type="email" name="email" value="<?php echo $data[0]['email']; ?>"><br />
						<input type="submit" name="submit" class="btn btn-primary fit" value="確定修改">
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include_once "temp/footer.php" ?>
</body>
</html>