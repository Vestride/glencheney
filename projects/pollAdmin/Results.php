<?php
//Results class for poll
class Results 
{
	private $pollToDisplay;
	private $choices = Array();
	private $votes = Array();
	private $question;
	private $questionID;
	
	public function __construct() 
	{
		$this->pollToDisplay = $_GET['poll'];
	}
	function getResults() 
	{		
		//Read in the votes
		//echo back to flash in xml
		
		include('../../db.php');
		
		//Get the question
		$sql = "SELECT * FROM `questions` WHERE `category` = '" . $this->pollToDisplay . "';";
		if($result = $mysqli->query($sql))
		{
			if($result->num_rows > 0)
			{
				while($row = $result->fetch_object())
				{
					$this->question = $row->question;
					$this->questionID = $row->ID;
				}
			}
		}
		
		//Get the choices and votes
		$sql = "SELECT * FROM `choices` WHERE `Qid` = '" . $this->questionID . "';";
		if($result = $mysqli->query($sql))
		{
			if($result->num_rows > 0)
			{
				while($row = $result->fetch_object())
				{
					$this->choices[] = $row->choice;
					$this->votes[] = $row->votes;
				}
			}
		}
		$mysqli->close();
		
		//Create the XML to give to flash with the votes as an attribute
		$questionXML = "<poll>\n";
		$questionXML .= "<question>" . $this->question . "</question>\n";
		for ($i = 0; $i < count($this->choices); $i++)
		{
			$questionXML .= '<choice votes="' . $this->votes[$i] . '">' . $this->choices[$i] . "</choice>\n";
		
		}
		$questionXML .= "</poll>";
		return $questionXML;
	}
}


?>