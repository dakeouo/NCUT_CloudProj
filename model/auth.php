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
}
?>