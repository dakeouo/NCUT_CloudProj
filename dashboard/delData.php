<?php
include_once "../model/auth.php";
$auth = new Auth();
$type = $_GET['type'];
$id = $_GET['id'];
$auth->deleteData($type,$id);
?>