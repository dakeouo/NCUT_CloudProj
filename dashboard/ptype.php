<?php include_once "temp/check.php"; ?>
<?php include_once "../model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = " 商品類別管理";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<?php if($_GET){ ?>
		<div id="hide-form">
			<?php if(isset($_GET['id'])){ ?>
			<div class="hide-ptype-form">
				<label id="total-title">修改類別名稱</label>
				<a href="ptype.php" id="total-btn" class="btn btn-second">返回</a>
				<?php $value = $dataset->getProductType($_GET['id']); ?>
				<form method="POST" action="../authcheck.php">
					<input type="hidden" name="type_id" value="<?php echo $_GET['id']; ?>">
					<input type="hidden" name="mode" value="back-ptype-edit">
					類別編號：<?php echo str_pad($_GET['id'],2,'0',STR_PAD_LEFT); ?><br />
					名稱：<input type="text" name="name" value="<?php echo $value; ?>"><br />
					<input type="submit" name="submit" class="btn btn-primary fit" value="確定修改" onclick="">
				</form>
			</div>
			<?php }else if(isset($_GET['new'])){ ?>
			<div class="hide-ptype-form">
				<label id="total-title">新增類別名稱</label>
				<a href="ptype.php" id="total-btn" class="btn btn-second">返回</a>
				<form method="POST" action="../authcheck.php">
					<input type="hidden" name="mode" value="back-ptype-add">
					名稱：<input type="text" name="name" value=""><br />
					<input type="submit" name="submit" class="btn btn-green fit" value="確定新增" onclick="">
				</form>
			</div>
			<?php } ?>
		</div>
	<?php } ?>
	<div class="container">
		<div class="content">
			<div id="backend-title-area">
				<label id="total-title"><?php echo $title;?></label>
				<a href="products.php" id="total-btn" class="btn btn-second">返回商品管理</a>
				<a href="ptype.php?new=0" id="total-btn" class="btn btn-green">新增類別</a>
			</div>
			<div id="backend-content-area">
				<table id="back-table">
					<tbody>
						<th>類別編號</th>
						<th>名稱</th>
						<th>修改</th>
						<th>刪除</th>
					</tbody>
					<?php $dataset->getProductType(); ?>
				</table>
			</div>
		</div>
	</div>
	<?php include_once "../temp/footer.php" ?>
</body>
</html>