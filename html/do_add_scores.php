<html>
<?php

include "dbconn.php";

$game1=$_POST['score1'];
$game2=$_POST['score2'];
$game3=$_POST['score3'];
$l_id=$_POST['league'];
$h_id=$_POST['house'];
$b_id=$_POST['bowler'];
$moy=$_POST['moy'];
$dom=$_POST['dom'];
$year=$_POST['year'];

$date="$year-$moy-$dom";

if (!is_numeric($game1) || !is_numeric($game2) || !is_numeric($game3)){
  echo "Typically scores are numbers only, retard.";
  exit;
}

if ($game1 > 300 || $game2 > 300 || $game3 > 300){
  echo "Lawlz, you shot over 300, WTFZ";
  exit;
}

#echo "$game1<br>$game2<br>$game3<br>$l_id<br>$h_id<br>$b_id<br>$date<br>";

$query1 = "INSERT INTO scores (game1, game2, game3, date, l_id, h_id, b_id) VALUES ('$game1','$game2','$game3','$date','$l_id','$h_id','$b_id')";
$result1 = mysql_query($query1);
if (!$result1){ die(mysql_error()); }

?>
Database updated.  Return <a href="index.php">Home</a>.
<html>
