<?php
include "config.php";
class Main{
	function __construct(){
	}
	function Alert($msg){
		echo "<script type='text/javascript'>alert('".$msg."');</script>";
	}
	function goBack(){
		echo "<script>history.go(-1)</script>";
	}
	function myUrl($url=null){
		// $front = "http://192.168.0.164/cloudfinal/";
		echo "<script type='text/javascript'>";
		echo "window.location.href='".$GLOBALS['baseUrl'].$url."'";
		echo "</script>"; 
	}
}
?>