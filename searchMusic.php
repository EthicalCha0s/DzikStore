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
      <li class="top"><a class="nav" class="top" href="reset.php">Reset DBase</a></li>
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
    </ul>
      </div>

      <div class="content">
         <?php
		 $dbname = 'bd17671'; # Change to your username
$dbuser = 'bd17671';
$dbpass = 'obscure';
$dbhost = 'localhost';

$search = $_GET['searchbox'];
$link = mysqli_connect( $dbhost, $dbuser, $dbpass )
or die( "Unable to Connect to '$dbhost'" );

mysqli_select_db( $link, $dbname )
or die("Could not open the db '$dbname'");

$test_query = "select * from inventory where((item_name LIKE '%$search%')or(item_description LIKE '%$search%')) AND (item_group=1002)";
$result = mysqli_query( $link, $test_query );


echo "<table>";
echo "<tr><th>Image</th><th>Item</th><th>Author/desc</th><th>Price</th></tr>\n";

while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) )
{
	
  $path = $row['item_image_loc'];
  echo "<tr>\n";
  echo "<td><img src=\"http://localhost/images/$path\" alt=\"$path.jpg\" style=\"width:70px;height:100px;\"></td>",
  '<td>', $row[ 'item_name' ], '</td>',
  '<td>', $row[ 'item_author' ],"<br/>", $row['item_description'],'</div></td>',
  '<td>', $row[ 'item_price' ], '</td>', "\n";
  echo '<td><a href="example74_buy.php?item_code=' . $row[ 'item_code' ] .
  '&item_price=' . $row[ 'item_price' ] . '">Buy</a></td>';
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