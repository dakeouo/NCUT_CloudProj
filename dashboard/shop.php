<?php include_once "temp/check.php"; ?>
<html>
<head>
	<?php $title = "店家管理";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div class="content">
			<div id="backend-title-area">
				<label id="total-title">店家管理</label>
				<a href="" id="total-btn" class="btn btn-green">新增店家</a>
			</div>
			<div id="backend-content-area">
				<table>
					<tbody>
						<th>店家編號</th>
						<th>門市名稱</th>
						<th>行政區</th>
						<th>電話</th>
						<th>地址</th>
						<th>修改</th>
					</tbody>
					<tr>
						<td>A0000</td>
						<td>總店</td>
						<td>台中市</td>
						<td>(04)23924505</td>
						<td>臺中市太平區坪林里中山路二段 57號</td>
						<td>修改</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<?php include_once "../temp/footer.php" ?>
</body>
</html>