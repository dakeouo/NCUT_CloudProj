<?php
include_once "main.php";
class Mysql extends SQLite3{
	public $conn = null;
	public $main = null;
	function __construct(){
		$this->conn = new SQLite3($GLOBALS['rootPath']."/ncut_web2019.db", SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
		if (!$this->conn) {
    		die("Connection failed: " . $this->conn->lastErrorMsg());
		}
		$this->main = new Main();
	}
	function __destruct(){
		$this->conn->close();
	}
	function SQL_Query($type,$sql){
		if (!($this->conn->exec($sql) === TRUE)){
			if($type == "INSERT"){
				$this->main->Alert("Creating record fail: " . $this->conn->lastErrorMsg());
			}else if($type == "UPDATE"){
				$this->main->Alert("Error updating record: " . $this->conn->lastErrorMsg());
			}else if($type == "DELETE"){
				$this->main->Alert("Error delete record: " . $this->conn->lastErrorMsg());
			}
			return false;
		}else return true;
	}
	function ItemisExist($type,$name){
		if($type == "shops"){
			$sql = "SELECT sid, name FROM `web2019_shops` WHERE name='".$name."' AND isActive=1 LIMIT 0,1";
		}else if($type == "ptypes"){
			$sql = "SELECT `type_id`,`name` FROM `web2019_product_type` WHERE `isActive` = 1 AND name='".$name."' LIMIT 0,1";
		}else if($type == "products"){
			$sql = "SELECT `pid`,`name` FROM `web2019_products` WHERE `isActive` = 1 AND name='".$name."' LIMIT 0,1";
		}else if($type == "users"){
			$sql = "SELECT `uid`,`email` FROM `web2019_users` WHERE `isActive` = 1 AND email='".$name."' LIMIT 0,1";
		}
		$result = $this->conn->query($sql);
		if($row = $result->fetchArray(SQLITE3_ASSOC)){
			if($type == "shops") return $row["sid"];
			else if($type == "ptypes") return $row["type_id"];
			else if($type == "products") return $row["pid"];
			else if($type == "users") return $row["uid"];
		}else return false;
	}
	function userCheck($type,$account,$password=null){
		if($type == "users"){
			$sql = "SELECT uid, username, password FROM `web2019_users` WHERE email='".$account."' AND uid <> 'A00000' AND isActive=1";
		}else if($type == "shops"){
			$sql = "SELECT sid, name, password FROM `web2019_shops` WHERE sid='".$account."' AND isActive=1";
		}else if($type == "users-uid"){
			$sql = "SELECT uid, username, password FROM `web2019_users` WHERE uid='".$account."' AND isActive=1";
		}else if($type == "users-cart"){
			$sql = "SELECT uid, username, phone, password FROM `web2019_users` WHERE uid='".$account."' AND isActive=1";
		}

		$result = $this->conn->query($sql);
		if($row = $result->fetchArray(SQLITE3_ASSOC)){
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

		$sql = "SELECT var FROM `web2019_vars` WHERE name='".$varName."'";
		$result = $this->conn->query($sql);
		$value = 0;
		if($row = $result->fetchArray(SQLITE3_ASSOC)){
			if($row = $result->fetch_assoc()) $value = $row["var"];
		}else $value = -1;
		if($value != -1){
			$sql = "UPDATE `web2019_vars` SET var =".($value+1)." WHERE name='".$varName."'";
			$this->SQL_Query("UPDATE",$sql);
			return $lab.str_pad($value,$len,'0',STR_PAD_LEFT);
		}else return null;
	} 

	function getData($name,$id=null){
		switch ($name) {
			case 'users':
				if($id){
					$sql = "SELECT `uid`, `username`, `sex`, `phone`, `email`, `add_at`,`edit_at` FROM `web2019_users` WHERE `uid` = '".$id."' AND isActive = 1";
				}else{
					$sql = "SELECT `uid`, `username`, `sex`, `phone`, `email`, `add_at` FROM `web2019_users` WHERE `uid` <> 'A00000' AND isActive = 1";
				}
				break;
			case 'shops':
				if($id) $sql = "SELECT `sid`, `name`, `zone_id`, `phone_id`, `phone`, `address`,`start_at`,`end_at` FROM `web2019_shops` WHERE `sid`='".$id."' AND isActive = 1";
				else{
					$sql = "SELECT `sid`, `name`, `zone_id`, `phone_id`, `phone`, `address`,`start_at`,`end_at` FROM `web2019_shops` WHERE `sid` <> 'S0000' AND isActive = 1";
				}
				break;
			case 'products':
				if($id) $sql = "SELECT pid, name, type_id, path, price, discribe FROM `web2019_products` WHERE isActive = 1 AND `pid`='".$id."'";
				else{
					$sql = "SELECT `products`.pid, `products`.name,`product_type`.`name` AS type,`products`.name,`products`.path,`products`.price FROM `web2019_products` AS `products` JOIN `web2019_product_type` AS `product_type` ON `products`.`type_id` = `product_type`.`type_id` WHERE `products`.isActive = 1";
				}
				break;
			case 'orders':
				if($id) $sql = "SELECT `orders`.`order_id`,`orders`.`status`,`orders`.`person`,`orders`.`phone`,`orders`.`total`,`shops`.`name`,`orders`.`pick_time`,`orders`.`pick_at`,`orders`.`add_at`,`orders`.`finish_at` FROM `web2019_orders` AS `orders` JOIN `web2019_shops` AS `shops` ON `orders`.`shops` = `shops`.`sid` WHERE `orders`.`isActive`=1 AND `orders`.`order_id`='".$id."'";
				else{
					$sql = "SELECT `orders`.`order_id`,`orders`.`status`,`orders`.`person`,`orders`.`total`,`shops`.`name`,`orders`.`pick_time`,`orders`.`add_at`,`orders`.`finish_at` FROM `web2019_orders` AS `orders` JOIN `web2019_shops` AS `shops` ON `orders`.`shops` = `shops`.`sid` WHERE `orders`.`isActive`=1 AND `orders`.`status` < 3 ORDER BY `orders`.`add_at`";
				}
				break;
			case 'rec_orders':
				if($id) $sql = "SELECT `orders`.`order_id`,`orders`.`status`,`orders`.`person`,`orders`.`phone`,`orders`.`total`,`shops`.`name`,`orders`.`pick_time`,`orders`.`add_at`,`orders`.`finish_at` FROM `web2019_orders` AS `orders` JOIN `web2019_shops` AS `shops` ON `orders`.`shops` = `shops`.`sid` WHERE `orders`.`isActive`=1 AND `orders`.`order_id`='".$id."'";
				else{
					$sql = "SELECT `orders`.`order_id`,`orders`.`status`,`orders`.`person`,`orders`.`total`,`shops`.`name`,`orders`.`pick_time`,`orders`.`add_at`,`orders`.`finish_at` FROM `web2019_orders` AS `orders` JOIN `web2019_shops` AS `shops` ON `orders`.`shops` = `shops`.`sid` WHERE `orders`.`isActive`=1 AND `orders`.`status` >= 3 ORDER BY `orders`.`add_at`";
				}
				break;
			case 'user_orders':
				if($id) $sql = "SELECT `orders`.`order_id`,`orders`.`status`,`orders`.`person`,`orders`.`phone`,`orders`.`total`,`shops`.`name`,`orders`.`pick_time`,`orders`.`add_at`,`orders`.`finish_at` FROM `web2019_orders` AS `orders` JOIN `web2019_shops` AS `shops` ON `orders`.`shops` = `shops`.`sid` WHERE `orders`.`isActive`=1 AND `orders`.`order_id`='".$id."'";
				else{
					$sql = "SELECT `orders`.`order_id`,`orders`.`status`,`orders`.`person`,`orders`.`total`,`shops`.`name`,`orders`.`pick_time`,`orders`.`add_at`,`orders`.`finish_at` FROM `web2019_orders` AS `orders` JOIN `web2019_shops` AS `shops` ON `orders`.`shops` = `shops`.`sid` WHERE `orders`.`isActive`=1 AND `orders`.`users`='".$_SESSION['uid']."'";
				}
				break;
			case 'order_info':
				$sql = "SELECT `products`.`pid`,`products`.`name`, `order_info`.`unit`,`products`.`price` FROM `web2019_order_info` AS `order_info` JOIN `web2019_products` AS `products` ON `order_info`.`pid` = `products`.`pid` WHERE `order_info`.`order_id`='".$id."' AND `isActive`=1";
				break;
			case 'zones':
				$sql = "SELECT `zone_id`,`name` FROM `web2019_zone` WHERE 1";
				break;
			case 'pTypes':
				if($id) $sql = "SELECT `type_id`,`name` FROM `web2019_product_type` WHERE `isActive` = 1 AND `type_id` = '".$id."'";
				else $sql = "SELECT `type_id`,`name` FROM `web2019_product_type` WHERE `isActive` = 1";
				break;
			default:
				# code...
				break;
		}

		$result = $this->conn->query($sql);
		$value = array();
		if($result->fetchArray(SQLITE3_ASSOC)){
			while($row = $result->fetchArray(SQLITE3_ASSOC)){
				array_push($value,$row);
			}
		}else $value = -1;
		return $value;
	}
	function getRank($name,$type=null,$rank){
		switch ($name) {
			case 'products':
				if($type){
					$sql = "SELECT `name`, `price`,`path` FROM `web2019_products` WHERE `type_id` = '".$type."' AND isActive = 1 AND count <> 0 ORDER BY `count` DESC LIMIT 0,".$rank;
				}else{
					$sql = "SELECT `name`, `price`,`path`,`count` FROM `web2019_products` WHERE  isActive = 1 ORDER BY `count` DESC LIMIT 0,".$rank;
				}
				break;
			case 'shops':
				$sql = "SELECT `sid`, `name`, `phone_id`, `phone`, `address`,`start_at`,`end_at` FROM `web2019_shops` WHERE isActive = 1";
				break;
			default:
				# code...
				break;
		}

		$result = $this->conn->query($sql);
		$value = array();
		if($result->fetchArray(SQLITE3_ASSOC)){
			while($row = $result->fetchArray(SQLITE3_ASSOC)){
				array_push($value,$row);
			}
		}else $value = -1;
		return $value;
	}
	function updatePasswd($type,$id,$md5_pwd,$isRoot=FALSE){
		switch ($type) {
			case 'shops':
				$sql = 'UPDATE `web2019_shops` SET `password`="'.$md5_pwd.'" WHERE `sid`="'.$id.'"';
				break;
			case 'users':
				$sql = 'UPDATE `web2019_users` SET `password`="'.$md5_pwd.'" WHERE `uid`="'.$id.'"';
				break;
			default:
				# code...
				break;
		}
		if (!($this->conn->exec($sql) === TRUE)){
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
	function setOrderStatus($oid,$status){
		if($status == 2){
			$sql = "UPDATE `web2019_orders` SET `status`=".$status.",`finish_at`= CURRENT_TIMESTAMP() WHERE `order_id`='".$oid."' AND `isActive`=1";
		}else if($status == 3){
			$sql = "UPDATE `web2019_orders` SET `status`=".$status.",`pick_at`= CURRENT_TIMESTAMP() WHERE `order_id`='".$oid."' AND `isActive`=1";
		}else{
			$sql = "UPDATE `web2019_orders` SET `status`=".$status." WHERE `order_id`='".$oid."' AND `isActive`=1";
		}
		$this->SQL_Query("UPDATE",$sql);
		
	}
	function getSheetCount($sheet){
		switch ($sheet) {
			case 'users':
				$sql = 'SELECT count(`uid`)-1 AS "count" FROM `web2019_users` WHERE `isActive` = 1';
				break;
			case 'products':
				$sql = 'SELECT count(`pid`) AS "count" FROM `web2019_products` WHERE `isActive` = 1';
				break;
			case 'shops':
				$sql = 'SELECT count(`sid`)-1 AS "count" FROM `web2019_shops` WHERE `isActive` = 1';
				break;
			case 'orders':
				$sql = 'SELECT count(`order_id`) AS "count" FROM `web2019_orders` WHERE `isActive` = 1';
				break;
			default:
				# code...
				break;
		}

		$result = $this->conn->query($sql);
		if($row = $result->fetchArray(SQLITE3_ASSOC)){
			$count = $row['count'];
			if($count < 1000) return $count;
			else if(($count >= 1000)&&($count < 1000000)){
				if($count > 10000){
					return number_format(($count/1000),0)."k";
				}else return number_format(($count/1000),1)."k";
			}else{
				return number_format(($count/1000000),0)."w";
			}
		}else return -1;
	}
}
?>