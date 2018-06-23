<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Example 61</title>
  <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 20%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:first-child {
    background-color: #dddddd;
}
</style>
</head>
<body>
<?php
# Multi-Dimensional Arrays

$first_line = array( 1, 2, 3, 4 );
$second_line = array( 5, 6, 7, 8 );

$coords[ 0 ] = $first_line;
$coords[ 1 ] = $second_line;

//Alternate assignment
//$coords = array($first_line,$second_line);

# Display values with a nested loop

echo '<h2>Nested Loop for 2-Dimensional Array</h2>', "\n";
echo '<table>';

echo "<tr><th></th><th>0</th><th>1</th><th>2</th><th>3</th></tr>";
foreach( $coords as $x => $inner_array )
{
	echo "<tr><th>$x</th>";
  foreach( $inner_array as $y => $val )
  {
	echo "<th>$val</th>";
	
  }
}

echo '</table>';

?>
</body>
</html>
