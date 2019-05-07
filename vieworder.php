<?php include_once "model/dataset.php"; $dataset = new Dataset();?>
<?php ?>
<html>
<head>
	<?php $title = "訂單瀏覽";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div id="contentImg">
			<?php echo '<div><img src="'.$dataset->main->myImg($GLOBALS['photoDef']['sub-header']).'"></div>' ?>
		</div>
		<div class="content">
			<div id="backend-title-area">
				<label id="total-title"><?php echo $title;?></label>
				<input type="button" name="" style="position: relative; top: -0.1em; padding: 0 1em; height: 1.8em;" class="btn btn-second" value="返回" onclick="history.back()">
			</div>
			<div id="backend-content-area">
				<?php $data = $dataset->getOrderSingleData($_GET['oid']);?>
				<h3>訂單編號：<?php echo "<font color='red'>".$data[0]['order_id']."</font>"; ?></h3>
				<label style="font-size: 1.2em;">
					取貨人：<?php echo "<b>".$data[0]['person']."</b>"; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					連絡電話：<?php echo "<b>".$data[0]['phone']."</b>"; ?><br />
					取貨門市：<?php echo "<b>".$data[0]['name']."門市</b>"; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					預計取貨時間：<?php echo "<b>".$data[0]['pick_time']."</b>"; ?><br />
					成立時間：<?php echo "<b>".$data[0]['add_at']."</b>"; ?><br />
					完成時間：<?php echo "<b>".$data[0]['finish_at']."</b>"; ?><br />實際取貨時間：<?php echo "<b>".$data[0]['pick_at']."</b>"; ?><br /><br />
					以下商品詳細內容：<br />
					<table>
						<tbody>
							<th>商品編號</th>
							<th>商品名稱</th>
							<th>單價</th>
							<th>數量</th>
							<th>小計</th>
						</tbody>
						<?php $item = $dataset->getOrderItemData($_GET['oid']);?>
						<input type="hidden" id="item" value="<?php echo $item; ?>">
					</table>
				</label>
				<div style="position: relative; top: 0.5em; float: right;">
					總金額：<label style="font-size: 1.4em; color:red;">
						<?php echo "<b>NT$".$data[0]['total']."</b>";?>
					</label>&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</div>
		</div>
	</div>
	<?php include_once "temp/footer.php" ?>
</body>
<script>
	$(function() {
		var item = parseInt($("#item").attr("value"));
		if(item < 2) item = 0;
		var h = 43 + (item-8)*2;
    	$("#backend-content-area").css("height", h+"em");
	});
</script>
</html>