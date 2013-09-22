<?php
	$pageTitle = "Transformers 2 | Site Comments";
	$thisPage = "comment/comment.php";
	include ('../header.php');
?>
<style type="text/css">
<!--
/* Page Specific CSS */
.error {
	color: red;
	display: none;
}

#commentsTable {
	position: relative;
	left: 80px;
	width: 700px;
	background: #333;
}
#commentsTable th {
	background: url(../images/tableheader.gif) repeat-x;
}
#commentsTable td {
	background: #999;
	padding: 7px;
	border: 2px solid #000;
}
-->
</style>
<script type="text/javascript">
//<![CDATA[
	function Validate()
	{
		//Display both the stars and bad data if not all the informatino is entered
		var value = true;
		
		if(document.forms[0].elements[0].value == "")
		{
			document.getElementById('nameStar').style.display = "";
			value = false;
		}
		else
		{
			document.getElementById('nameStar').style.display = "none";
		}
		
		//Text area
		if(document.forms[0].elements[1].value == "")
		{
			document.getElementById('commentStar').style.display = "";
			value = false;
		}
		else
		{
			document.getElementById('commentStar').style.display = "none";
		}
		
		return value;
	}
	function hi()
	{
		alert("waddup");
	}
	
//]]>
</script>
<?php
	$page = "comments";
	include('../nav.php');
?>
<div id="content">
	<?php
		//CONNECT TO DATABASE
		include('dbInfo.php');
		
		
		//GET DATA FROM THE DATABASE
		//LEAVE OUT THE ID
		$query = "SELECT `name`, `comment` FROM `comments`";
		$res = mysql_query($query);
		
		//IF THE AFFECTED ROWS IS ZERO, THERE ARE NO RECORDS
		if(mysql_num_rows($res) == 0)
		{
			echo "no records found";	
		}
		else
		{
			//TURN INTO A 2D ARRAY
			if($res) //IF THERE IS A RESULT
			{
				while($row = mysql_fetch_array($res, MYSQL_ASSOC)) //WHILE THERE IS STILL A ROW, PUT IT INTO AN ARRAY
				{
					$records[] = $row;
				}
			}
		}
		//CLOSE CONNECTION
		mysql_close($dbLink);
		?>
        
        
    <h2>Site Comments</h2>
    <?php 
	if($_GET['success'] == 1)
	{
		echo '<h2>Comment Entered!</h2>';
	}
	else if(!$_GET['success'])
	{
		echo '<p>Want to leave a comment about this website? Go for it!</p>
		<br />
		<form action="writedb.php" method="get" onsubmit="return Validate();">
			<p>
				Name: <input type="text" name="name" maxlength="20" /> <span id="nameStar" style="color: red; display: none;">*</span>
				<br />
				<br />
				Comment: <span id="commentStar" style="color: red; display: none;">*</span>
				<br />
				<textarea id="textArea" rows="4" cols="50" name="thecomment"></textarea>
				<br />
				<input type="submit" value="Submit your comment!" />
				<input type="reset" value="Reset" />
			</p>
    	</form>
		<br />
		<br />'
		;
	}
	?>
    
    <?php
		//PRINT DATA FROM DATABASE
		$result = '<table id="commentsTable"><tr>';
		//GIVES THE TABLE A TABLE HEADER
		$result .= '<th>Name</th>';
		$result .= '<th>Comment</th>';
		/*foreach($records[0] as $index => $val)
		{
			$result .= "<th>".$index."</th>";
		}*/
		$result .= '</tr>';
		foreach($records as $curRecord)
		{
			$result .= '<tr>';
			foreach($curRecord as $index => $val)
			{
				$result .= '<td>' . $val . '</td>';
			}
			$result .= '</tr>';
		}
		$result .= '</table>';
		echo $result;
		
		?>
    
</div>
<!-- End content -->
<?php
	include('../footer.php');
?>