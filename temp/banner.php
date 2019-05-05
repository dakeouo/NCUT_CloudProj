<?php include_once "model/mysql.php"; $mysql = new Mysql();?>
<header class="front-header">
	<label id="title"><a href="index.php">NCUT TeaShop</a></label>
	<nav>
		<ul>
			<?php 
			if($cartModel->getCartStatus($_SESSION['cart_token']) == 1){
				echo '<li><a href="order.php" id="cart">購物車</a></li>';
			}else{
				echo '<li><a href="cart.php" id="cart">購物車</a></li>';
			}
			?>
			<li><a href="product.php">商品</a></li>
			<li><a href="contact.php">服務據點</a></li>
			<?php if(isset($_SESSION['uid'])){
				echo '<li><a href="order_list.php">訂單總覽</a></li>';
				echo '<li><a href="member.php" id="cart">✪ '.$_SESSION['username'].'</a></li>';
				echo '<li><a href="logout.php">登出</a></li>';
			}else{
				echo '<li><a href="login.php">會員登入</a></li>';
				echo '<li><a href="dashboard/" class="nav-btn">後台</a></li>';
			}?>
		</ul>
	</nav>
</header>