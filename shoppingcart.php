<?php
ob_start();
?>
<!DOCTYPE html>
<html>  
<head>
<meta charset="utf-8" />
<title>shoppingcart.php</title>
<?php
function each(&$array) {
   $res = array();
   $key = key($array);
   if($key !== null){
       next($array); 
       $res[1] = $res['value'] = $array[$key];
       $res[0] = $res['key'] = $key;
   }else{
       $res = false;
   }
   return $res;
}
?>
<script>
   function Delete(value) {
      var isConfirmed = confirm("確認刪除?");
      if (isConfirmed) {
         window.location.href = 'delete.php?Id=' + encodeURIComponent(value);   
      } 
   }
</script>
</head>
<body bgcolor="#FFCC77" text="blue">
<table border="0">
  <tr bgcolor="#CC99FF">
   <td>功能</td><td>編號</td><td>名稱</td>
   <td>價格</td><td>數量</td></tr>
<?php
$flag = false;  $total = 0;
//print_r($_COOKIE);
// 取出所有陣列Cookie
while ( list($arr, $value) = each($_COOKIE) ) {
  // 檢查COOKIE名稱是否存在，且為陣列
  if ( isset($_COOKIE[$arr]) && 
                   is_array($_COOKIE[$arr]) ) {
     if ($flag) {   // 切換顯示色彩
        $flag = false;
        $color="#FF99CC";
     } else {
        $flag = true;
        $color="#99FFC";
     }
     echo "<tr bgcolor='".$color."'><td>";
     echo "<a href='#' onclick='Delete(\"$arr\")'>";
     echo "刪除</a>"."  ";
     //echo $arr;
     echo "<a href='update.php?Id=".$arr."&Quantity=".$_COOKIE[$arr]["Quantity"]."'>";
     echo "更新</a></td>";
     $price = 0;
     $quantity = 0; // 顯示選購的商品資料
     while ( list($name, $value)=each($_COOKIE[$arr])) {
        // 使用表格顯示
        echo "<td>" . $value . "</td>";
        if ($name == "Price")  $price = $value;
        if ($name == "Quantity") $quantity = $value;
     }
     $total += $price * $quantity;  // 計算總金額
     echo "</tr>";
  }
}
if ($total != 0) {  // 顯示總金額
   echo "<tr bgcolor=yellow><td colspan=5 align=right>";
   echo "總金額 = NT$".$total."元</td></tr>";
}
?>
</table>
<hr/> | <a href="catalog.php">商品目錄</a>
| <a href="shoppingcart.php">檢視購物車</a> |
</body>
</html>