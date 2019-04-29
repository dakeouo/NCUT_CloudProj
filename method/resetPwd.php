<?php
include_once "../model/auth.php";
$auth = new Auth();
$type = $_GET['type'];
$id = $_GET['id'];
if($type == "shops") $pwd = md5($id,FALSE);
else if($type == "users") $pwd = md5("0000",FALSE);
$auth->mysql->updatePasswd($type,$id,$pwd,TRUE);
?>