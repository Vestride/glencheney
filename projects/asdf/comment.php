<?php 
$locnav = array("Feedback");
$title = "Feedback"; //page title
$breadcrumbs[0] = "Feedback"; //breadcrumb data
include("header.php"); ?>
<script type="text/javascript">
//<![CDATA[
	function Validate()
	{
		//Display both the stars and bad data if not all the information is entered
		var value = true;
		
		if(document.forms[2].elements[0].value == "")
		{
			document.getElementById('nameStar').style.display = "";
			value = false;
		}
		else
		{
			document.getElementById('nameStar').style.display = "none";
		}
		
		//Text area
		if(document.forms[2].elements[1].value == "")
		{
			document.getElementById('commentStar').style.display = "";
			value = false;
		}
		else<a href="about.php"></a>
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
		/*
		include('../dbconnect.php');
		
		////////// User data has been sanitized.
		
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
		mysql_close($dbconnect);
		*/
		?>
        
        
    <h2>Site Comments have been disabled, sorry</h2>
    <?php /*
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
		$result = '<table><tr>';
		//GIVES THE TABLE A TABLE HEADER
		$result .= '<th style="width:5em;">Name</th>';
		$result .= '<th>Comment</th>';
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
		*/
		?>
    <br />
<?php include("footer.php"); ?>