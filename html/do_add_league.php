<?php

include "dbconn.php";

$name = $_POST['name'];
$season = $_POST['season'];
$year = $_POST['year'];
$house = $_POST['house'];

$query1 = "SELECT lname,season,year FROM league WHERE lname='$name' and season='$season' and year='$year'";
$query2 = "INSERT INTO league (lname,season,year,h_id,active) VALUES ('$name','$season','$year',(select id from house where hname='$house'),'Y')";

$result1 = mysql_query($query1);
if (!$result1){
  die(mysql_error());
}

$num = mysql_num_rows($result1);

if ($num >= 1){
  echo "<html>$name, $season, $year is already in the database.</html>";
  exit;
}

$result2 = mysql_query($query2);
if (!$result2){
  die(mysql_error());
}


echo "<html>$name, $season, $year successfully added to database.<br>Return <a href='index.php'>Home</a>.</html>";
?>
