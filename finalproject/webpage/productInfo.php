<?php
session_start();

include 'inc/dbConnection.php';
$dbConn = startConnection("fortnite");
include 'inc/functions.php';
validateSession();

if (isset($_GET['productId'])) {

  $productInfo = getProductInfo($_GET['productId']);    
  //print_r($productInfo);
    
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title> Product Image </title>
    </head>
    <link rel='stylesheet' href='css/styles.css' type='text/css' />
    <body>
    
    <center><img src='<?=$productInfo['productImage']?>' height='50%' width='50%'/></center>
 
    </body>
</html>