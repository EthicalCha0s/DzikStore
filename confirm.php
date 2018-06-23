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
	    $item_code=$_GET['item_code'];
		$item_price=$_GET['item_price'];
		$item_image=$_GET['item_image'];
		$item_desc=$_GET['item_description'];
		$item_name=$_GET['item_name'];
		$item_stock=$_GET['item_stock'];
		$item_location=$_GET['item_location'];
		
		echo "<img src=\"http://localhost/images/$item_image\" alt=\"$item_image.jpg\" style=\"width:210px;height:300px;float:left;\">";
		echo "<h1>$item_name</h1><p>$item_desc<br/>
		<strong>Item Location:</strong> $item_location<br/><strong>Item Stock:</strong> $item_stock<br/>
		<strong>Price:</strong> $item_price <br/><strong>Item code</strong>: $item_code</p>";
		echo "<form action=confirmed.php>
		<input type=\"text\" name=\"promo_code\" placeholder=\"Code\"/>
		<input type=\"submit\" value=\"buy\"/>
		<input type=\"hidden\" name=\"item_code\" value=\"$item_code\"/>
		<input type=\"hidden\" name=\"item_price\" value=\"$item_price\"/>
		<input type=\"hidden\" name=\"item_stock\" value=\"$item_stock\"/>
		
		
		</form>";
		
	  ?>
		
      </div>
	  

      
    </div>
	</div>
  </body>
</html>