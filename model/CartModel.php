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
				if(!$this->mysql->cartItemisExist($token,$pid)){
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
}
?>