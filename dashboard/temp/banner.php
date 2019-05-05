<header class="front-header backend-header">
	<label id="title"><a href="index.php">TeaShop 後台管理</a></label>
	<nav>
		<ul>
			<?php 
			echo '<li><a href="viewInfo.php" id="cart">店家：'.$_SESSION['shopName'].'</a></li>';
			if($_SESSION['shopId'] == "S0000") echo '<li><a href="shops.php">店家管理</a></li>'; 
			?>
			<li><a href="orders.php">訂單管理</a></li>
			<li><a href="products.php">商品管理</a></li>
			<li><a href="users.php">會員管理</a></li>
			<li><a href="logout.php">登出</a></li>
		</ul>
	</nav>
</header>