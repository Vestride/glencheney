<?php
//question class for poll
class Question 
{
	private $specificQuestion;
	private $choices = Array();
	private $question;
	private $questionID;
	
	public function __construct() 
	{
		$this->specificQuestion = $_GET['poll'];
		
		include('../../db.php');
		
		//Get the question
		$sql = "SELECT * FROM `questions` WHERE `category` = '$this->specificQuestion'";
		
		//$sql = "SELECT `question` FROM `questions` WHERE `category` ";
		if ($result = $mysqli->query($sql)) 
		{
			//echo "there were ".$result->num_rows." rows\n";
			if ($result->num_rows > 0)
			{
				while ($row = $result->fetch_object())
				{
					$this->question = $row->question;
					$this->questionID = $row->ID;
					//echo "Question: $this->question\n";
					//echo "ID: $this->questionID";
				}
			}
		}
		else
		{
			echo "there was an error from MySQL: " . $mysqli->error;
		}
		
		//Get the choices
		$sql = "SELECT * FROM `choices` WHERE `Qid` = '$this->questionID'";
		
		//$sql = "SELECT `question` FROM `questions` WHERE `category` ";
		if ($result = $mysqli->query($sql)) 
		{
			//echo "there were ".$result->num_rows." rows\n";
			if ($result->num_rows > 0)
			{
				while ($row = $result->fetch_object())
				{
					$this->choices[] = $row->choice;
					//echo "$this->choices\n";
				}
			}
		}
		else
		{
			echo "there was an error from MySQL: " . $mysqli->error;
		}
		
		$mysqli->close();
	}
	function getQuestionXML() 
	{
		$questionXML = "<poll>\n";
		$questionXML .= "<question>" . $this->question . "</question>\n";
		foreach($this->choices as $choice)
		{
			$questionXML .= "<choice>" . $choice . "</choice>\n";
		}
		$questionXML .= "</poll>";
		return $questionXML;
	}
}
?>