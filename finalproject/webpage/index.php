<?php
//Project Index
    include 'inc/functions.php';
    include 'inc/dbConnection.php';
    $dbConn = startConnection("fortnite");

    function displayCategories() { 
        global $dbConn;
        
        $sql = "SELECT * FROM table_category ORDER BY catName";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($records as $record) {
            echo "<option value='".$record['catID']."'>" . $record['catName'] . "</option>";
        }
    }
    
    
    function filterProducts() {
        global $dbConn;
        global $items;
        
        $namedParameters = array();
        $product = $_GET['productName'];
        
        //This SQL works but it doesn't prevent SQL INJECTION (due to the single quotes)
        //$sql = "SELECT * FROM om_product
        //        WHERE productName LIKE '%$product%'";
      
        $sql = "SELECT * FROM table_product WHERE 1"; //Gettting all records from database
        
        if (!empty($product)){
            //This SQL prevents SQL INJECTION by using a named parameter
             $sql .=  " AND productName LIKE :product OR productDescription LIKE :product";
             $namedParameters[':product'] = "%$product%";
        }
        
        if (!empty($_GET['category'])){
            //This SQL prevents SQL INJECTION by using a named parameter
             $sql .=  " AND catID =  :category";
              $namedParameters[':category'] = $_GET['category'] ;
        }
        
        if(!empty($_GET['priceFrom'])) {
            $sql .= " AND price >= :priceFrom";
            $namedParameters["priceFrom"] = $_GET['priceFrom'];
        }
        
        if(!empty($_GET['priceTo'])) {
            $sql .= " AND price <= :priceTo";
            $namedParameters["priceTo"] = $_GET['priceTo'];
        }
        
        //echo $sql;
        
        if (isset($_GET['orderBy'])) {
            
            if ($_GET['orderBy'] == "productPrice") {
                
                $sql .= " ORDER BY price";
            } else {
                
                  $sql .= " ORDER BY productName";
            }
        }
        if (isset($_GET['order'])) {
             if ($_GET['order'] == "productPrice") {
                
                $sql .= " ORDER BY price DESC";
            }
        }
    
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($namedParameters);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);  
        
        if(isset($records)) {  
            // echo "<table class='table'>";
            echo "<div id='fh5co-main'>";
            echo"<div class='fh5co-gallery'>";
            foreach ($records as $record) {
                $productID = $record['productID'];
                $productName = $record['productName'];
                $productPrice = $record['price'];
                $productImage = $record['productImg'];
                $productDes = $record['productDescription'];
        		echo"<a class='gallery-item' href='index.php'>";
        			echo"<img src=".$record['productImage']." title=".$record['productName']." width='80%' height='80%' />";
        				echo"<span class='overlay'>";
        					echo"<h2>".$productName."</h2>";
        					echo "<span>".$productDes. "</span>";
        					echo"<span>".$productPrice. " V-Bucks" . "</span>";
        				echo"</span>";
        			echo"</a>";
                // echo "<tr class='d'>";

                // echo "<td class='vl' ><img src=".$record['productImage']." title=".$record['productName']." width='200' height='200' /><td>";
                // echo "<td class='v' ><hr><h2>" . $productName . "</h2><hr></td>";
                // echo "<td class='v' ><hr><h2>[<a onclick='openModal()' target='productModal' href='productInfo.php?productID=".$record['productID']."'>". "More Info" ."</a>]</h2><hr></td>";
                // echo "<td class='v' ><hr><h2>" . " " . $productPrice . " V-Bucks" . "</h2><hr></td>";

                
                // echo "<form method='post'>";
                // echo "<input type='hidden' name='productName' value='$productName'>";
                // echo "<input type='hidden' name='productPrice' value='$productPrice'>";
                // echo "<input type='hidden' name='productImage' value='$productImage'>";
                // echo "<input type='hidden' name='productID' value='$productID'>";
                // echo "<input type='hidden' name='productDescription' value='$productDes'>";
                

                // echo '</tr>';
                // echo '</form>';
                
            }
            echo"</div>";
            echo"</div>";
            echo "<br>";
            // echo "</table>";
        }
    }
?>

