<?php include_once "model/dataset.php"; $dataset = new Dataset();?>
<html>
<head>
<?php $title = "訂單資訊";  include_once "temp/header.php"; ?>
<?php if($_POST){$cartModel->setCartItem($_SESSION['cart_token'],$_POST['itemId'],$_POST['unit'],$_POST['total']);}?>
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
				<label class="step-label">STEP2</label>
				<label class="step-name">訂單資訊</label>
				<img src="<?php echo $dataset->main->myImg("arrow.png"); ?>">
				<label class="step-label step-gray">STEP3</label>
				<label class="step-name step-name-gary">訂單完成</label>
			</div>
			<div id="cart-content">
				<div id="order-msg">
					<?php 
					if($_POST){
						echo '訂購&nbsp;<font color="red">'.count($_POST['itemId']).'</font>&nbsp;項商品，總金額共&nbsp;<font color="red">NT$'.$_POST['total'].'</font>&nbsp;。';
					}else{
						$data = $cartModel->getOrder($_SESSION['cart_token']);
						echo '訂購&nbsp;<font color="red">'.$data['item'].'</font>&nbsp;項商品，總金額共&nbsp;<font color="red">NT$'.$data['total'].'</font>&nbsp;。';
					}
					$unitForItem = $cartModel->getOrderItem($_SESSION['cart_token']);
					if($unitForItem != -1){
						echo '<br /><font style="font-size:14px; color:#666; height:1.2em;">訂購商品：';
						$c = 0; $totalunit = count($unitForItem);
						foreach ($unitForItem as $key) {
							echo $key['name']."x".$key['unit'];
							if($c < $totalunit-1) echo "、";
							$c++;
						}
						echo '</font>';
					}
					?>
				</div>
				<div id="order-form">
					<form name="orders" method="POST" action="createOrder.php">
						<?php
						if(isset($_SESSION['uid'])){
							$uid = $_SESSION['uid'];
							$SQL = $cartModel->mysql->userCheck("users-cart",$uid);
							if($SQL){$SQL_Name = $SQL['name'];  $SQL_Phone = $SQL['phone'];}
							else{$SQL_Name = "";  $SQL_Phone = "";}
						}else{
							$uid = "A00000";
							$SQL_Name = "";  $SQL_Phone = "";
						}
						  echo '<input type="hidden" name="uid" value="'.$uid.'">';
						  echo '<input type="hidden" name="SQL_Name" value="'.$SQL_Name.'">';
						  echo '<input type="hidden" name="SQL_Phone" value="'.$SQL_Phone.'">';
						?>
						<?php  ?>
						<input type="hidden" name="token" value="<?php echo $_SESSION['cart_token']; ?>">
						取貨人&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="text" name="name" style="width: 15em;" placeholder="請填寫姓名" required><br />
						行動電話&nbsp;
						<input type="tel" name="phone" style="width: 15em;" pattern="[0-9]{4}-[0-9]{6}" placeholder="格式：09xx-xxxxxx" required><br />
						取貨門市&nbsp;
						<?php $dataset->getShop(); ?><br />
						預計取貨時間&nbsp;
						<?php $dataset->getIntervalTime(); ?><br />
						<input type="button" name="" class="btn btn-second half" value="同會員資料" onclick="sameFromUser()">
						<input type="submit" name="submit" class="btn btn-primary half" value="送出訂單">
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include_once "temp/footer.php" ?>
</body>
<script>
	function sameFromUser(){
		orders.name.value =  orders.SQL_Name.value;
		orders.phone.value =  orders.SQL_Phone.value;
	}
</script>
</html>