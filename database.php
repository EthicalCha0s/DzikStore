<?php
    error_reporting(0);
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
		<?php
		if($loggedin==0){
		echo"<li class=\"top\"><a class=\"nav\" href=\"managerlogin.php\">Manager Login</a></li>";}
	  ?>
      <li class="top"><a class="nav" href="reset.php">Reset DBase</a></li>
      <li class="top"><a class="nav" class="top" href="index.php">Home</a></li>
      <?php
	  if($loggedin == "0"){
			echo"<li class=\"top\"><a class=\"nav\" href=\"login.php\">Login</a></li>";
		}
	    if($loggedin == "1"){
			echo"<li class=\"top\"><a class=\"nav\" href=\"login.php\">Logout</a></li>";
		}?>
        </ul>
		<?php
		 if($loggedin=="1"){
			 echo"<h1>Welcome to DzikStore ".$_SESSION['username']."</h1>";
		 }
		 if($loggedin=="0"){		
		 echo"<h1>Welcome to DzikStore</h1>";
		 }
		?>
		
		<form  action="searchHome.php" method="GET">
		<input type="text" name="searchbox" placeholder="Search All..." value=""/>
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
	   <?php
	  $username = $_SESSION['username'];
	  if ($username==100 || $username==101){
		  echo"<li><a class=\"nav\" href=\"database.php\">Database</a></li>";
	  }
	  ?>
    </ul>
      </div>

      <div class="content">
	    <h1>All databases:</h1>
		<?php
		echo"<h2>customer:</h2>";
		$dbname = 'bd17671';
		$dbuser =  'root';
		$dbpass = '';
		$dbhost = 'localhost';

		$link = mysqli_connect( $dbhost, $dbuser, $dbpass )
		or die( "Unable to Connect to '$dbhost'" );

		mysqli_select_db( $link, $dbname )
		or die("Could not open the db '$dbname'");

		$test_query = "select * from customer";
		$result = mysqli_query( $link, $test_query );


		echo "<table>";
		echo "<tr><th>Customer Number|</th><th>surname|</th><th>initials|</th><th>firstname|</th><th>title|</th><th>address1|</th><th>address2|</th><th>city|</th><th>county|</th><th>postcode|</th><th>passwd|</th>
		<th>passphrase|</th></tr>\n";

		while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) )
		{
			
		  $path = $row['item_image_loc'];
		  echo "<tr>\n";
		  echo '<td>',$row['customer_number'],'</td>';
		  echo '<td>',$row['surname'],'</td>';
		  echo '<td>',$row['initials'],'</td>';
		  echo '<td>',$row['firstname'],'</td>';
		  echo '<td>',$row['title'],'</td>';
		  echo '<td>',$row['address1'],'</td>';
		  echo '<td>',$row['address2'],'</td>';
		  echo '<td>',$row['city'],'</td>';
		  echo '<td>',$row['county'],'</td>';
		  echo '<td>',$row['postcode'],'</td>';
		  echo '<td>',$row['passwd'],'</td>';
		  echo '<td>',$row['passphrase'],'</td>';
		  echo "</tr>\n";
		}
		echo "</table><br/>";
		mysqli_free_result( $result );
		
		echo"<h2>customer_order</h2>";
		$query="select * from customer_order";
		$result = mysqli_query( $link, $query );
		echo"<table>";
		echo"<tr><th>order_number|<th/><th>order_date|<th/><th>delivered|<th/><th>shipping_date|<th/><th>customer_number<th/><tr/>";
        while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ){
			echo"<tr>";
			echo '<td>',$row['order_number'],'<td/>';
			echo '<td>',$row['order_date'],'<td/>';
			echo '<td>',$row['delivered'],'<td/>';
			echo '<td>',$row['shipping_date'],'<td/>';
			echo '<td>',$row['customer_number'],'<td/>';
			echo"<tr/>";
		}		
		echo"</table><br/>";
		mysqli_free_result( $result );
		
		echo"<h2>inventory</h2>";
		$query="select * from inventory";
		$result = mysqli_query( $link, $query );
		echo"<table>";
		echo"<tr><th>item_code|<th/><th>item_name|<th/><th>item_description|<th/><th>item_author|<th/><th>item_image_loc|<th/><th>item_group|
		<th/><th>item_price|<th/><th>item_stock_location|<th/><th>item_stock_count|
		<th/><th>item_order_count|<th/><tr/>";
        while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ){
			echo"<tr>";
			echo '<td>',$row['item_code'],'<td/>';
			echo '<td>',$row['item_name'],'<td/>';
			echo '<td>',$row['item_description'],'<td/>';
			echo '<td>',$row['item_author'],'<td/>';
			echo '<td>',$row['item_image_loc'],'<td/>';
			echo '<td>',$row['item_group'],'<td/>';
			echo '<td>',$row['item_price'],'<td/>';
			echo '<td>',$row['item_stock_location'],'<td/>';
			echo '<td>',$row['item_stock_count'],'<td/>';
			echo '<td>',$row['item_order_count'],'<td/>';
			echo"<tr/>";
		}		
		echo"</table><br/>";
		mysqli_free_result( $result );
		
		echo"<h2>inventory_group</h2>";
		$query="select * from inventory_group";
		$result = mysqli_query( $link, $query );
		echo"<table>";
		echo"<tr><th>group_code|<th/><th>group_name|<th/><tr/>";
        while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ){
			echo"<tr>";
			echo '<td>',$row['group_code'],'<td/>';
			echo '<td>',$row['group_name'],'<td/>';
			echo"<tr/>";
		}		
		echo"</table><br/>";
		mysqli_free_result( $result );
		
		
		echo"<h2>manager</h2>";
		$query="select * from manager";
		$result = mysqli_query( $link, $query );
		echo"<table>";
		echo"<tr><th>manager_number|<th/><th>surname|<th/><th>initials|<th/><th>firstname|<th/><th>passwd|
		<th/><th>passphrase|<th/><tr/>";
        while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ){
			echo"<tr>";
			echo '<td>',$row['manager_number'],'<td/>';
			echo '<td>',$row['surname'],'<td/>';
			echo '<td>',$row['initials'],'<td/>';
			echo '<td>',$row['firstname'],'<td/>';
			echo '<td>',$row['passwd'],'<td/>';
			echo '<td>',$row['passphrase'],'<td/>';
			echo"<tr/>";
		}		
		echo"</table><br/>";
		mysqli_free_result( $result );
		
		echo"<h2>order_item</h2>";
		$query="select * from order_item";
		$result = mysqli_query( $link, $query );
		echo"<table>";
		echo"<tr><th>item_code|<th/><th>value|<th/><th>order_number|<th/><th>quantity|<th/><tr/>";
        while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ){
			echo"<tr>";
			echo '<td>',$row['item_code'],'<td/>';
			echo '<td>',$row['value'],'<td/>';
			echo '<td>',$row['order_number'],'<td/>';
			echo '<td>',$row['quantity'],'<td/>';
			echo"<tr/>";
		}		
		echo"</table><br/>";
		mysqli_free_result( $result );
		
		echo"<h2>promotion_code</h2>";
		$query="select * from promotion_code";
		$result = mysqli_query( $link, $query );
		echo"<table>";
		echo"<tr><th>code|<th/><th>discount|<th/><tr/>";
        while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ){
			echo"<tr>";
			echo '<td>',$row['code'],'<td/>';
			echo '<td>',$row['discount'],'<td/>';
			echo"<tr/>";
		}		
		echo"</table><br/>";
		mysqli_free_result( $result );
		
		echo"<h2>review</h2>";
		$query="select * from review";
		$result = mysqli_query( $link, $query );
		echo"<table>";
		echo"<tr><th>review_number|<th/><th>customer_number|<th/><th>item_code|<th/><th>rating|</th><tr/>";
        while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ){
			echo"<tr>";
			echo '<td>',$row['review_number'],'<td/>';
			echo '<td>',$row['customer_number'],'<td/>';
			echo '<td>',$row['item_code'],'<td/>';
			echo '<td>',$row['rating'],'<td/>';
			echo"<tr/>";
		}		
		echo"</table><br/>";
		mysqli_free_result( $result );


		
		mysqli_close( $link );
		echo"<br/><br/><br/><br/><p>test</p>";
				
				?>
		
      </div>
	  

      
    </div>
	</div>
  </body>
</html>