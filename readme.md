網站瀏覽：[飲料店管理系統](https://cloud2019.terahake.in/)

![image](https://i.imgur.com/sMzTOxQ.jpg)
> 更多 [飲料店管理系統](https://imgur.com/a/g623FcJ) 圖片 

# 飲料店管理系統 (GCP Cloud Run 用)

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

## 資料表關聯圖
![image](https://i.imgur.com/57RgNim.png)
共使用8個資料表儲存資料，有5個比較主要的資料表：
- **會員資訊(users)**：紀錄顧客會員資訊，包含密碼、姓名、電話、信箱等。密碼以MD5編碼存於資料庫中。
  - 包含一筆「訪客」資訊供非會員資料的購物車、訂單資訊處理用。
- **店家資訊(shops)**：紀錄店家資訊，包含密碼、店家名稱、電話、地址等。其中，密碼以MD5編碼存於資料庫中。
- **商品資訊(products)**：紀錄商品項目資訊，包含商品名稱、商品類別ID、定價等。
  - **商品類別**由另一個資料表(product_type)儲存。
- **訂單資訊(orders)**：紀錄訂單資訊，包含會員ID、取貨分店ID、取貨人姓名等。
  - **訂單詳細資訊**由另一個資料表(order_info)儲存。
- **購物車資訊(carts)**：紀錄購物車資訊，包含會員ID、商品個數、總價格等。
  - **購物車詳細資訊**由另一個資料表(cart_info)儲存。


## Designer
- [Dake Hong](https://github.com/dakeouo)
