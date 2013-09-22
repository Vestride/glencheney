<?php 
$locnav = array("Site Map");
$title = "Site Map"; //page title
$breadcrumbs[0] = "Site Map"; //breadcrumb data
include("header.php");//include header
?>
<div style="width:400px;float:left;">
	<h4><a href="tutorials">Tutorials</a></h4>
	<ul>
		<li><h4><a href="tutorials/logging_in">Logging In</a></h4>
			<ul>
				<li><a href="tutorials/logging_in/?tutorial=ftp">FTP</a></li>
				<li><a href="tutorials/logging_in/?tutorial=hosts">Hosts</a></li>
				<li><a href="tutorials/logging_in/?tutorial=quiz">Logging in quiz</a></li>
				<li><a href="tutorials/logging_in/?tutorial=ssh">SSH</a></li>
				<li><a href="tutorials/logging_in/?tutorial=why">Why log in?</a></li>
				<li><a href="tutorials/logging_in/?tutorial=account">Your account</a></li>
				<li><a href="tutorials/logging_in/?tutorial=quiz">Logging In Quiz</a></li>
			</ul>
		</li>	
		<li><h4><a href="tutorials/file_management/creation.php">File Creation</a></h4>
			<ul>
				<li><a href="tutorials/file_management/creation.php?section=create_directories">Creating directories</a></li>
				<li><a href="tutorials/file_management/creation.php?section=create_files">Creating files</a></li>
				<li><a href="tutorials/file_management/creation.php?section=edit_files">Editing files</a></li>
				<li><a href="tutorials/file_management/creation.php?section=quiz">File creation quiz</a></li>
				<li><a href="tutorials/file_management/creation.php?section=navigate_directories">Navigating directories</a></li>
				<li><a href="tutorials/file_management/creation.php?section=quiz">File Creation Quiz</a></li>
			</ul>
		</li>
		<li><h4><a href="tutorials/file_management/organization.php">File Organization</a></h4>
			<ul>
				<li><a href="tutorials/file_management/organization.php?section=copy_files">Copying files</a></li>
				<li><a href="tutorials/file_management/organization.php?section=delete_files">Deleting files</a></li>
				<li><a href="tutorials/file_management/organization.php?section=quiz">File organization quiz</a></li>
				<li><a href="tutorials/file_management/organization.php?section=move_files">Moving files</a></li>
				<li><a href="tutorials/file_management/organization.php?section=reminders">Reminder Commands</a></li>
				<li><a href="tutorials/file_management/organization.php?section=quiz">File Organization Quiz</a></li>
			</ul>
		</li>

		<li><h4><a href="tutorials/internet_concerns">Internet Concerns</a></h4>
			<ul>
				<li><a href="tutorials/internet_concerns/?section=chmod">Chmod</a></li>
				<li><a href="tutorials/internet_concerns/?section=quiz">Internet concerns quiz</a></li>
				<li><a href="tutorials/internet_concerns/?section=num_permissions">Numeric permissions</a></li>
				<li><a href="tutorials/internet_concerns/?section=permissions">Permissions</a></li>
				<li><a href="tutorials/internet_concerns/?section=ownership">Ownership</a></li>
				<li><a href="tutorials/internet_concerns/?section=uploading">Uploading files</a></li>
				<li><a href="tutorials/internet_concerns/?section=quiz">Internet Concerns Quiz</a></li>
			</ul>
		</li>
	</ul>
</div>

<div style="margin-left:10px;width:300px;display:inline;float:left;">
	<h4>History</h4>
	<ul>
		<li><a href="history/?page=birth">The Birth of UNIX</a></li>
		<li><a href="history/?page=evolution">The Evolution of UNIX</a></li>
	</ul>
	
	<h4>About</h4>
	<ul>
		<li><a href="about.php">About us</a></li>
		<li><a href="contact.php">Contact us</a></li>
	</ul>
	
	<h4><a href="resources">Resources</a></h4>
	<ul>
		<li><a href="resources/?resource=qkref">Quick reference guide</a></li>
		<li><a href="resources/?resource=books">Recommended reading</a></li>
		<li><a href="resources/?resource=online">Advanced online guides</a></li>
		<li><a href="resources/?resource=programs">Programs</a></li>
	</ul>
	
	<h4>Quizzes</h4>
	<ul>
		<li><a href="tutorials/logging_in/?tutorial=quiz">Logging In</a></li>
		<li><a href="tutorials/file_management/creation.php?section=quiz">File Creation</a></li>
		<li><a href="tutorials/file_management/organization.php?section=quiz">File Organization</a></li>
		<li><a href="tutorials/internet_concerns/?section=quiz">Internet Concerns</a></li>
	</ul>
</div>
<?php include("footer.php"); ?>