網站瀏覽：[飲料店管理系統](https://dake.work/webproj2019/)

![image](https://i.imgur.com/sMzTOxQ.jpg)
> 更多 [飲料店管理系統](https://imgur.com/a/g623FcJ) 圖片 

# 飲料店管理系統

一套簡易型的飲料店訂購管理平台

## 網站功能

#### 顧客端
- 可註冊/登入會員
- 可以隨時下訂飲料(不管有無登入會員)
- 選購的飲料，會先進購物車，再填寫訂單資訊
- 顧客可決定取貨地點及預計取貨時間
- 訂單送出後，不得進行修改
- 會員可以查詢歷史訂單資訊

#### 店家端
- 總店可新增門市分店帳號
- 查看店家資訊、修改資訊及修改密碼
- 新增、瀏覽、修改、刪除門市資訊(總店帳號限定)
- 新增、瀏覽、修改、刪除商品資訊(含商品類別)
- 新增、瀏覽、修改、刪除會員資訊
- 標示訂單狀態及刪除訂單
- 重置分店及會員密碼


## 網站安裝
1. 還原/下載專案
2. 匯入資料庫資料(/ncut_sql.sql)
3. 開啟事件排程變數`set global event_scheduler = ON;`
3. 複製事件排程資料(/ncut_event.sql)
4. 建立/model/config.php並填入以下資訊
```php
$GLOBALS['baseUrl'] = "YOUR HOSTNAME";
$GLOBALS['photoPath'] = "YOUR IMAGE PATH";
$GLOBALS['photoDef'] = array(
	'products' => 'YOUR IMAGE NAME',
	'shops' => 'YOUR IMAGE NAME',
	'users' => 'YOUR IMAGE NAME',
	'header' => 'YOUR IMAGE NAME',
	'sub-header' => 'YOUR IMAGE NAME'
);
$GLOBALS['DB_hostname'] = "YOUR SQLSERVER";
$GLOBALS['DB_username'] = "YOUR USERNAME";
$GLOBALS['DB_password'] = "YOUR PASSWORD";
$GLOBALS['DB_dbname'] = "YOUR DBNAME";
```

## 預設帳戶
### 店家端
> **總店帳號** 帳號:_S0000_  密碼:_S0000_
- 帳號為**店家編號(Sxxxx)**，密碼預設也是**店家編號(Sxxxx)**
- 店家密碼重置後，改為**店家編號(Sxxxx)**

### 顧客端
- 顧客密碼重置後，改為**0000**

## 相關套件
- [Font Awesome](https://fontawesome.com/)
- [chart.js](https://www.chartjs.org/)

## Designer
- [Dake Hong](https://github.com/dakeouo)
