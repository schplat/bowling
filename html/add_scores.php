<html>
<head>
<script language=JavaScript>
function reload(form){
  var val=form.house.options[form.house.options.selectedIndex].value;
  self.location='add_scores.php?h_id=' + val ;
}
</script>
</head>

<form action="do_add_scores.php" method=POST>
Add scores:<br>

<?php

include "dbconn.php";

$h_id=$_GET['h_id'];

$query3 = "select name, id from bowlers order by name asc";
$result3 = mysql_query($query3);
if (!$result3){ die(mysql_error()); }

?>

What house: <select name="house" onchange="reload(this.form)">

<?php

$query1 = "select hname, id from house order by hname asc";

$result1 = mysql_query($query1);
if (!$result1){ die(mysql_error()); }

if(isset($h_id) and strlen($h_id) > 0){
  $query2 = "select id, lname, h_id, season, year from league where h_id=$h_id and active='Y' order by lname asc";
  $result2 = mysql_query($query2);
  if (!$result2){ die(mysql_error()); }
}else{
  $query2 = "select id, lname, h_id, season, year from league where active='Y' order by lname asc";
  $result2 = mysql_query($query2);
  if (!$result2){ die(mysql_error()); }
}

while( $house = mysql_fetch_row($result1)){
  if($house[1]==@$h_id){
    echo "<option selected value='$house[1]'>$house[0]</option><br>";
  }else{
    echo "<option value='$house[1]'>$house[0]</option>";
  }
}

?>

</select><br>
What league: <select name="league">

<?php

while( $league = mysql_fetch_row($result2)){
  echo "<option value='$league[0]'>$league[1] ($league[3] - $league[4])</option>";
}
?>

</select><br>
Which bowler: <select name="bowler">

<?php

while( $bowlers = mysql_fetch_row($result3)){
  echo "<option value='$bowlers[1]'>$bowlers[0]</option>";
}

?>
</select><br>
Game 1:<input type=text name=score1 size=3 maxlength=3></input><br>
Game 2:<input type=text name=score2 size=3 maxlength=3></input><br>
Game 3:<input type=text name=score3 size=3 maxlength=3></input><br>
Date Bowled: <select name=moy>

<?php

$moy = array("January"=>"01","February"=>"02","March"=>"03","April"=>"04","May"=>"05","June"=>"06","July"=>"07","August"=>"08","September"=>"09","October"=>"10","November"=>"11","December"=>"12");

foreach( $moy as $key => $value){
  echo "<option value=$value>$key</option>";
}
?>

</select>
<select name=dom>

<?php

for($i=1; $i<=31; $i++){
  if($i<10){
    $i = "0".$i;
  }
  echo "<option value=$i>$i</option>";
}
?>

</select>
<select name=year>

<?php

for($j=2009; $j<=2011; $j++){
  echo "<option value=$j>$j</option>";
}
?>

</select><br>
<input type="submit" value="Send"><input type="reset">
</form><br>
<a href="index.php">Return to home</a>
</html>
