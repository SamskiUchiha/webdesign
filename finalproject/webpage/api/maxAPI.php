<?php
    include 'dbConnection.php';
    $dbConn = startConnection("fortnite");
    
    $sql ="SELECT MAX(price) FROM table_product";
        
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        
        foreach($records as $i) {
            echo $i['MAX(price)'];
        }
   
?>