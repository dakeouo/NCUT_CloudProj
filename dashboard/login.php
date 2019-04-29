<html>
<head>
	<?php $title = "登入";  include_once "temp/header.php"; ?>
</head>
<body bgcolor="#ccc">
	<div class="backend-login">
		<div class="back-title">NCUT TeaShop</div>
		<label class="back-info">後臺管理登入</label>
		<form method="POST" action="../method/chData.php">
				<input type="hidden" name="mode" value="back-login">
				<input type="text" name="shopId" id="shopId" placeholder="店家編號" required>
				<input type="password" name="password" id="password" placeholder="密碼(預設為店家編號)" required>
				<input type="submit" name="submit" class="btn btn-primary fit" value="登入">
				<input type="button" name="submit" class="btn btn-second fit" value="返回前台" onclick="javascript:location.href='../index.php'">
		</form>
	</div>
	<?php include_once "../temp/footer.php" ?>
</body>
</html>