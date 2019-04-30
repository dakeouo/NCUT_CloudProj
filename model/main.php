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
		echo "<script type='text/javascript'>";
		echo "window.location.href='".$GLOBALS['baseUrl'].$url."'";
		echo "</script>"; 
	}
	function myImg($name=null,$type=null){
		if($name == null){
			return $GLOBALS['baseUrl'].$GLOBALS['photoPath'].$GLOBALS['photoDef'][$type];
		}
		else return $GLOBALS['baseUrl'].$GLOBALS['photoPath'].$name;
	}
}
?>