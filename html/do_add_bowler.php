<?php

include "dbconn.php";

$name = $_POST['name'];

$query1 = "SELECT name from bowlers where name = '$name'";
$query2 = "INSERT INTO bowlers (name) VALUES ('$name')";

$result1 = mysql_query($query1);
if (!$result1){
  die(mysql_error());
}

$num = mysql_num_rows($result1);

if ($num >= 1){
  echo "<html>$name is already in the database.</html>";
  exit;
}

$result2 = mysql_query($query2);
if (!$result2){
  die(mysql_error());
}

echo "<html>$name successfully added to database.<br>Return <a href='index.php'>Home</a>.</html>";
?>
