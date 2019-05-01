<?php
include_once "main.php";
class Mysql{
	public $conn = null;
	public $main = null;
	function __construct(){
		$servername = $GLOBALS["DB_hostname"];
		$username = $GLOBALS['DB_username'];
		$password = $GLOBALS['DB_password'];
		$dbname = $GLOBALS['DB_dbname'];
		
		$this->conn = new mysqli($servername, $username, $password, $dbname);
		if ($this->conn->connect_error) {
    		die("Connection failed: " . $this->conn->connect_error);
		}
		$this->main = new Main();
	}
	function __destruct(){
		$this->conn->close();
	}
	function SQL_Query($type,$sql){
		if (!($this->conn->query($sql) === TRUE)){
			if($type == "INSERT"){
				$this->main->Alert("Creating record fail: " . $this->conn->error);
			}else if($type == "UPDATE"){
				$this->main->Alert("Error updating record: " . $this->conn->error);
			}else if($type == "DELETE"){
				$this->main->Alert("Error delete record: " . $this->conn->error);
			}
			return false;
		}else return true;
	}
	function ItemisExist($type,$name){
		if($type == "shops"){
			$sql = "SELECT sid, name FROM shops WHERE name='".$name."' AND isActive=1 LIMIT 0,1";
		}else if($type == "ptypes"){
			$sql = "SELECT `type_id`,`name` FROM `product_type` WHERE `isActive` = 1 AND name='".$name."' LIMIT 0,1";
		}else if($type == "products"){
			$sql = "SELECT `pid`,`name` FROM `products` WHERE `isActive` = 1 AND name='".$name."' LIMIT 0,1";
		}else if($type == "users"){
			$sql = "SELECT `uid`,`email` FROM `users` WHERE `isActive` = 1 AND email='".$name."' LIMIT 0,1";
		}
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0){
			if($row = $result->fetch_assoc()){
				if($type == "shops") return $row["sid"];
				else if($type == "ptypes") return $row["type_id"];
				else if($type == "products") return $row["pid"];
				else if($type == "users") return $row["uid"];
			}
		}else{
			return false;
		}
	}
	function userCheck($type,$account,$password=null){
		if($type == "users"){
			$sql = "SELECT uid, username, password FROM users WHERE email='".$account."' AND uid <> 'A00000' AND isActive=1";
		}else if($type == "shops"){
			$sql = "SELECT sid, name, password FROM shops WHERE sid='".$account."' AND isActive=1";
		}else if($type == "users-uid"){
			$sql = "SELECT uid, username, password FROM users WHERE uid='".$account."' AND isActive=1";
		}else if($type == "users-cart"){
			$sql = "SELECT uid, username, phone, password FROM users WHERE uid='".$account."' AND isActive=1";
		}
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0){
			if($row = $result->fetch_assoc()){
				if(md5($password,FALSE) != $row["password"] AND $type != "users-cart") return -1;
				else{
					if($type == "users" or $type == "users-uid") return array(
						"id" => $row["uid"],
						"name" => $row["username"],
					);
					else if($type == "shops") return array(
						"id" => $row["sid"],
						"name" => $row["name"],
					);
					else if($type == "users-cart") return array(
						"id" => $row["uid"],
						"name" => $row["username"],
						"phone" => $row["phone"]
					);
				}
			}
		}else return false;
	}
	function getNumber($name){
		switch ($name){
			case 'users':
				$varName = 'member_last_id'; 
				$lab = 'A'; $len = 5;  break;
			case 'shops':
				$varName = 'shop_last_id'; 
				$lab = 'S'; $len = 4;  break;
			case 'products':
				$varName = 'product_last_id'; 
				$lab = 'P'; $len = 6;  break;
			case 'ptypes':
				$varName = 'ptype_last_id'; 
				$lab = 'C'; $len = 2;  break;
			default:
				$varName = null;  break;
		}
		$sql = "SELECT var FROM vars WHERE name='".$varName."'";
		$result = $this->conn->query($sql);
		$value = 0;
		if ($result->num_rows > 0){
			if($row = $result->fetch_assoc()) $value = $row["var"];
		}else $value = -1;
		if($value != -1){
			$sql = "UPDATE vars SET var =".($value+1)." WHERE name='".$varName."'";
			$this->SQL_Query("UPDATE",$sql);
			return $lab.str_pad($value,$len,'0',STR_PAD_LEFT);
		}else return null;
	} 

	function getData($name,$id=null){
		switch ($name) {
			case 'users':
				if($id){
					$sql = "SELECT `uid`, `username`, `sex`, `phone`, `email`, `add_at`,`edit_at` FROM `users` WHERE `uid` = '".$id."' AND isActive = 1";
				}else{
					$sql = "SELECT `uid`, `username`, `sex`, `phone`, `email`, `add_at` FROM `users` WHERE `uid` <> 'A00000' AND isActive = 1";
				}
				break;
			case 'shops':
				if($id) $sql = "SELECT `sid`, `name`, `zone_id`, `phone_id`, `phone`, `address`,`start_at`,`end_at` FROM `shops` WHERE `sid`='".$id."' AND isActive = 1";
				else{
					$sql = "SELECT `sid`, `name`, `zone_id`, `phone_id`, `phone`, `address`,`start_at`,`end_at` FROM `shops` WHERE `sid` <> 'S0000' AND isActive = 1";
				}
				break;
			case 'products':
				if($id) $sql = "SELECT pid, name, type_id, path, price, discribe FROM `products` WHERE isActive = 1 AND `pid`='".$id."'";
				else{
					$sql = "SELECT `products`.pid, `products`.name,`product_type`.`name` AS type,`products`.name,`products`.path,`products`.price FROM `products` JOIN `product_type` ON `products`.`type_id` = `product_type`.`type_id` WHERE `products`.isActive = 1";
				}
				break;
			case 'zones':
				$sql = "SELECT `zone_id`,`name` FROM `zone` WHERE 1";
				break;
			case 'pTypes':
				if($id) $sql = "SELECT `type_id`,`name` FROM `product_type` WHERE `isActive` = 1 AND `type_id` = '".$id."'";
				else $sql = "SELECT `type_id`,`name` FROM `product_type` WHERE `isActive` = 1";
				break;
			default:
				# code...
				break;
		}
		$result = $this->conn->query($sql);
		$value = array();
		if ($result->num_rows > 0){
			while($row = mysqli_fetch_assoc($result)){
				array_push($value,$row);
			}
		}else $value = -1;
		return $value;
	}
	function getRank($name,$type=null,$rank){
		switch ($name) {
			case 'products':
				if($type){
					$sql = "SELECT `name`, `price`,`path` FROM `products` WHERE `type_id` = '".$type."' AND isActive = 1 AND count <> 0 ORDER BY `count` DESC LIMIT 0,".$rank;
				}else{
					$sql = "SELECT `name`, `price`,`path` FROM `products` WHERE  isActive = 1 ORDER BY `count` DESC LIMIT 0,".$rank;
				}
				break;
			case 'shops':
				$sql = "SELECT `sid`, `name`, `phone_id`, `phone`, `address`,`start_at`,`end_at` FROM `shops` WHERE isActive = 1";
				break;
			default:
				# code...
				break;
		}
		$result = $this->conn->query($sql);
		$value = array();
		if ($result->num_rows > 0){
			while($row = mysqli_fetch_assoc($result)){
				array_push($value,$row);
			}
		}else $value = -1;
		return $value;
	}
	function updatePasswd($type,$id,$md5_pwd,$isRoot=FALSE){
		switch ($type) {
			case 'shops':
				$sql = 'UPDATE `shops` SET `password`="'.$md5_pwd.'" WHERE `sid`="'.$id.'"';
				break;
			case 'users':
				$sql = 'UPDATE `users` SET `password`="'.$md5_pwd.'" WHERE `uid`="'.$id.'"';
				break;
			default:
				# code...
				break;
		}
		if (!($this->conn->query($sql) === TRUE)){
			$this->main->Alert("Error updating record: " . $this->conn->error);
		}else{
			$this->main->Alert("修改密碼成功(編號：".$id.")");
			if($isRoot){
				$this->main->goBack();
			}else{
				if($type=='shops') $this->main->myUrl("dashboard/logout.php");
				else if($type=='users') $this->main->myUrl("logout.php");
			}
		}
	}
	
}
?>