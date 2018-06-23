<?php
	session_start();		
	if ($_SESSION[ 'username' ]!=''){
		$loggedin= "1";
	}else{
		$loggedin= "0";
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>DzikStore</title>
    <link rel="stylesheet" href="DzikStyle.css" type="text/css" />
  </head>
  <body>
  <div class="bg">
    <div class="container">
      <div class="header">       
		<ul>
      <li class="top"><a class="nav" href="reset.php">Reset DBase</a></li>
      <li class="top"><a class="nav" class="top" href="index.php">Home</a></li>
     <?php
	  if($loggedin == "0"){
			echo"<li class=\"top\"><a class=\"nav\" href=\"login.php\">Login</a></li>";
		}
	    if($loggedin == "1"){
			echo"<li class=\"top\"><a class=\"nav\" href=\"login.php\">Logout</a></li>";
		}
		
	  ?>
        </ul>
		<h1>Welcome to DzikStore</h1>
		
		<form  action="searchHome.php" method="GET">
		<input type="text" name="searchbox" value=""/>
		<input class="searcher" type="submit" value="Search"/>
		</form>
		
      </div>

      <div class="left">
    <ul>
      <li><a class="nav" href="index.php">Home</a></li>
      <li><a class="nav" href="books.php">Books</a></li>
      <li><a class= "nav" href="music.php">Music</a></li>
      <li><a class="nav" href="games.php">Games</a></li>
	  <li><a class="nav" href="dvd.php">DVDs</a></li>
    </ul>
      </div>

      <div class="content">
	  <?php
	  error_reporting(0);
	  
        if($loggedin=="1"){
			$session=$_SESSION['username'];
			$promo_code = $_GET['promo_code'];
		 
		 
			$dbname = 'bd17671';
		$dbuser = 'root';
		$dbpass = '';
		$dbhost = 'localhost';
			

			$link = mysqli_connect( $dbhost, $dbuser, $dbpass )
			or die( "Unable to Connect to '$dbhost'" );

			mysqli_select_db( $link, $dbname )
			or die("Could not open the db '$dbname'");
			
			$item_price = $_GET['item_price'];
			
			if($promo_code=="spring01"){
				$item_price=$item_price*0.9;
			}
			
		    $item_number=$_GET['item_code'];
			echo"Your order of $item_number has been set for $item_price";	
			$order_query="INSERT INTO customer_order(order_date,delivered,shipping_date,customer_number) VALUES (
			NOW(),
			FALSE,
			ADDDATE(NOW(),3),
			$session)";
			$result=mysqli_query($link,$order_query);
			
			//mysqli_free_result($result);
			
			$order_number_query = "SELECT MAX(order_number) FROM customer_order";
			$order_number_result = mysqli_query($link, $order_number_query);
			$row2 = mysqli_fetch_array($order_number_result, MYSQLI_ASSOC);
			$order_number = $row2['MAX(order_number)'];
			
			$order_query="INSERT INTO order_item VALUES ('{$item_number}', {$item_price}, {$order_number}, 1)";
			mysqli_query($link,$order_query);
			
			//code to update stock
			mysqli_free_result($order_number_result);
			$update_stock = $_GET['item_stock'];
			$update_stock-=1;
			echo"<br/>$item_number";
			
			$update_query="UPDATE inventory SET item_stock_count =item_stock_count-1 WHERE item_code=\"$item_number\"";
			mysqli_query($link,$update_query);
			//echo"<br/>$order_query";
			
			
			//create customer order		 
		 
		 
		}
		if($loggedin=="0"){
			echo"You must login before placing an order.";
		}
		?>
      </div>
	  

      
    </div>
	</div>
  </body>
</html>