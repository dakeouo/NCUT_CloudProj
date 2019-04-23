<?php include_once "temp/check.php"; ?>
<?php include_once "../model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = "會員管理";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div class="content">
			<div id="backend-title-area">
				<label id="total-title"><?php echo $title;?></label>
			</div>
			<div id="backend-content-area">
				<table id="back-table">
					<tbody>
						<th>會員編號</th>
						<th>會員名稱</th>
						<th>性別</th>
						<th>電話</th>
						<th>電子信箱</th>
						<th>加入時間</th>
						<th>詳細</th>
					</tbody>
					<?php $dataset->getUserData(); ?>
				</table>
			</div>
		</div>
	</div>
	<?php include_once "../temp/footer.php" ?>
</body>
</html>