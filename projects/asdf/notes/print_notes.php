<?php 
session_start();
echo '<?xml version="1.0" encoding="utf-8"?>';?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASDF Unix Tutorial - Notes</title>
<link rel="icon" type="image/vnd.microsoft.icon" href="http://nova.it.rit.edu/~409Dan-asdf/images/favicon.ico" />
</head>
<body onload="window.print();">
<h2 style="text-align:center;">UNIX Notes</h2>
<?php 
$notes = $_SESSION['notes'];

$line_break = array ("\r\n", "\r", "\n");
$notes = str_replace(" ", "&nbsp;", $notes, $count);

$notes = str_replace($line_break, "<br />", $notes, $count);


echo $notes;
 ?>
</body>
</html>
