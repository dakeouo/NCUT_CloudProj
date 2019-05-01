<?php
include_once "mysql.php";
class CartModel{
	public $mysql=null;
	public $main=null;
	function __construct(){
		$this->mysql = new Mysql();
		$this->main = $this->mysql->main;
		//session_start();
	}
	function __destruct(){
		
	}
	function createCart($token){
		$sql = "INSERT INTO `carts` (token,users)VALUES ('".$token."','A00000')";
		if($this->mysql->SQL_Query("INSERT",$sql)) return true;
	}
	function CartItem($method,$pid,$token){
		switch ($method) {
			case 'add':
				if($this->cartisOrder($token) == 1){
					$this->main->Alert("商品項目已確認，不得再新增項目");
				}else if(!$this->cartItemisExist($token,$pid)){
					$sql = "INSERT INTO `cart_info` (token, pid, unit)VALUES ('".$token."','".$pid."', 1)";
					$this->mysql->SQL_Query("INSERT",$sql);
				}
				break;
			case 'remove':
				$sql = "DELETE FROM `cart_info` WHERE `pid`= '".$pid."' AND `token` = '".$token."'";
				$this->mysql->SQL_Query("DELETE",$sql);
				break;
			default:
				# code...
				break;
		}
		//$this->main->goBack();
	}
	function setCartItem($token,$pid,$unit,$total){
		$sql = "UPDATE `carts` SET `item`=".count($pid).",`total`= ".$total.",`status`= 1 WHERE `token` = '".$token."'";
		$this->mysql->SQL_Query("UPDATE",$sql);
		for($i=0;$i<count($pid);$i++) { 
			$sql = "UPDATE `cart_info` SET `unit`= '".$unit[$i]."' WHERE `token` = '".$token."' AND `pid`='".$pid[$i]."'";
			$this->mysql->SQL_Query("UPDATE",$sql);
		}
	}
	function cartItemisExist($token,$pid){
		$sql = "SELECT token, pid FROM cart_info WHERE `token`='".$token."' AND `pid` = '".$pid."'";
		$result = $this->mysql->conn->query($sql);
		$value = array();
		if ($result->num_rows > 0){
			return true;
		}else return false;
	}
	function getCartItem($token){
		$sql = "SELECT `products`.`pid`,`products`.`name`,`products`.`price` FROM `cart_info` JOIN `products` ON `cart_info`.`pid` = `products`.`pid` WHERE `cart_info`.`token` = '".$token."' ORDER BY `products`.`pid`";
		//$this->main->Alert($sql);
		$result = $this->mysql->conn->query($sql);
		$value = array();
		if ($result->num_rows > 0){
			while($row = mysqli_fetch_assoc($result)){
				array_push($value,$row);
			}
		}else $value = -1;
		return $value;
	}
	function cartisOrder($token){
		$sql = "SELECT status FROM carts WHERE `token`='".$token."'";
		$result = $this->mysql->conn->query($sql);
		if ($result->num_rows > 0){
			if($row = mysqli_fetch_assoc($result)){
				return $row['status'];
			}
		}else return -1;	
	}
	function getOrder($token){
		$sql = "SELECT item,total FROM carts WHERE `token`='".$token."'";
		$result = $this->mysql->conn->query($sql);
		if ($result->num_rows > 0){
			if($row = mysqli_fetch_assoc($result)){
				return array(
					'item' => $row['item'],
					'total' => $row['total']
				);
			}
		}else return -1;	
	}
	function delCart($token){
		$sql = "DELETE FROM `cart_info` WHERE `token` = '".$token."'";
		$this->mysql->SQL_Query("DELETE",$sql);
		$sql = "DELETE FROM `carts` WHERE `token` = '".$token."'";
		$this->mysql->SQL_Query("DELETE",$sql);
	}
	function changeCartItemOwner($old_token,$new_token,$pid){
		$sql = 'UPDATE `cart_info` SET `token`="'.$new_token.'" WHERE `token`="'.$old_token.'" AND `pid`="'.$pid.'"';
		$this->mysql->SQL_Query("UPDATE",$sql);
	}
	function cartUser($user,$token){
		$sql = "SELECT token, status FROM carts WHERE `users`='".$user."'";
		$result = $this->mysql->conn->query($sql);
		if ($result->num_rows > 0){
			if($row = mysqli_fetch_assoc($result)){
				$new_token = $row['token'];
				if($row['status'] == 0){
					$products = $this->mysql->getCartItem($token);
					if($products != -1){
						foreach($products as $item){
							if(!$this->mysql->cartItemisExist($new_token,$item['pid'])) $this->changeCartItemOwner($token,$new_token,$item['pid']);
						}
					}
					$this->main->Alert("您剛剛所選購的商品已合併至您的購物車內!!");
					$this->delCart($token);
				}else if($row['status'] == 1){
					$this->delCart($token);
					$this->main->Alert("尚有商品未結帳，請盡快填寫訂單資訊!!");
				}
				return $new_token;
			}
		}else{
			$sql = 'UPDATE `carts` SET `users`="'.$user.'" WHERE `token`="'.$token.'"';
			$this->mysql->SQL_Query("UPDATE",$sql);
			return $token;
		}
	}
	function getCartStatus($token){
		$sql = "SELECT status FROM carts WHERE `token`='".$token."'";
		$result = $this->mysql->conn->query($sql);
		if ($result->num_rows > 0){
			if($row = mysqli_fetch_assoc($result)){
				return $row['status'];
			}
		}else return -1;
	}
	function getOrderItem($token){
		$sql = "SELECT `products`.`name`, `cart_info`.`unit` FROM `cart_info` JOIN `products` ON `cart_info`.`pid` = `products`.`pid` WHERE `cart_info`.`token` = '".$token."'";
		$result = $this->mysql->conn->query($sql);
		$value = array();
		if ($result->num_rows > 0){
			while($row = mysqli_fetch_assoc($result)){
				array_push($value,$row);
			}
		}else return -1;
		return $value;
	}
}
?>