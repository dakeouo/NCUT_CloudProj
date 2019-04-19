<html>
<head>
	<?php $title = "登入";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div class="login-form">
			<label class="title">NCUT TeaShop</label>
			<form method="POST" action="">
				<input type="email" name="email" placeholder="電子信箱">
				<input type="password" name="password" placeholder="密碼">
				<input type="button" name="submit" class="btn btn-second half" value="註冊" onclick="javascript:location.href='register'">
				<input type="button" name="submit" class="btn btn-primary half" value="登入">
			</form>
		</div>
	</div>
	<?php include_once "temp/footer.php" ?>
</body>
</html>