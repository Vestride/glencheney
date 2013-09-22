<?php 
if (strpos($_SERVER["HTTP_USER_AGENT"], "Safari") || strpos($_SERVER["HTTP_USER_AGENT"], "MSIE")){
	$style='style="background:#edecc2;width:191px;"';
} else {
	$style='style="background:#edecc2;width:192px;"';
}

$locnav = array("History",
				'<a href="?page=birth">The Birth of UNIX</a>',
				'<a href="?page=evolution">The Evolution of UNIX</a>');

$title = "History"; //page title
switch ($_GET["page"]) { //appends title of the page based on GET variable
	case "birth":
		$title.=", The Birth of Unix";
		$breadcrumbs[1]="The Birth of UNIX";
		$locnav[1] = '<a '.$style.' href="?page=birth">The Birth of UNIX</a>';
		break;
	case "evolution":
		$title.=", The Evolution of UNIX";
		$breadcrumbs[1]="The Evolution of UNIX";
		$locnav[2] = '<a '.$style.' href="?page=evolution">The Evolution of UNIX</a>';
		break;
} //end switch statement for page title

	if (isset($breadcrumbs[1])){
		$breadcrumbs[0] = '<a href="?">History</a>'; //breadcrumb is link if [2] is set
	}else {
		$breadcrumbs[0] = 'History'; //breadcrumb if its the last in string
	}

include("../header.php");//include header

switch ($_GET["page"]) {
	case "birth":
		include ("birth.php");
		break;
	case "evolution":
		include ("evolution.php");
		break;
	default:
		include ("default.php");
}

include("../footer.php"); ?>