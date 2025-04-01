<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>    
<head>
<meta charset="utf-8" />
<title>update.php</title>
<?php
//session_start();  // 啟用交談期
// 檢查是否是表單送回
if ( isset($_POST["Item"]) ) {
   // 取得購買的數量
   $_SESSION["Quantity"] = $_POST["Quantity"];
   $id = $_POST["Item"];  // 取得選擇商品
   $_SESSION["ID"] = $id; // 建立Session變數
   switch (strtoupper($id)) {
      case "S001":
         $_SESSION["Name"] = "10吋平板電腦";
         $_SESSION["Price"] = 12000;
         break;
      case "S002":
         $_SESSION["Name"] = "15.6吋筆記型電腦";
         $_SESSION["Price"] = 27000;
         break;
      case "S003":
         $_SESSION["Name"] = "iPhone智慧型手機";
         $_SESSION["Price"] = 21000;
         break;   
   }  
   header("Location: savecart_update.php");  // 轉址
}
?>
</head>
<body bgcolor="#FFCC77" text="blue">
<form action="update.php" method="post" style="display: inline-block; margin-right: 2px;">
選擇商品: 
<select name="Item">
    <?php
        $id = $_GET["Id"];
        $quantity= $_GET["Quantity"];
        switch (strtoupper($id)) {
            case "S001":
               echo "<option value=\"S001\">10吋平板電腦 - $12000</option>";
               break;
            case "S002":
                echo "<option value=\"S002\">15.6吋筆記型電腦 - $27000</option>";
               break;
            case "S003":
                echo "<option value=\"S003\">iPhone智慧型手機 - $21000</option>";
               break;   
         }
         echo "<input style=\"width: 5em\" type=\"number\" size=\"5\" name=\"Quantity\" value=".$quantity.">";
    ?>

</select>
<input type="submit" value="更新"/>
</form>
<form action="shoppingcart.php" style="display: inline-block;">
    <input type="submit" value="取消">
</form>

<hr/>| <a href="catalog.php">商品目錄</a>
| <a href="shoppingcart.php">檢視購物車</a> |
</body>
</html>