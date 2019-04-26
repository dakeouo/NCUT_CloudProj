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
	function getUserData(){
		$result = $this->mysql->getData("users");
		if($result == -1){
			echo '<tr><td colspan="6">目前無會員資料。</td></tr>';
		}else{
			foreach($result as $row) {
				if($row['sex'] == 0) $row['sex'] = '男';
				else if($row['sex'] == 1) $row['sex'] = '女';
				else if($row['sex'] == 2) $row['sex'] = '不願透漏';
				echo '<tr>';
				echo '<td>'.$row['uid'].'</td>';
				echo '<td>'.$row['username'].'</td>';
				echo '<td>'.$row['sex'].'</td>';
				echo '<td>'.$row['phone'].'</td>';
				echo '<td>'.$row['email'].'</td>';
				echo '<td>'.$row['add_at'].'</td>';
				echo '<td><a href="viewuser.php?uid='.$row['uid'].'" id="total-btn" class="btn btn-primary">';
				echo '詳細</a></td>';
				echo '</tr>';
			}
		}
	}
	function getProductData(){
		$result = $this->mysql->getData("products");
		if($result == -1){
			echo '<tr><td colspan="6">目前無商品資料。</td></tr>';
			return 0;
		}else{
			$coun = 0;
			foreach($result as $row) {
				echo '<tr>';
				echo '<td>'.$row['pid'].'</td>';
				echo '<td align="center"><div class="table-img"><div><img src="'.$this->main->myImg($row['path'],"products").'"></div></div></td>';
				echo '<td>'.$row['name'].'</td>';
				echo '<td>'.$row['type'].'類</td>';
				echo '<td style="color: red;">NT$'.$row['price'].'</td>';
				echo '<td><a href="editproduct.php?pid='.$row['pid'].'" id="total-btn" class="btn btn-primary">';
				echo '修改</a></td>';
				echo '</tr>';
				$coun++;
			}
			return $coun;
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
	function getProductSingleData($pid){
		$result = $this->mysql->getData("products",$pid);
		if($result == -1){
			$this->main->Alert("查無該店家資料(編號：".$pid.")");
			$this->main->goBack();
		}else{
			return $result;
		}
	}
	function getUserSingleData($uid){
		$result = $this->mysql->getData("users",$uid);
		if($result == -1){
			$this->main->Alert("查無該會員資料(編號：".$uid.")");
			$this->main->goBack();
		}else{
			if($result[0]['sex'] == 0) $result[0]['sex'] = '男';
			else if($result[0]['sex'] == 1) $result[0]['sex'] = '女';
			else if($result[0]['sex'] == 2) $result[0]['sex'] = '不願透漏';

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
	function getpType($type=null){
		$result = $this->mysql->getData("pTypes");
		echo '<select name="type_id">';
		foreach($result as $row) {
			echo '<option value='.$row['type_id'];
			if($type == $row['type_id']) echo " selected ";
			echo '>'.$row['name'].'</option>';
		}
		echo '</select>';
	}
	function getProductType($type_id=null){
		$result = $this->mysql->getData("pTypes",$type_id);
		if($result == -1){
			if($type_id){
				$this->main->Alert("查無該類別編號(編號：".$type_id.")");
				$this->main->goBack();
			}else echo '<tr><td colspan="4">目前無類別資料。</td></tr>';
		}else{
			if($type_id){
				$value = $result[0]['name']; return $value;
			}else{
				foreach($result as $row) {
					echo '<tr>';
					echo '<td>'.$row['type_id'].'</td>';
					echo '<td>'.$row['name'].'類</td>';
					echo '<td><a href="ptype.php?id='.$row['type_id'].'" id="total-btn" class="btn btn-primary">';
					echo '修改</a></td>';
					echo '<td><a href="delData.php?type=ptypes&id='.$row['type_id'].'" id="total-btn" class="btn btn-red">';
					echo '刪除</a></td>';
					echo '</tr>';
				}
			}
		}
	}
}
?>