<?php
include_once "../model/main.php";
$main = new Main();
session_start();
if(!isset($_SESSION['shopId'])){
	$main->myUrl("dashboard/login.php");
}
?>