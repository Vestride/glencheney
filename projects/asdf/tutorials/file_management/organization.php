<?php 
if (strpos($_SERVER["HTTP_USER_AGENT"], "Safari") || strpos($_SERVER["HTTP_USER_AGENT"], "MSIE")){
	$style='style="background:#edecc2;width:191px;"';
} else {
	$style='style="background:#edecc2;width:192px;"';
}

$locnav = array('<span>File Organization</span>',
				'<a href="?section=copy_files">Copying Files</a>',
				'<a href="?section=move_files">Moving Files</a>',
				'<a href="?section=delete_files">Deleting Files</a>',
				'<a href="?section=reminders">Reminder Commands</a>',
				'<a href="?section=quiz">File Organization Quiz</a>',				
				'<br /><a href="../internet_concerns/">Next Tutorial</a>',
				'<a href="creation.php">Previous Tutorial</a>');


$title = "File Ogranization"; //page title
$breadcrumbs[0]='<a href="../../tutorials">Tutorials</a>';
switch ($_GET["section"]) { //appends title of the page based on GET variable
	case "copy_files":
		$title.=", Copying Files";
		$breadcrumbs[2]="Copying Files";
		$locnav[1] = '<a '.$style.' href="?section=copy_files">Copying Files</a>';
		break;
	case "move_files":
		$title.=", Moving Files";
		$breadcrumbs[2]="Moving Files";
		$locnav[2] = '<a '.$style.' href="?section=move_files">Moving Files</a>';
		break;
	case "delete_files":
		$title.=", Deleting Files";
		$breadcrumbs[2]="Deleting Files";
		$locnav[3] = '<a '.$style.' href="?section=delete_files">Deleting Files</a>';
		break;
	case "reminders":
		$title.=", Reminder Commands";
		$breadcrumbs[2]="Reminder Commands";
		$locnav[4] = '<a '.$style.' href="?section=reminders">Reminder Commands</a>';
		break;
	case "quiz":
		$title.=", Quiz";
		$breadcrumbs[2]="Quiz";
		$locnav[5] = '<a '.$style.' href="?section=quiz">File Organization Quiz</a>';
		break;
} //end switch statement for page title

	if (isset($breadcrumbs[2])){
		$breadcrumbs[1] = '<a href="?">File Organization</a>'; //breadcrumb is link if [2] is set
	}else {
		$breadcrumbs[1] = 'File Organization'; //breadcrumb if its the last in string
	}

include("../../header.php");

switch ($_GET["section"]) { //switch statement to choose what content to display
	case "copy_files":
		include ("organization/copy_files.php");
		break;
	case "move_files":
		include ("organization/move_files.php");
		break;
	case "delete_files":
		include ("organization/delete_files.php");
		break;
	case "reminders":
		include ("organization/reminders.php");
		break;
	case "quiz":
		include ("organization/quiz.php");
		break;
	default:
		include ("organization/default.php");
} //end content choosing switch statement

include("../../footer.php"); ?>
