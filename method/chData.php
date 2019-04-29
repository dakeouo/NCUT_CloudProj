<?php
include_once "../model/auth.php";
$auth = new Auth();
$mode = $_POST['mode'];
switch ($mode) {
	case 'register':
		$chPasswd = '/^.*(?=.{8,15})(?=.*\d)(?=.*[a-zA-Z]).*$/';
		if(!preg_match($chPasswd,$_POST['password'])){
			$auth->main->Alert("密碼不符合規定(8-15位元，字母、數字各1)");
			$auth->main->goBack();
			break;
		}else if($auth->mysql->userCheck("users",$_POST['email'])){
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
	case 'user-edit':
		$chName = $auth->mysql->ItemisExist("users",$_POST['email']);
		if($chName && ($chName != $_POST['uid'])){
			$auth->main->Alert("帳號已存在");
			$auth->main->goBack();
			break;
		}
		$data = array(
			'uid' => $_POST['uid'],
			'username' => $_POST['username'],
			'sex' => $_POST['sex'],
			'phone' => $_POST['phone'],
			'email' => $_POST['email']
		);
		$auth->editUserData($data);
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
			'start_at' => $_POST['start_at'],
			'end_at' => $_POST['end_at'],
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
			'start_at' => $_POST['start_at'],
			'end_at' => $_POST['end_at'],
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
	case 'back-product-add':
		$chName = $auth->mysql->ItemisExist("products",$_POST['name']);
		if($chName){
			$auth->main->Alert("此商品名稱已存在(編號：".$chName.")");
			$auth->main->goBack();
			break;
		}
		$data = array(
			'name' => $_POST['name'],
			'type_id' => $_POST['type_id'],
			'price' => $_POST['price'],
			'discribe' => $_POST['discribe']
		);
		$auth->addProduct($data);
		break;
	case 'back-product-edit':
		$chName = $auth->mysql->ItemisExist("products",$_POST['name']);
		if($chName){
			$auth->main->Alert("此商品名稱已存在(編號：".$chName.")");
			$auth->main->goBack();
			break;
		}
		$data = array(
			'pid' => $_POST['pid'],
			'name' => $_POST['name'],
			'type_id' => $_POST['type_id'],
			'price' => $_POST['price'],
			'discribe' => $_POST['discribe']
		);
		$auth->editProduct($data);
		break;
	case 'passwd-change':
		$sid = $_POST['sid'];
		$type = $_POST['type'];
		$oldP = $_POST['old-passwd'];
		$newP = $_POST['new-passwd'];
		$chPasswd = '/^.*(?=.{8,15})(?=.*\d)(?=.*[a-zA-Z]).*$/';
		$user = $auth->mysql->userCheck($type,$sid,$oldP);
		if(!$user){
			$auth->main->Alert("查無此帳戶");
			$auth->main->goBack();
		}else if($user == -1){
			$auth->main->Alert("您輸入的密碼錯誤");
			$auth->main->goBack();
		}else{
			if($newP == $oldP){
				$auth->main->Alert("新密碼與舊密碼相同");
				$auth->main->goBack();
			}else if(!preg_match($chPasswd,$newP)){
				$auth->main->Alert("密碼不符合規定(8-15位元，字母、數字各1)");
				$auth->main->goBack();
			}else{
				$newP = md5($newP,FALSE);
				if($type == "users-uid") $type = "users";
				$auth->mysql->updatePasswd($type,$sid,$newP);
			}
		}
		break;
	default:
		# code...
		break;
}
?>