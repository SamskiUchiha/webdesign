<?php
session_start();

include 'inc/dbConnection.php';
$dbConn = startConnection("fortnite");

include 'inc/functions.php';
validateSession();

    function getCount() {
        global $dbConn;
        
        $sql ="SELECT COUNT(*) FROM table_product";
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        
        foreach($records as $i) {
            echo $i['COUNT(*)'];
        }
        
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title> View Products </title>
        <style>
      
        </style>
        <link rel="shortcut icon" type="image/x-icon" href="//static.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
	    <link rel="mask-icon" type="" href="//static.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
        
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/buttons.css">
        <script src="js/modernizr-2.6.2.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" type="text/css" />
        
        <script>
            function confirmDelete() {
                return confirm("Remove this item from Database?");
            }
            
            
	        
            function AjaxCount() {
	            $.ajax({
                    type: "GET",
                    url: "api/countAPI.php",
                    success: function(msg) {
                        // $("#result").html(msg + " records");
                        alert( "Total Records:" + msg );
                        //return message("Total: " + msg );
                       
                    },
	            }); 
            }
            
            function AjaxAvg() {
	            $.ajax({
                    type: "GET",
                    url: "api/avgAPI.php",
                    success: function(msg) {
                        // $("#result").html(msg + " records");
                        alert( "Average Price:" + msg + " V-Bucks");
                        //return message("Total: " + msg );
                       
                    },
	            }); 
            }
            
            function AjaxMax() {
	            $.ajax({
                    type: "GET",
                    url: "api/maxAPI.php",
                    success: function(msg) {
                        // $("#result").html(msg + " records");
                        alert( "Max Price:" + msg + " V-Bucks");
                        //return message("Total: " + msg );
                       
                    },
	            }); 
            }
            
	        $(document).ready(AjaxCount);
            $(document).ready(AjaxAvg);
            $(document).ready(AjaxMax);
        </script>
        
        
        <style>
            #div2 {
                text-align: center;
             
            }
            hr {
                height: 5px;
            }
      
        </style>
    
    </head>
    <body>
        <div id="colorlib-page">
    		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
        		<aside id="colorlib-aside" role="complementary" class="border js-fullheight">
        			<h3 id="colorlib-logo-admin"><a href="admin.php">Welcome <?= $_SESSION['adminFullName'] ?> </a></h3>
        			<nav id="colorlib-main-menu" role="navigation">
        				<ul>
        					<li class="colorlib-active"><a href="index.php"></a></li>
        					<!--<li><a href="login.php">Admin Sign in</a></li>-->
        					<li><a href="login.php"></a></li>
        	                

                            <center>
                                
                            <li>
                                <button onclick="window.location='addProduct.php'" class="button"><span>Add Product </span></button>
        	                </li>
        	                
                            <li>
                                <button onclick="AjaxCount();" class="button"><span>Total Records </span></button>
                            </li>
                            
                            <li>
                                <button onclick="AjaxAvg();" class="button"><span>Average Price </span></button>
                            </li>
                            
                            <li>
                                <button onclick="AjaxMax();" class="button"><span>Max Price </span></button>
                            </li>
                        
                            <li>
        	                    <form action="logout.php">
                                <input class="button" type="submit" value="Logout">
                                </form>
        	                </li>
                            
                            <li>
                                <form action="admin.php">
                                <input class="button" type="submit" value="back">
                                </form>
                            </li>
                            
                            </center>
        				</ul>
        
        			</nav>
        		</aside>
            
        	<div id="div2">
                <br><br>
                <hr>
                <?= displayAllProducts() ?>
        		    
    		</div>
       </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        
    </body>
</html>