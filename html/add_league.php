<html>
<form action="do_add_league.php" method=POST>
Add a new league.<br>
League name:  <input type="text" name="name"><br>
Season:  <select name="season"><option value="winter">Winter</option><option value="summer">Summer</option></select><br>
Year (4-digit):  <input type="text" name="year"><br>
House: <select name="house">

<?php
include "dbconn.php";
$query1 = "select hname from house order by hname asc";
$result1 = mysql_query($query1);
if (!$result1){ die(mysql_error()); }
while($house = mysql_fetch_row($result1)){
  echo "<option>$house[0]</option>";
}
?>

</select><br>
<input type="submit" value="Send"><input type="reset">
</form><br>
<a href="index.php">Return to home</a>
</html>
