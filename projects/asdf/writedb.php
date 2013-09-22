<?php
// CONNECT TO DATABASE
include('../dbconnect.php');

// WRITE TO DATABASE
$query = "insert into comments values ('','".$_GET['name']."','".$_GET['thecomment']."')";
$res = mysql_query($query);
header("location: comment.php?success=1");

?>