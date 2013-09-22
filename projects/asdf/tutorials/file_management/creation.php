<?php 
if (strpos($_SERVER["HTTP_USER_AGENT"], "Safari") || strpos($_SERVER["HTTP_USER_AGENT"], "MSIE")){
	$style='style="background:#edecc2;width:191px;"';
} else {
	$style='style="background:#edecc2;width:192px;"';
}

$locnav = array('<span>File Creation</span>',
				'<a href="?section=create_directories">Creating Directories</a>',
				'<a href="?section=navigate_directories">Navigating Directories</a>',
				'<a href="?section=create_files">Creating Files</a>',
				'<a href="?section=edit_files">Editing Files</a>',
				'<a href="?section=quiz">File Creation Quiz</a>',
				'<br /><a href="organization.php">Next Tutorial</a>',
				'<a href="../logging_in/index.php">Previous Tutorial</a>');

$title = "File Creation"; //page title
$breadcrumbs[0]='<a href="../../tutorials">Tutorials</a>';
switch ($_GET["section"]) { //appends title of the page based on GET variable
	case "create_directories":
		$title.=", Creating Directories";
		$breadcrumbs[2]="Creating Directories";
		$locnav[1] = '<a '.$style.' href="?section=create_directories">Creating Directories</a>';
		break;
	case "navigate_directories":
		$title.=", Navigating Directories";
		$breadcrumbs[2]="Navigating Directories";
		$locnav[2] = '<a '.$style.' href="?section=navigate_directories">Navigating Directories</a>';
		break;
	case "create_files":
		$title.=", Creating Files";
		$breadcrumbs[2]="Creating Files";
		$locnav[3] = '<a '.$style.' href="?section=create_files">Creating Files</a>';
		break;
	case "edit_files":
		$title.=", Editing Files";
		$breadcrumbs[2]="Editing Files";
		$locnav[4] = '<a '.$style.' href="?section=edit_files">Editing Files</a>';
		break;
	case "quiz":
		$title.=", Quiz";
		$breadcrumbs[2]="Quiz";
		$locnav[5] = '<a '.$style.' href="?section=quiz">File Creation Quiz</a>';
		break;
} //end switch statement for page title
	if (isset($breadcrumbs[2])){
		$breadcrumbs[1] = '<a href="?">File Creation</a>'; //breadcrumb is link if [2] is set
	}else {
		$breadcrumbs[1] = 'File Creation'; //breadcrumb if its the last in string
	}


include("../../header.php");

switch ($_GET["section"]) { //switch statement to choose what content to display
	case "create_directories":
		include ("creation/create_directories.php");
		break;
	case "navigate_directories":
		include ("creation/navigate_directories.php");
		break;
	case "create_files":
		include ("creation/create_files.php");
		break;
	case "edit_files":
		include ("creation/edit_files.php");
		break;
	case "quiz":
		include ("creation/quiz.php");
		break;
	default:
		include ("creation/default.php");
} //end content choosing switch statement

include("../../footer.php"); ?>
