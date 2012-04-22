<html>
<head>
<script language=JavaScript>
function reload(form){
  var val=form.name.options[form.name.options.selectedIndex].value;
  self.location='reports.php?b_id=' + val ;
}
</script>
<script language="javascript" src="calendar.js"></script>
</head>

<form name="report" action="get_report.php" method=POST>
Select a bowler for a report: <select name="name" onchange="reload(this.form)">

<?php

include "dbconn.php";

$b_id=$_GET['b_id'];

$query1 = "select name, id from bowlers";

$result1 = mysql_query($query1);
if (!$result1){ die(mysql_error()); }

if(isset($b_id) and strlen($b_id) > 0){
  $query2 = "select distinct lname, league.id, season, year from league left join (scores) on (league.id=scores.l_id) where scores.b_id=$b_id";
  $result2 = mysql_query($query2);
  if (!$result2){ die(mysql_error()); }
}else{
  $query2 = "select lname, id, season, year from league";
  $result2 = mysql_query($query2);
  if (!$result2){ die(mysql_error()); }
}

while($bowlers = mysql_fetch_row($result1)){
  if($bowlers[1]==@$b_id){
    echo "<option selected value='$bowlers[1]'>$bowlers[0]</option><br>";
  }else{
    echo "<option value='$bowlers[1]'>$bowlers[0]</option>";
  }
}

?>

</select><br>
Which league: <select name="league"><option value=0>All leagues</option>

<?php

while( $league = mysql_fetch_row($result2)){
  echo "<option value='$league[1]'>$league[0] - $league[2], $league[3]</option>";
}
?>

</select><br>Select a date range?  <input type="checkbox" name="daterange" value="1"><br>From: 

<?php

require_once('classes/tc_calendar.php');

$calfrom = new tc_calendar("datefrom",true,false);
$calfrom->setDate(idate('d'),idate('m'),idate('Y'));
$calfrom->setYearInterval(2009, idate('Y'));
$calfrom->dateAllow('2009-01-01',date('Y-m-d'));
$calfrom->setIcon('images/iconCalendar.gif');
$calfrom->setWidth(175);

$calfrom->writeScript();

print "<br>To: ";

$calto = new tc_calendar("dateto",true,false);
$calto->setDate(idate('d'),idate('m'),idate('Y'));
$calto->setYearInterval(2009, idate('Y'));
$calto->dateAllow('2009-01-01',date('Y-m-d'));
$calto->setIcon('images/iconCalendar.gif');
$calto->setWidth(175);

$calto->writeScript();
?>
<br><input type="submit" value="Send"><input type="reset">
</form><br>
<a href="index.php">Return to home</a>
</html>
