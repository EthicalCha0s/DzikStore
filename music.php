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
		}
		
	  ?>
        </ul>
		<?php
		 if($loggedin=="1"){
			 echo"<h1>Welcome to DzikStore ".$_SESSION['username']."</h1>";
		 }
		 if($loggedin=="0"){		
		 echo"<h1>Welcome to DzikStore</h1>";
		 }
		?>
		
		<form  action="searchMusic.php" method="GET">
		<input type="text" name="searchbox" placeholder="Search Music..." value=""/>
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
         <?php
		 $dbname = 'bd17671'; # Change to your username
         $dbuser = 'root';
         $dbpass = '';
         $dbhost = 'localhost';

$link = mysqli_connect( $dbhost, $dbuser, $dbpass )
or die( "Unable to Connect to '$dbhost'" );

mysqli_select_db( $link, $dbname )
or die("Could not open the db '$dbname'");

$test_query = "select * from inventory where item_group=1002";
$result = mysqli_query( $link, $test_query );


echo "<table>";
echo "<tr><th>Image</th><th>Item/code</th><th>Author/desc</th><th>Price</th><th>buy</th></tr>\n";

while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) )
{
	
  $path = $row['item_image_loc'];
  echo "<tr>\n";
  echo "<td><img src=\"http://localhost/images/$path\" alt=\"$path.jpg\" style=\"width:70px;height:100px;\"></td>",
  '<td>', $row[ 'item_name' ],'<br/>',$row['item_code'],'</td>',
  '<td>', $row[ 'item_author' ],"<br/>", $row['item_description'],'</td>',
  '<td>', $row[ 'item_price' ], '</td>', "\n";
  if($row['item_stock_count'] == 0){
	  echo"<td><a class=\"shop\" style=\"background-color:red;\" href=\"#outofstock\">Out of Stock</a></td>";
  }else{
  echo '<td><a class="shop" href="confirm.php?item_code=' . $row[ 'item_code' ] .'&item_name='. $row['item_name'] .'&item_location='.$row['item_stock_location'].'&item_price=' . $row[ 'item_price' ] .'&item_image=' . $row['item_image_loc']. 
  '&item_stock='.$row['item_stock_count'].'&item_description='.$row['item_description'] .'">Buy</a></td>';
  }
  echo "</tr>\n";
}
echo "</table>";


mysqli_free_result( $result );
mysqli_close( $link );
		 ?>
      		 
      </div>
	  

      
    </div>
	</div>
  </body>
</html>