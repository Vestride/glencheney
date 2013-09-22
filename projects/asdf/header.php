<?php
session_start();
if (isset($_GET['notes'])){
	if ($_GET['notes'] == 'on'){
		$_SESSION['show_notes'] = "on";
	}else if ($_GET['notes'] == 'off'){
		$_SESSION['show_notes'] = "off";
	}
}
if (isset($_POST['notes'])){
	$_SESSION['notes'] = $_POST['notes'];
}
echo '<?xml version="1.0" encoding="utf-8"?>';
$page='http://www.glencheney.com/projects/asdf/';
if (strpos($_SERVER["HTTP_USER_AGENT"], "Safari") && !strpos($_SERVER["HTTP_USER_AGENT"], "Windows")){
	$browser = "safari"; //use to change navigation colors to match gradients in safari
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASDF Unix Tutorial<?php if ($title) echo ' - '.$title; ?></title>

<link href="<?php echo $page;?>style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $page;?>images/favicon.ico" />
<?php
if (strpos($title, "Site Map") != -1)
echo '<link rel="stylesheet" type="text/css" href="'.$page.'sitemap.css" />';
?>
<?php if ($browser == "safari"){
	echo '<link rel="stylesheet" type="text/css" href="'.$page.'safari_styles.css" /><!--stylesheet for safari-->';
}?>
<!--[if IE 7]> 
<link href="<?php echo $page;?>ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script type="text/javascript" src="<?php echo $page; ?>main_javascript.php">
</script>
<style type="text/css">
/*<![CDATA[*/
.brushuphint {
	font-size:10pt;
}
/*]]>*/
</style>
<?php
if (strpos($title, "Quiz") != -1)
echo '<script type="text/javascript" src="'.$page.'quiz.js"></script>';
?>
</head>

<body>
<div id="banner">
<a href="<?php echo $page;?>"><img src="<?php echo $page;?>images/banner.png" style="border:0px;" alt="ASDF UNIX Tutorials" /></a></div><!--banner-->
<div id="container">
<img src="<?php echo $page;?>images/globaltop.png" alt="globaltop" />
<div id="globalnav-container">
<div id="globalnav">
<ul>
  	<li><a class="top_parent" href="<?php echo $page; ?>tutorials/">Tutorials</a>
      <ul>
		<li><a href="<?php echo $page;?>tutorials/logging_in">Logging In</a></li>
		<li><a href="<?php echo $page;?>tutorials/file_management/creation.php">File Creation</a></li>
		<li><a href="<?php echo $page;?>tutorials/file_management/organization.php">File Organization</a></li>
		<li><a href="<?php echo $page;?>tutorials/internet_concerns">Internet Concerns</a></li>
      </ul>
  	</li>
</ul>
<ul>
	<li><a href="<?php echo $page;?>history/">History</a></li>
</ul>
<ul>
    <li><a href="<?php echo $page;?>about.php">About</a></li>
</ul>
<ul>
	<li><a href="<?php echo $page;?>resources">Resources</a>
		<ul>
			<li><a href="<?php echo $page;?>resources/?resource=qkref">Quick Reference Guide</a></li>
			<li><a href="<?php echo $page;?>resources/?resource=books">Recommended Reading</a></li>
			<li><a href="<?php echo $page;?>resources/?resource=online">Advanced Online Guides</a></li>
			<li><a href="<?php echo $page;?>resources/?resource=programs">Programs</a></li>
		</ul>
	</li>
</ul>
<ul>
    <li><a href="#">Search</a>
    	<ul style="display:" id="searchul">	
    		<li style="background:#D9FF00;padding:2px;border:1px solid #A7C400">
    			<form action="http://www.google.com/search" method="get">
    				<div style="display:inline;">
    					<input onfocus="searchStay('stay');" onblur="searchStay('go');" id="searchbox" name="q" type="text" value="Web UNIX" style="width:123px;" />
    					<input type="submit" value="Search" />
    				</div>
    			</form>
    		</li>
    	</ul>
    </li>
    
</ul>
</div> <!--globalnav-->
<div style="clear: both;">
</div>
</div><!--globalnav-container-->
<img src="<?php echo $page;?>images/globalbot.png" alt="globalbot" style="position:relative;top:15px; float: right; " />
<?php include("localnav.php"); //include the local nav




//start the breadcrubs
//$breadcrumbs[] is an array holding the path. 
//index 0 is right above home, and so on...

echo '<div id="breadcrumbs">';

if (sizeof($breadcrumbs) > 0){
	echo '<a href="'.$page.'">Home</a> '; 

	for ($i=0; $i<sizeof($breadcrumbs); $i++){
		echo ' &gt; '.$breadcrumbs[$i]; 
	}
}
echo '</div>'; 

//end the breadcrumbs
?>
