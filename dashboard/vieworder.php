<?php include_once "temp/check.php"; ?>
<?php include_once "../model/dataset.php"; $dataset = new Dataset();?>
<?php ?>
<html>
<head>
	<?php $title = "訂單瀏覽";  include_once "temp/header.php"; ?>
</head>
<body>
	<?php include_once "temp/banner.php" ?>
	<div class="container">
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
						<tbody id="back-table">
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
				<div style="position: relative;top: 3em;">
					<?php 
					if($data[0]['status'] == 0){$dataset->mysql->setOrderStatus($_GET['oid'],1);}
					if($data[0]['status'] < 2){echo '<a href="../method/setStatus.php?id='.$_GET['oid'].'&status=2" class="btn btn-green" style="padding: 0.3em 5em; position: relative; left: 0.3em;margin-right: 0.4em;">標示已完成</a>';
					}else{echo '<label class="btn btn-enable" style="padding: 0.3em 5em;">標示已完成</label>';}
					if($data[0]['status'] == 2){echo '<a href="../method/setStatus.php?id='.$_GET['oid'].'&status=3" class="btn btn-second" style="padding: 0.3em 5em; position: relative; left: 0.3em;margin-right: 0.4em;">買家已取貨</a>';
					}else{echo '<label class="btn btn-enable" style="padding: 0.3em 5em;">買家已取貨</label>';}
					if($data[0]['status'] < 4){echo '<a href="../method/delData.php?type=orders&id='.$_GET['oid'].'" class="btn btn-red" style="padding: 0.3em 5em; position: relative; left: 0.3em;margin-right: 0.4em;">刪除訂單</a>';
					}else{echo '<label class="btn btn-enable" style="padding: 0.3em 5em;">刪除訂單</label>';}
					?>
				</div>
			</div>
		</div>
	</div>
	<?php include_once "../temp/footer.php" ?>
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