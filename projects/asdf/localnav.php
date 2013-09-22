<div id="navmenu-container">

<?php
if($locnav)
{

	echo '<div id="navmenu">
		<!--<img src="'.$page.'images/localtop.jpg" alt="localtop" />-->
		<ul><li class="localnav_first">'.$locnav[0].'</li>';
		
		$totalLinks = sizeof($locnav) - 1;
	
		for($counter=1;$counter<=$totalLinks;$counter++)
		{
			echo '<li>'.$locnav[$counter].'</li>';
		}
	
	echo'</ul>
	</div>
	
	<div style="clear: both;">
		<img src="'.$page.'images/localbot.png" alt="localbot" />
	</div>';
	
	if (!isset($error_page_true)){ //display the notes if we are not on a 404 or 403 error page
		include ("notes/note_box.php"); //display the notes box
	}
}
?>

</div><!--navemenu-container-->
<div id="content">
<img src="<?php echo $page ?>images/curve.png" alt="curve" style="position:relative;top:5px;left:-20px;" />