<!DOCTYPE HTML>
<html>
	<head>
	<title>Home</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/index.css">

	<link rel="stylesheet" href="css/img.css">
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<script src='//static.codepen.io/assets/editor/live/console_runner-1df7d3399bdc1f40995a35209755dcfd8c7547da127f6469fd81e5fba982f6af.js'></script>
	<script src='//static.codepen.io/assets/editor/live/css_reload-5619dc0905a68b2e6298901de54f73cefe4e079f65a75406858d92924b4938bf.js'></script>
	<!--<meta charset='UTF-8'><meta name="robots" content="noindex">-->
	<link rel="shortcut icon" type="image/x-icon" href="//static.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
	<link rel="mask-icon" type="" href="//static.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
	<link rel="canonical" href="https://codepen.io/ariona/pen/KrRogZ" />
	
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css'>

	
	<script src="js/modernizr-2.6.2.min.js"></script>
	
    <style>
       h1 {
          font-family: "Quicksand", times, sans-serif;
       }

    </style>
	</head>
	<body>
	<div id="colorlib-page">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
		<aside id="colorlib-aside" role="complementary" class="border js-fullheight">
			<h1 id="colorlib-logo"><a href="index.php">Fortnite Items</a></h1>
			<nav id="colorlib-main-menu" role="navigation">
				<ul>
					<li class="colorlib-active"><a href="index.php">Home</a></li>
					<!--<li><a href="login.php">Admin Sign in</a></li>-->
					<li><a href="login.php">Sign in</a></li>
					<br>
					<br>
					<form id="f">
					<li> 
					    <!--<b>Product:</b>-->
					    <input type="text" name="productName" placeholder="Product keyword" /> </br></br> 
					</li>
					
					<li>  
					<!--<b>Category:</b> -->
                        <select name="category">
                            <option value=""> Select one </option>
                            <?=displayCategories()?>
                        </select>
                    </br></br>
                    </li>
                    
					<li> 
                        Name <input type="radio" name="orderBy" value="productName">
                    <li>
                        Low to High <input type="radio" name="orderBy" value="productPrice">
                    </li>
                    
                    <li>
                        High to Low <input type="radio" name="order" value="productPrice">
                    </li>
                    
					</li>
					<li> <input type="submit" name="submit" value="Search!"/> </li>
					</form>
				</ul>
			</nav>
			<br><br><br><br><br><br><br>
			<div>
				<p><small>&copy;<script>document.write(new Date().getFullYear());</script> sLaitha CST336 Final Project | Academic purposes.</small></p>
			</div>
		</aside>
		
		<!------------------carousel--------------------------------->
	    <div class="section section-project">
          <div class="project-carousel">
            <div class="project-strip">
              <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-astronauts.jpg" alt="" width="700" height="360"/></div>
              <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-season7-004.jpg" alt="" width="700" height="360"/></div>
              <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-wild-west.jpg" alt="" width="700" height="360"/></div>
              <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-valkyrie.jpg" alt="" width="700" height="360" /></div>
              <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-fortnite-birthday.jpg" alt="" width="700" height="360"/></div>
              <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-oblivion-criterion.jpg" alt="" width="700" height="360"/></div>
              <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-viking-village.jpg" alt="" width="700" height="360"/></div>
              <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/08/fortnite-1920x1080-wallpaper-wild-card.jpg" alt="" width="700" height="360"/></div>
              <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-detectives.jpg" alt="" width="700" height="360"/></div>
            </div>
            <div class="project-screen">
              <div class="project-detail">
                <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-astronauts.jpg" alt="" width="700" height="360"/></div>
                <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-season7-004.jpg" alt="" width="700" height="360"/></div>
                <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-wild-west.jpg" alt="" width="700" height="360"/></div>
                <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-valkyrie.jpg" alt="" width="700" height="360"/></div>
                <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-fortnite-birthday.jpg" alt="" width="700" height="360"/></div>
                <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-oblivion-criterion.jpg" alt="" width="700" height="360"/></div>
                <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-viking-village.jpg" alt="" width="700" height="360"/></div>
                <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/08/fortnite-1920x1080-wallpaper-wild-card.jpg" alt="" width="700" height="360"/></div>
                <div class="project"><img src="https://progameguides.com/wp-content/uploads/2018/05/fortnite-1920x1080-wallpaper-detectives.jpg" alt="" width="700" height="360"/></div>
              </div>
              <div class="screen-frame"></div>
            </div>
          </div>
        </div>
        
		<!------------------end carousel--------------------------------->
		<center><div id="dv">
            </br></br>
            </br></br>
            <hr>
            <?php
                if($_GET['submit'] == "Search!") {
                    //echo "<h2> Results: </h2>";
                    //echo "<span id='d2'";
                        filterProducts();
                    //echo "</span";
                }
            ?>
        </div>
		
	</div>
	
	<script src='//static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js'></script><script src='https://code.jquery.com/jquery-2.2.4.min.js'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js'></script>
    <script >$(".project-detail").slick({
    	slidesToShow: 1,
    	arrows: false,
    	asNavFor: '.project-strip',
    	autoplay: true,
    	autoplaySpeed: 3000 });
    
    
    $(".project-strip").slick({
    	slidesToShow: 5,
    	slidesToScroll: 1,
    	arrows: false,
    	asNavFor: '.project-detail',
    	dots: false,
    	infinite: true,
    	centerMode: true,
    	focusOnSelect: true });
    //# sourceURL=pen.js
    </script>
	</body>
</html>

