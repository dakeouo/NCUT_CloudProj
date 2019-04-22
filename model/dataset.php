<?php
include_once "mysql.php";
class Dataset{
	public $mysql=null;
	public $main=null;
	function __construct(){
		$this->mysql = new Mysql();
		$this->main = $this->mysql->main;
	}
	function getShopData(){
		$result = $this->mysql->getData("shops");
		if($result == -1){
			echo '<tr><td colspan="6">目前無店家資料。</td></tr>';
		}else{
			foreach($result as $row) {
				echo '<tr>';
				echo '<td>'.$row['sid'].'</td>';
				echo '<td>'.$row['name'].'門市</td>';
				echo '<td>'.$row['zone'].'</td>';
				echo '<td>('.$row['phone_id'].')'.$row['phone'].'</td>';
				echo '<td>'.$row['address'].'</td>';
				echo '<td><a href="editshop.php?sid='.$row['sid'].'" id="total-btn" class="btn btn-primary">';
				echo '修改</a></td>';
				echo '</tr>';
			}
		}
	}
	function getShopSingleData($sid){
		$result = $this->mysql->getData("shops",$sid);
		if($result == -1){
			$this->main->Alert("查無該店家資料(編號：".$sid.")");
			$this->main->goBack();
		}else{
			return $result;
		}
	}
	function getZone($zone=null){
		$result = $this->mysql->getData("zones");
		echo '<select name="zone_id">';
		foreach($result as $row) {
			echo '<option value='.$row['zone_id'];
			if($zone == $row['zone_id']) echo " selected ";
			echo '>'.$row['name'].'</option>';
		}
		echo '</select>';
	}
}
?>