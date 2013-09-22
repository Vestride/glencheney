<?php 
if (strpos($_SERVER["HTTP_USER_AGENT"], "Safari") || strpos($_SERVER["HTTP_USER_AGENT"], "MSIE")){
	$style='style="background:#edecc2;width:191px;"';
} else {
	$style='style="background:#edecc2;width:192px;"';
}

$locnav = array('<span style="positioning:relative; left:1em;">Internet Concerns</span>',
				'<a href="?section=ownership">Ownership</a>',
				'<a href="?section=permissions">Permissions</a>',
				'<a href="?section=chmod">Chmod</a>',
				'<a href="?section=num_permissions">Numeric Permissions</a>',
				'<a href="?section=activity">Permissions Acivity</a>',
				'<a href="?section=uploading">Uploading Files</a>',
				'<a href="?section=quiz">Internet Concerns Quiz</a>',
				'<br /><a href="../file_management/organization.php">Previous Tutorial</a>');

$title = "Internet Concerns"; //page title
$breadcrumbs[0] = '<a href="../">Tutorials</a>'; //breadcrumb data

switch ($_GET["section"]) { //appends title of the page based on GET variable
	case "ownership":
		$title.=", Ownership";
		$breadcrumbs[2]='Ownership';
		$locnav[1] = '<a '.$style.' href="?section=ownership">Ownership</a>';
		break;
	case "permissions":
		$title.=", Permissions";
		$breadcrumbs[2]="Permissions";
		$locnav[2] = '<a '.$style.' href="?section=permissions">Permissions</a>';
		break;
	case "chmod":
		$title.=", Chmod";
		$breadcrumbs[2]="Chmod";
		$locnav[3] = '<a '.$style.' href="?section=chmod">Chmod</a>';
		break;
	case "num_permissions":
		$title.=", Numeric Permissions";
		$breadcrumbs[2]="Numeric Permissions";
		$locnav[4] = '<a '.$style.' href="?section=num_permissions">Numeric Permissions</a>';
		break;
	case "activity":
		$title.=", Permissions Activity";
		$breadcrumbs[2]="Permissions Activity";
		$locnav[5] = '<a '.$style.' href="?section=activity">Permissions Activity</a>';
		break;
	case "uploading":
		$title.=", Uploading Files";
		$breadcrumbs[2]="Uploading Files";
		$locnav[6] = '<a '.$style.' href="?section=uploading">Uploading Files</a>';
		break;
	case "quiz":
		$title.=", Quiz";
		$breadcrumbs[2]="Quiz";
		$locnav[7] = '<a '.$style.' href="?section=quiz">Internet Concerns Quiz</a>';
		break;
} //end switch statement for page title

	if (isset($breadcrumbs[2])){
		$breadcrumbs[1] = '<a href="?">Internet Concerns</a>'; //breadcrumb is link if [2] is set
	}else {
		$breadcrumbs[1] = 'Internet Concerns'; //breadcrumb if its the last in string
	}


include("../../header.php");

switch ($_GET["section"]) { 
	case "ownership":
		include ("ownership.php");
		break;
	case "permissions":
		include ("permissions.php");
		break;
	case "chmod":
		include ("chmod.php");
		break;
	case "num_permissions":
		include ("num_permissions.php");
		break;
	case "uploading":
		include("uploading.php");
		break;
	case "quiz":
		include ("quiz.php");
		break;
	case "activity":
		include ("permissions_activity.php");
		break;
	default:
		include ("default.php");
} 

include("../../footer.php"); ?>