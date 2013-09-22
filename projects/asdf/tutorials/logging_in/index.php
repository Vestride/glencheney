<?php 
if (strpos($_SERVER["HTTP_USER_AGENT"], "Safari") || strpos($_SERVER["HTTP_USER_AGENT"], "MSIE")){
	$style='style="background:#edecc2;width:191px;"';
} else {
	$style='style="background:#edecc2;width:192px;"';
}
$locnav = array('<span>Logging In</span>',
				'<a href="?tutorial=ports">Ports</a>',
				'<a href="?tutorial=hosts">Hosts</a>',
				'<a href="?tutorial=ftp">FTP</a>',
				'<a href="?tutorial=ssh">SSH</a>',
				'<a href="?tutorial=account">Your Account</a>',
				'<a href="?tutorial=quiz">Logging In Quiz</a>',
				'<br /><a href="../file_management/creation.php">Next Tutorial</a>' );

$title = "Logging In"; //page title
$breadcrumbs[0] = '<a href="../../tutorials">Tutorials</a>'; //breadcrumb data
switch ($_GET["tutorial"]) { //appends title of the page based on GET variable
	case "ports":
		$title.=", Ports";
		$breadcrumbs[2]="Ports";
		$locnav[1] = '<a '.$style.' href="?tutorial=ports">Ports</a>';
		break;
	case "hosts":
		$title.=", Hosts";
		$breadcrumbs[2]="Hosts";
		$locnav[2] = '<a '.$style.' href="?tutorial=hosts">Hosts</a>';
		break;
	case "ftp":
		$title.=", FTP";
		$breadcrumbs[2]="FTP";
		$locnav[3] = '<a '.$style.' href="?tutorial=ftp">FTP</a>';
		break;
	case "ssh":
		$title.=", SSH";
		$breadcrumbs[2]="SSH";
		$locnav[4] = '<a '.$style.' href="?tutorial=ssh">SSH</a>';
		break;
	case "account":
		$title.=", Your Account";
		$breadcrumbs[2]="Your Account";
		$locnav[5] = '<a '.$style.' href="?tutorial=account">Your Account</a>';
		break;
	case "quiz":
		$title.=", Quiz";
		$breadcrumbs[2]="Quiz";
		$locnav[6] = '<a '.$style.' href="?tutorial=quiz">Logging In Quiz</a>';
		break;
	} //end switch statement for page title
	if (isset($breadcrumbs[2])){
		$breadcrumbs[1] = '<a href="?">Logging In</a>'; //breadcrumb is link if [2] is set
	}else {
		$breadcrumbs[1] = 'Logging In'; //breadcrumb if its the last in string
	}
				
include("../../header.php");
switch ($_GET["tutorial"]) {
	case "ports":
		include ("ports.php");
		break;
	case "hosts":
		include ("hosts.php");
		break;
	case "ftp":
		include ("ftp.php");
		break;
	case "ssh":
		include ("ssh.php");
		break;
	case "account":
		include ("account.php");
		break;
	case "quiz":
		include ("quiz.php");
		break;
	default:
		include ("default.php");
}

include("../../footer.php"); ?>