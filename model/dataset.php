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
				echo '<td>('.$row['phone_id'].')'.$row['phone'].'</td>';
				echo '<td>'.$row['start_at'].' - '.$row['end_at'].'</td>';
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
	function getTimeOption($name,$value=null){
		echo '<select name="'.$name.'">';
		for ($i=0;$i<24;$i++) { 
			for($j=0;$j<60;$j+=10) {
				$time = str_pad($i,2,'0',STR_PAD_LEFT).':'.str_pad($j,2,'0',STR_PAD_LEFT);
				echo '<option value="'.$time.'" ';
				if($value == $time) echo "selected";
				echo ' >'.$time.'</option>';
			}
		}
		echo '</select>';
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
	function getShop($sid=null){
		$result = $this->mysql->getData("shops");
		echo '<select name="shop_id" style="width: 8em;">';
		foreach($result as $row) {
			echo '<option value='.$row['sid'];
			if($sid == $row['sid']) echo " selected ";
			echo '>'.$row['name'].'</option>';
		}
		echo '</select>';
	}
	function getIntervalTime(){
		echo '<select name="val_Time" style="width: 10em;">';
		for($i=0;$i<24;$i++){
			$start = str_pad($i,2,'0',STR_PAD_LEFT).':00';
			$end = str_pad(($i+1),2,'0',STR_PAD_LEFT).':00';
			echo '<option value="'.$start.'&nbsp;-&nbsp;'.$end.'">';
			echo $start.'-'.$end.'</option>';
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
	function getTypeRank($rank){
		$PT = $this->mysql->getData("pTypes");
		$coun = 0;
		if($PT == -1){
			echo '<tr><td colspan="4">目前無任何飲料類別。</td></tr>';
			$coun++;
		}else{
			foreach($PT as $row){ 
				$result = $this->mysql->getRank("products",$row['type_id'],$rank);
				if($result == -1){
					echo '<tr><td colspan="4">目前無 <b>'.$row['name'].'類 </b>飲品排名。</td></tr>';
					$coun++;
				}else{
					for ($i=0;$i<$rank;$i++){
						echo '<tr>';
						if($i==0) echo '<td rowspan="'.$rank.'">'.$row['name'].'</td>';
						echo '<td';
						if($i<3) echo ' style="color: red;"';
						echo '>第'.($i+1).'名</td>';
						if(isset($result[$i])){
							echo '<td>'.$result[$i]['name'].'</td>';
							echo '<td>'.$result[$i]['price'].'</td>';
						}else{
							echo '<td>-----</td>';
							echo '<td>---</td>';
						}
						echo '</tr>';
						$coun++;
					}
				}
			}	
		}
		return $coun;
	}
	function getRank(){
		$result = $this->mysql->getRank("products",null,5);
		if($result == -1){
				echo '<div ';
				echo 'style="position:relative; top:2em; font-size:2em;"';
				echo '>';
				echo '目前無任何熱門飲品';
				echo '</div>';
		}else{
			echo '<ul>';
			for ($i=0;$i<5;$i++) { 
				echo '<li>';
				if(isset($result[$i])){
					echo '<div class="img" style="background:none;"><div>';
					echo '<img src="'.$this->main->myImg($result[$i]['path'],"products").'">';
					echo '</div></div>';
					echo '<label class="sub-title">'.$result[$i]['name'].'</label><br />';
					echo '<label class="sub-price">NT$'.$result[$i]['price'].'</label>';
				}else{
					echo '<div class="img"></div>';
					echo '<label class="sub-title">-----</label><br />';
					echo '<label class="sub-price">NT$---</label>';
				}
				echo '</li>';
			}
			echo '</ul>';
		}
	}
	function getProductItem(){
		$result = $this->mysql->getData("products");
		$coun = 0;
		if($result == -1){
				echo '<div ';
				echo 'style="position:relative; top:2em; font-size:2em;"';
				echo '>';
				echo '目前無任何飲品資訊';
				echo '</div>';
			$coun = 1;
		}else{
			echo '<ul>';
			foreach($result as $row) { 
				echo '<li>';
				echo '<div class="img" style="background:none;"><div>';
				echo '<img src="'.$this->main->myImg($row['path'],"products").'">';
				echo '</div></div>';
				echo '<label class="sub-type">'.$row['type'].'類</label><br />';
				echo '<label class="sub-title">'.$row['name'].'</label><br />';
				echo '<label class="sub-price">NT$'.$row['price'].'</label>';

				echo '<div class="btn-block">';
				echo '<a href="chCart.php?method=add&pid='.$row['pid'].'" class="btn btn-primary">加入購物車</a>';
				echo '</div>';
				echo '</li>';
				$coun++;
			}
			echo '</ul>';
		}
		return $coun;
	}
	function getShopItem(){
		$result = $this->mysql->getRank("shops",null,-1);
		$coun = 0;
		if($result == -1){
				echo '<div ';
				echo 'style="position:relative; top:2em; font-size:2em;"';
				echo '>';
				echo '目前無任何據點資訊';
				echo '</div>';
			$coun = 1;
		}else{
			echo '<ul>';
			foreach($result as $row) { 
				echo '<li>';
				echo '<table><tr>';
				echo '<td width="30%"><div class="img" style="background:none;"><div>';
				echo '<img src="'.$this->main->myImg(null,"shops").'">';
				echo '</div></div></td>';
				echo '<td width="70%" style="position:relative; left:1em;">';
				echo '<label>'.$row['name'].'門市</label><br />';
				echo '電話：('.$row['phone_id'].')'.$row['phone'].'<br />';
				echo '地址：'.$row['address'].'<br />';
				echo '營業時間：'.$row['start_at'].' - '.$row['end_at'].'<br />';
				echo '</td>';
				echo '</tr></table>';
				echo '</li>';
				$coun++;
			}
			echo '</ul>';
		}
		return $coun;
	}
	function getCart($token){
		$result = $this->mysql->getCartItem($token);
		$coun = 0;
		if($result == -1){
			echo '<tr><td colspan="6">目前購物車無項目。</td></tr>';
			$coun++;
		}else{
			foreach($result as $row) { 
				echo '<tr>';
				echo '<td>'.$row['pid'].'</td>';
				echo '<td>'.$row['name'].'</td>';
				echo '<td style="color:red;">NT$';
				echo '<font id="price['.$coun.']">'.$row['price'].'</font></td>';
				echo '<td>';
				echo '<input type="hidden" name="itemId['.$coun.']" value="'.$row['pid'].'">';
				echo '<select name="unit['.$coun.']" id="unit['.$coun.']" onChange="sub_total('.$coun.')">';
				for($j=0;$j<10;$j++){ 
					echo '<option value="'.($j+1).'">'.($j+1).'</option>';
				}
				echo '</select>';
				echo '</td>';
				echo '<td style="color:red; font-weight:600;">NT$';
				echo '<font id="sub-total['.$coun.']"></font></td>';
				echo '<td>';
				echo '<a href="chCart.php?method=remove&pid='.$row['pid'].'" class="btn btn-red">刪除</a>';
				echo '</td>';
				echo '</tr>';
				$coun++;
			}
		}
		for($i=0;$i<5;$i++){ 
			
		}
		return $coun;
	}
}
?>