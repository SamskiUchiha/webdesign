<?php
// include 'dbConnection.php';
// $dbConn = startConnection("fortnite");

// $sql ="SELECT * FROM table_product WHERE productId = ".$_GET['productId'];
// $stmt = $dbConn->prepare($sql);
// $stmt->execute();
// $record = $stmt->fetch(PDO::FETCH_ASSOC); //we're expecting just one record

// //print_r($record);
// echo json_encode($record);

    include 'dbConnection.php';
    $dbConn = startConnection("fortnite");
    
    $sql ="SELECT COUNT(*) FROM table_product";
        
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        
        foreach($records as $i) {
            echo  $i['COUNT(*)'];
        }
   
?>