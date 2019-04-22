<html>
<head>
	<?php $title = "註冊";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div class="login-form">
			<label class="title">NCUT TeaShop</label>
			<form method="POST" action="authcheck.php">
				<input type="hidden" name="mode" value="register">
				<input type="text" name="username" placeholder="用戶名" required>
				<input type="password" name="password" placeholder="密碼(8-15位元，字母、數字各1)" required>
				<div class="form-block">
					性別：<input type="radio" name="sex" value="M">男&nbsp;&nbsp;
					<input type="radio" name="sex" value="F">女&nbsp;&nbsp;
					<input type="radio" name="sex" value="N" checked>不願透露
				</div>
				<input type="text" name="phone" placeholder="行動電話" required>
				<input type="email" name="email" placeholder="電子信箱(帳號)" required>
				<input type="submit" name="submit" class="btn btn-primary fit" value="註冊">
				<input type="button" name="submit" class="btn btn-second fit" value="返回登入畫面" onclick="javascript:location.href='login.php'">
			</form>
		</div>
	</div>
	<?php include_once "temp/footer.php" ?>
</body>
</html>