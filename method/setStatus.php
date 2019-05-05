<?php
include_once "../model/mysql.php";
$mysql = new Mysql();
$status = $_GET['status'];
$order_id = $_GET['id'];
$mysql->setOrderStatus($order_id,$status);
if($status == 3){
	$mysql->main->Alert("已取貨完成，將轉為歷史訂單");
	$mysql->main->myUrl("dashboard/orders.php");
}else $mysql->main->goBack();
?>