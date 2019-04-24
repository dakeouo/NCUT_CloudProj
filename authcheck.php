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
	case 'back-shop-add':
		$chName = $auth->mysql->ItemisExist("shops",$_POST['name']);
		if($chName){
			$auth->main->Alert("此門市名稱已存在(編號：".$chName.")");
			$auth->main->goBack();
			break;
		}
		$data = array(
			'name' => $_POST['name'],
			'zone_id' => $_POST['zone_id'],
			'phone_id' => $_POST['phone_id'],
			'phone' => $_POST['phone'],
			'address' => $_POST['address']
		);
		$auth->addShop($data);
		break;
	case 'back-shop-edit':
		$chName = $auth->mysql->ItemisExist("shops",$_POST['name']);
		if($chName && ($chName != $_POST['sid'])){
			$auth->main->Alert("此門市名稱已存在(編號：".$chName.")");
			$auth->main->goBack();
			break;
		}
		$data = array(
			'sid' => $_POST['sid'],
			'name' => $_POST['name'],
			'zone_id' => $_POST['zone_id'],
			'phone_id' => $_POST['phone_id'],
			'phone' => $_POST['phone'],
			'address' => $_POST['address']
		);
		$auth->editShop($data);
		break;
	case 'back-ptype-edit':
		$chName = $auth->mysql->ItemisExist("ptypes",$_POST['name']);
		if($chName && ($chName != $_POST['type_id'])){
			$auth->main->Alert("此類別名稱已存在(編號：".$chName.")");
			$auth->main->goBack();
			break;
		}
		$auth->editpType($_POST['type_id'],$_POST['name']);
		break;
	case 'back-ptype-add':
		$chName = $auth->mysql->ItemisExist("ptypes",$_POST['name']);
		if($chName && ($chName != $_POST['type_id'])){
			$auth->main->Alert("此類別名稱已存在(編號：".$chName.")");
			$auth->main->goBack();
			break;
		}
		$auth->addpType($_POST['name']);
		break;
	default:
		# code...
		break;
}
?>