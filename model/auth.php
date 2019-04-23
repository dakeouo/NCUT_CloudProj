<?php
include_once "mysql.php";
class Auth{
	public $mysql=null;
	public $main=null;
	function __construct(){
		$this->mysql = new Mysql();
		$this->main = $this->mysql->main;
		session_start();
	}
	function __destruct(){
		
	}
	function login($type,$account, $password){
		$user = $this->mysql->userCheck($type,$account,$password);
		if(!$user){
			$this->main->Alert("查無此帳戶");
			$this->main->goBack();
		}else if($user == -1){
			$this->main->Alert("您輸入的密碼錯誤");
			$this->main->goBack();
		}else{
			if($type == "users"){
				$_SESSION['uid'] = $user['id'];
				$_SESSION['username'] = $user['name'];
				$this->main->Alert("登入成功");
				$this->main->myUrl();
			}else if($type == "shops"){
				$_SESSION['shopId'] = $user['id'];
				$_SESSION['shopName'] = $user['name'];
				$this->main->Alert("登入成功");
				$this->main->myUrl("dashboard/");
			}
		}
	}
	function register($data){
		$uid = $this->mysql->getNumber("users");
		echo $uid;
		$sql = "INSERT INTO users (uid, username, password, sex, phone, email, add_at)VALUES ('".$uid."','".$data['username']."',
		'".$data['password']."','".$data['sex']."','".$data['phone']."',
		'".$data['email']."', CURRENT_TIME())";
		if($this->mysql->SQL_Query("INSERT",$sql)){
			$this->main->Alert("會員新增成功");
			$this->main->myUrl();
		}
	}
	function addShop($data){
		$sid = $this->mysql->getNumber("shops");
		$sql = "INSERT INTO shops (sid, name, password, zone_id, phone_id, phone, address, add_at)VALUES ('".$sid."','".$data['name']."',
		'".md5($sid,FALSE)."','".$data['zone_id']."','".$data['phone_id']."','".$data['phone']."',
		'".$data['address']."', CURRENT_TIME())";
		if($this->mysql->SQL_Query("INSERT",$sql)){
			$this->main->Alert("門市新增成功(編號：".$sid.")");
			$this->main->myUrl("dashboard/shops.php");
		}
	}
	function editShop($data){
		$sql = "UPDATE `shops` SET `name`='".$data['name']."',`zone_id`='".$data['zone_id']."',`phone_id`='".$data['phone_id']."',`phone`='".$data['phone']."',`address`='".$data['address']."' WHERE sid='".$data['sid']."'";
		if($this->mysql->SQL_Query("UPDATE",$sql)){
			$this->main->Alert("門市資料修改成功(編號：".$data['sid'].")");
			$this->main->myUrl("dashboard/shops.php");
		}
	}
	function deleteData($type,$id){
		if($type == "shops"){
			$sql = "UPDATE `shops` SET `isActive` = 0 WHERE `sid`='".$id."'";
		}else if($type == "users"){
			$sql = "UPDATE `users` SET `isActive` = 0 WHERE `uid`='".$id."'";
		}
		if($this->mysql->SQL_Query("UPDATE",$sql)){
			$this->main->Alert("資料刪除成功(編號：".$id.")");
			if($type == "shops") $this->main->myUrl("dashboard/shops.php");
			if($type == "users") $this->main->myUrl("dashboard/users.php");
		}
	}
}
?>