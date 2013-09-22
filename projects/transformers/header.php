<?php 
	//added a session name (so it wont get overwritten by others...)
	session_name('glenC');
	session_start();
	//first big change - you can't do the changing of the session like you tried (lines 36-38 of index.php)
	//php doesn't work on the client - so i changed the index to send to itself along with a get of change=newBackground
	//so here - if there is a change being sent, then change it!
	if(isset($_GET['change']))
	{
		$_SESSION['background'] = $_GET['change'];
		//echo $_SESSION['background'];
	}
	//if first time here...
	if (!isset($_SESSION['background']))
	{
		$_SESSION['background'] = 'decepticon';
	}
	echo'<?xml version="1.0" encoding="utf-8"?>'; 
	$path = "http://www.glencheney.com/projects/transformers/";
        $doneFunc = '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $pageTitle;?></title>
<link rel="stylesheet" type="text/css"  href="<?php echo $path . "styles.css";?>" />
<link rel="icon" type="image/png" href="<?php echo $path . "images/favicon.png";?>" />
<script src="<?php echo $path . "js.js";?>" type="text/javascript"></script>

