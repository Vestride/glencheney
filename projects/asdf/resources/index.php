<?php 
if (strpos($_SERVER["HTTP_USER_AGENT"], "Safari") || strpos($_SERVER["HTTP_USER_AGENT"], "MSIE")){
	$style='style="background:#edecc2;width:191px;"';
} else {
	$style='style="background:#edecc2;width:192px;"';
}

$locnav = array("Resources",
				'<a href="?resource=qkref">Quick Reference Guide</a>',
				'<a href="?resource=books">Recommended Reading</a>',
				'<a href="?resource=online">Advanced Online Guides</a>',
				'<a href="?resource=programs">Programs</a>');

$title = "Resources"; //page title
$breadcrumbs[0] = '<a href="?">Resources</a>';
switch ($_GET["resource"]) { //appends title of the page based on GET variable
	case "qkref":
		$title.=", Quick Reference Guide";
		$breadcrumbs[1]="Quick Reference Guide";
		$locnav[1] = '<a '.$style.' href="?resource=qkref">Quick Reference Guide</a>';
		break;
	case "books":
		$title.=", Recommended Reading";
		$breadcrumbs[1]="Recommended Reading";
		$locnav[2] = '<a '.$style.' href="?resource=books">Recommended Reading</a>';
		break;
	case "online":
		$title.=", Advanced Online Guides";
		$breadcrumbs[1]="Advanced Online Guides";
		$locnav[3] = '<a '.$style.' href="?resource=online">Advanced Online Guides</a>';
		break;
	case "programs":
		$title.=", Programs";
		$breadcrumbs[1]="Programs";
		$locnav[4] = '<a '.$style.' href="?resource=programs">Programs</a>';
		break;
} //end switch statement for page title

	if (isset($breadcrumbs[1])){
		$breadcrumbs[0] = '<a href="?">Resources</a>'; //breadcrumb is link if [2] is set
	}else {
		$breadcrumbs[0] = 'Resources'; //breadcrumb if its the last in string
	}

include("../header.php");

switch ($_GET["resource"]) { //switch statement to choose what content to display
	case "qkref":
		include ("qkref.php");
		break;
	case "books":
		include ("books.php");
		break;
	case "online":
		include ("online.php");
		break;
	case "programs":
		include ("programs.php");
		break;
	default:
		include ("default.php");
} //end content choosing switch statement

include("../footer.php"); ?>

