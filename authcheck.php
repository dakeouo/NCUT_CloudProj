<?php
include_once "model/auth.php";
$auth = new Auth();
$mode = $_POST['mode'];
switch ($mode) {
	case 'register':
		$chPasswd = '/^.*(?=.{8,15})(?=.*\d)(?=.*[a-zA-Z]).*$/';
		if(!preg_match($chPasswd,$_POST['password'])){
			$auth->main->Alert("密碼不符合規定(8-15位元，字母、數字各1)");
			$auth->main->goBack();
			break;
		}else if($auth->mysql->userCheck($_POST['email'])){
			$auth->main->Alert("帳號已存在");
			$auth->main->goBack();
			break;
		}
		$data = array(
			'username' => $_POST['username'],
			'password' => md5($_POST['password'],FALSE),
			'sex' => $_POST['sex'],
			'phone' => $_POST['phone'],
			'email' => $_POST['email']
		);
		$auth->register($data);
		break;
	case 'login':
		$auth->login("users",$_POST['email'],$_POST['password']);
		break;
	case 'back-login':
		$auth->login("shops",$_POST['shopId'],$_POST['password']);
		break;
	default:
		# code...
		break;
}
?>