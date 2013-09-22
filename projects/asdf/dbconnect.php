<?php
$dbusername = "409Danasdf";
$dbpassword = "squirrelsDie";
$dbhost = "localhost";
$dbconnect = mysql_connect($dbhost, $dbusername, $dbpassword) or die("Error: could not connect".mysql_error());

$dbname = "409Danasdf";
mysql_select_db ($dbname);
?>