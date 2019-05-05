<?php include_once "model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
	<?php $title = "購物車";  include_once "temp/header.php"; ?>
</head>
<body onload="init()">
	<?php include_once "temp/banner.php" ?>
	<div class="container">
		<div id="contentImg"></div>
		<div class="content">
			<div id="schedule-bar">
				<label class="step-label">STEP1</label>
				<label class="step-name">購物車</label>
				<img src="<?php echo $dataset->main->myImg("arrow.png"); ?>">
				<label class="step-label step-gray">STEP2</label>
				<label class="step-name step-name-gary">訂單資訊</label>
				<img src="<?php echo $dataset->main->myImg("arrow.png"); ?>">
				<label class="step-label step-gray">STEP3</label>
				<label class="step-name step-name-gary">訂單完成</label>
			</div>
			<div id="cart-content">
				以下是您目前所選擇的品項：
			<form name="cart" method="POST" action="order.php">
				<div style="position: relative;top: 1em;">
					<table>
						<tbody>
							<th>商品編號</th>
							<th>商品名稱</th>
							<th>單價</th>
							<th>數量</th>
							<th>價格</th>
							<th>刪除</th>
						</tbody>
						<?php $coun = $dataset->getCart($_SESSION['cart_token']); ?>
					</table>
					<input type="hidden" id="coun" value="<?php echo $coun;?>">
					<input type="hidden" id="ct" name="total" value="0">
					<div id="cart-price">
						<label style="font-size: 22px;">總金額：</label>
						<label class="price-red">NT$</label>
						<label class="price-red" id="cart-total">0</label>
					</div>
				</div>
				<div style="position: relative; top: 2em;">
					<input type="button" name="send" class="btn btn-primary fit" value="確認購買" onclick="itemUnitCheck(<?php echo $coun; ?>);">
				</div>
			</form>
			</div>
		</div>
	</div>
	<?php include_once "temp/footer.php" ?>
</body>
<script>
	function init(){
		var coun = document.getElementById("coun").value;
		var price_item, price, sub_item, total = 0;
		for(var i = 0; i < coun; i++) {
			price_item = 'price'.concat('[', i,']');
			price = document.getElementById(price_item).innerHTML;
			sub_item = 'sub-total'.concat('[', i,']');
			document.getElementById(sub_item).innerHTML = price;
			total = Number(total) + Number(price);
		}
		document.getElementById("cart-total").innerHTML = total;
		document.getElementById("ct").value = total;
	}
	function sub_total(id){
		var price_item, price, unit_item, unit, sub_item, sub, total=0;
		var coun = document.getElementById("coun").value;
		price_item = 'price'.concat('[', id,']');
		price = document.getElementById(price_item).innerHTML;
		unit_item = 'unit'.concat('[', id,']');
		unit = document.getElementById(unit_item).value;
		sub_item = 'sub-total'.concat('[', id,']');
		document.getElementById(sub_item).innerHTML = price*unit;
		for(var i = 0; i < coun; i++) {
			sub_item = 'sub-total'.concat('[', i,']');
			sub = document.getElementById(sub_item).innerHTML;
			total = Number(total) + Number(sub);
		}
		document.getElementById("cart-total").innerHTML = total;
		document.getElementById("ct").value = total;
	}
	function itemUnitCheck(coun){
		var frm = document.forms["cart"];
		if(coun != 0){
			frm.submit();
		}else{
			alert("您尚未選購任何商品!!");
		}
	}
</script>
</html>