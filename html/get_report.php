<html>
<table border=1><tr><b><td>Date</td><td>Game 1</td><td>Game 2</td><td>Game 3</td><td>Series</td><td>Average</td></b></tr>
<?php

include "dbconn.php";

$b_id=$_POST['name'];
$l_id=$_POST['league'];

if ($_POST['daterange']==1){
  $datefrom=$_POST['datefrom'];
  $dateto=$_POST['dateto'];
  $addquery="and date >= '".$datefrom."' and date<= '".$dateto."'";
}

if (!$addquery){
  $addquery=" ";
}

$query01 = "select name from bowlers where id=$b_id";
$result01 = mysql_query($query01);
if(!$result01){ die(mysql_error()); }
$names = mysql_fetch_row($result01);
$name = $names[0];

$query02 = "select lname, season, year from league where id=$l_id";
$result02 = mysql_query($query02);
if(!$result02){ die(mysql_error()); }
$leagues = mysql_fetch_row($result02);
$lname = $leagues[0];
$season = $leagues[1];
$year = $leagues[2];

echo "<H1><b>Report for $name in league $lname, $season, $year</b></H1>";

if ($l_id==0){
  $query1 = "select game1, game2, game3, date from scores where b_id=$b_id ".$addquery." order by date";
  $query2 = "select sum(game1), sum(game2), sum(game3) from scores where b_id=$b_id ".$addquery;
}else{
  $query1 = "select game1, game2, game3, date from scores where b_id=$b_id and l_id=$l_id ".$addquery." order by date";
  $query2 = "select sum(game1), sum(game2), sum(game3) from scores where b_id=$b_id and l_id=$l_id ".$addquery;
}

$result1 = mysql_query($query1);
if(!$result1){ die(mysql_error()); }

$result2 = mysql_query($query2);
if(!$result2){ die(mysql_error()); }

$totals = mysql_fetch_row($result2);
$g1total = $totals[0];
$g2total = $totals[1];
$g3total = $totals[2];
$sets = mysql_num_rows($result1);
$g1avg = round($g1total / $sets,3);
$g2avg = round($g2total / $sets,3);
$g3avg = round($g3total / $sets,3);
$allgames = $sets * 3;
$alltotal = $g1total + $g2total + $g3total;
$allavg   = round($alltotal / $allgames,3);

while( $report = mysql_fetch_row($result1)){
  $game1 = $report[0];
  $game2 = $report[1];
  $game3 = $report[2];
  $date = $report[3];
  $series = $game1 + $game2 + $game3;
  $tseries = $tseries + $series;
  $gcount = $gcount + 3;
  $runavg = round($tseries / $gcount,3);

  echo "<tr><td>$date</td><td>$game1</td><td>$game2</td><td>$game3</td><td>$series</td><td>$runavg</td></tr>";

}

$tseriesavg = round($tseries / $sets,3);

echo "<tr><td><b>Totals</b></td><td>$g1total</td><td>$g2total</td><td>$g3total</td><td>$alltotal</td><td>$allavg</td></tr>";
echo "<tr><td><b>Averages</b></td><td>$g1avg</td><td>$g2avg</td><td>$g3avg</td><td>$tseriesavg</td><td>$allavg</td></tr>";
?>
</table><br>
Back to <a href="reports.php>Reports</a> page.
</html>
