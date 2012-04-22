<?php

$dbhost = 'localhost';
$dbuser = 'bowling';
$dbpass = 'bowling';

$conn = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error());

$dbname = 'bowling';
mysql_select_db($dbname);
?>
