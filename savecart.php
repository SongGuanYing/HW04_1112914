<?php
session_start();
ob_start();
?>
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

//session_start();  // 啟用交談期
if ( isset($_SESSION["ID"]) ) {
   $id = $_SESSION["ID"]; // 取得Session變數
   $name = $_SESSION["Name"];
   $price = $_SESSION["Price"];
   $quantity = $_SESSION["Quantity"];
   $falg=0; 
   while ( list($arr, $value) = each($_COOKIE) ) {
      if ( isset($_COOKIE[$arr]) && 
                       is_array($_COOKIE[$arr]) ) {
         if($_COOKIE[$arr]["ID"]==$id){
            $original_quantity=$_COOKIE[$arr]["Quantity"];
            //setcookie($id, "", time()-3600); 
         
            if($quantity!=0){
               setcookie($id."[ID]", $id, time()+3600);
               setcookie($id."[Name]", $name, time()+3600);
               setcookie($id."[Price]", $price, time()+3600);
               setcookie($id."[Quantity]", $original_quantity+$quantity, time()+3600); 
               $flag=1;       
           }  
         }         
      }
    } 
   if($flag==0){
      if($quantity!=0){
         setcookie($id."[ID]", $id, time()+3600);
         setcookie($id."[Name]", $name, time()+3600);
         setcookie($id."[Price]", $price, time()+3600);
         setcookie($id."[Quantity]", $quantity, time()+3600); 
         $flag=1;       
     } 
   }
   
}
header("Location: shoppingcart.php");  // 轉址
?>