<?php 
echo '<?xml version="1.0" encoding="utf-8"?>';
$page='http://nova.it.rit.edu/~409Dan-asdf/';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASDF Unix Tutorial<?php if ($title) echo ' - '.$title; ?></title>

<?php echo '<link href="'.$page.'style.css" rel="stylesheet" type="text/css" />';
	echo '<link rel="icon" type="image/vnd.microsoft.icon" href="'.$page.'images/favicon.ico" />';
	echo '<link rel="stylesheet" type="text/css" href="'.$page.'quiz/quiz.css" />'; //stylesheet for quiz pages?>
	
	<style type="text/css">
		table {
			background: #ffffff;
		}
		th {
			background: #ffffff;
		}
		td {
			background: #ffffff;
		}
	</style>
</head>

<body style="background:none;">

<h1>Quick Reference Guide</h1>

<p>
<object>
<table style="width:80%" border="1">
<tr><td>.</td><td>Current directory</td></tr>
<tr><td>..</td><td>Parent directory</td></tr>
<tr><td>~</td><td>Home directory.</td></tr>
<tr><td>cat (file name)</td><td>View the contents of the named file.</td></tr>
<tr><td>cat > (file name)</td><td>Create a file.</td></tr>
<tr><td>cat >> (file name)</td><td>Add to the end of the named file.</td></tr>
<tr><td>cd (directory path)</td><td>Move to the named directory.</td></tr>
<tr><td>chmod (###) (file name)</td><td>Change the permissions of the named file.</td></tr>
<tr><td>cp (file1) (file2)</td><td>Copy file1 as file2.</td></tr>
<tr><td>ls</td><td>List the items in the current directory</td></tr>
<tr><td>ls -a</td><td>Show hidden files.</td></tr>
<tr><td>ls -l</td><td>Show additional information for the listed items</td></tr>
<tr><td>man (command)</td><td>Show the full manual file for the command.</td></tr>
<tr><td>mkdir (directory name)</td><td>Make a new directory.</td></tr>
<tr><td>mv (file name) (location)</td><td>Move the file to the specified location.</td></tr>
<tr><td>pico (file name)</td><td>Open the named file in pico.</td></tr>
<tr><td>pwd</td><td>Prints your current directory path.</td></tr>
<tr><td>rm (file name)</td><td>Remove the named file.</td></tr>
<tr><td>rmdir (directory name)</td><td>Remove the named directory.</td></tr>
<tr><td>whatis (command)</td><td>Print a brief summary of the command.</td></tr>
</table>
</object>
</p>

</body>
</html>