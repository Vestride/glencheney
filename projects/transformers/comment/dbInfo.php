<?php
$dbHost="glencheneycom.ipagemysql.com";
$dbUsername="gec5190";
$dbPass="FourOhNine";

//make connection
$dbLink = mysql_connect($dbHost, $dbUsername, $dbPass) or die("Couldn't connect: " . mysql_error());

mysql_select_db("gec5190");

//stop sql injection for get
foreach($_GET as $key => $val)
{
	$_GET[$key]-mysql_escape_string($val);
}
//stop sql injection for post
foreach($_POST as $key => $val)
{
	$_POST[$key]-mysql_escape_string($val);
}
?>