<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>DzikStore</title>
    <link rel="stylesheet" href="DzikStyle.css" type="text/css" />
	
	<script>
    function validate() {
    var x = document.forms["loginform"]["username"].value;
    var y = document.forms["loginform"]["password"].value;
    
    if((x== "") || (y=="")){
        alert("Username and password must be entered");
        return false;
    }
	if (isNaN(x)){
		alert("Username must be a number");
		return false
	}
}
</script>
	
  </head>
  <body>
  <div class="bg">
    <div class="container">
      <div class="header">       
		<ul>
      <li class="top"><a class="nav" class="top" href="#reset">Reset DBase</a></li>
      <li class="top"><a class="nav" class="top" href="index.php">Home</a></li>
      <li class="top"><a class="nav" class="top" href="login.php">Login</a></li>
        </ul>
		<h1>Welcome to DzikStore</h1>
		
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
    </ul>
      </div>

      <div class="content">
	  <!--LOGIN FORM-->
	  <h1>Manager login:</h1>
	  <form name="loginform" action="managerlogin.php" onsubmit="return validate()" method="GET">
	  <p>Username:</p>
	  <input type="text" placeholder="Ex:1055" name="username" value=""/>
	  <p>Password:</p>
	  <input type="password"  placeholder="Password" name="password" value=""/>
	  <input type="submit" name="loginButton" value="Login">
	  </form>	
	  <?php
	if ( isset( $_GET[ 'username' ] ) && isset( $_GET[ 'password' ] ) )
	{
	  $username = $_GET[ 'username' ];
	  $password = $_GET[ 'password' ];

		$dbname = 'bd17671';
		$dbuser = 'root';
		$dbpass = '';
		$dbhost = 'localhost';

	  $link = mysqli_connect( $dbhost, $dbuser, $dbpass )
	  or die( "Unable to Connect to '$dbhost'" );

	  mysqli_select_db( $link, $dbname )
	  or die("Could not open the db '$dbname'");

	  $password_query = "select * from manager where manager_number = '" .
	  $username . "' and passwd = MD5( '" . $password . "' )";
	  
	  $result = mysqli_query( $link, $password_query );

	  if ( mysqli_num_rows( $result ) == 1 ) # Number of result rows
	  {
		session_start();
		$_SESSION[ 'username' ] = $username;
		header( 'Location: http://localhost/index.php' );
		exit();
	  }
	  else
	  {
		echo '<p>Login failed. Please try again.</p>', "\n";
		'</p>';
	  }
	}

	?>		
      </div>
	  

      
    </div>
	</div>
  </body>
</html>