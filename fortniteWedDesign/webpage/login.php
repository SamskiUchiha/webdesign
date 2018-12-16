<?php
    session_start();
    
    include 'inc/dbConnection.php';
    $dbConn = startConnection("fortnite");
    
    function valid() {
        global $dbConn;
        
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
                         
        $sql = "SELECT * FROM om_admin
                         WHERE username = :username 
                         AND  password = :password ";                 
        $np = array();
        $np[':username'] = $username;
        $np[':password'] = $password;
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($np);
        $record = $stmt->fetch(PDO::FETCH_ASSOC); 
        
        if (empty($record)) {
            return false;
            
        } else {
           $_SESSION['adminFullName'] = $record['firstName'] .  "   "  . $record['lastName'];
           header('Location: admin.php'); //redirects to another program
            
        }
    }

?>

<!DOCTYPE HTML>
<html>
	<head>
	<title>login</title>
	
	<link rel="stylesheet" href="css/img.css">
	<link rel="shortcut icon" type="image/x-icon" href="//static.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
	<link rel="mask-icon" type="" href="//static.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
	
	<link rel="stylesheet" href="css/style.css">
	
	<script src="js/modernizr-2.6.2.min.js"></script>
    <script>
        function msg() {
            alert("Invalid password or username!");
        }
    </script>
    <style>
        body {
            /*background: linear-gradient(to right, #ccff99 22%, #00ccff 86%);*/
            background-color: lightgray;
            text-align: center;
            /*width: 100%;*/
        }
        
        p{
            color: #F3BA03;
            font-size: 0.67em;
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
					<li><a href="index.php">Home</a></li>
					<li class="colorlib-active"><a href="login.php">Sign in</a></li>
				</ul>
			</nav>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<div>
				<p><small>&copy;<script>document.write(new Date().getFullYear());</script> sLaitha CST336 Final Project | Academic purposes.
			</div>
		</aside>
		  <center><div id="login">
            <br>
            <h2> Welcome Admin </h2>
            <!--<a href="https://fontmeme.com/small-caps-fonts/"><img src="https://fontmeme.com/permalink/181111/402540f673630abdb7e0d7fd0c1ffc05.png" alt="small-caps-fonts" border="0"></a>-->
            <form method="post">
              <input type="text" id="username" name="username" placeholder="username"/> <br>
              <br>
              <input type="password" id="password" name="password" placeholder="password"/> <br>
              <br>
              <input type="submit" value="Login">
              <br>
              <br>
              <br>
              <?php
                if(valid() || isset($_POST['username']) || isset($_POST['password'])) {
                    echo "<script>msg();</script>";
                } else {
                    valid();
                }
              ?>
            </form>
        </div></center>
	</div>
	</body>
</html>