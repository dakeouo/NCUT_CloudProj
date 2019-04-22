<html>
<head>
	<?php $title = "登入";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div class="login-form">
			<label class="title">NCUT TeaShop</label>
			<form method="POST" action="authcheck.php">
				<input type="hidden" name="mode" value="login">
				<input type="email" name="email" id="email" placeholder="電子信箱" required>
				<input type="password" name="password" id="password" placeholder="密碼" required>
				<input type="button" name="submit" class="btn btn-second half" value="註冊" onclick="javascript:location.href='register.php'">
				<input type="submit" name="submit" class="btn btn-primary half" value="登入">
			</form>
		</div>
	</div>
	<?php include_once "temp/footer.php" ?>
</body>
</html>