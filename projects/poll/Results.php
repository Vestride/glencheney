<?php
//Results class for poll
class Results 
{
	private $pollToDisplay;
	private $dataFile;
	private $questionFile;
	private $votes = Array();
	private $question = Array();
	
	public function __construct() 
	{
		$this->pollToDisplay = $_GET['poll'];
		$this->dataFile = "data/" . $this->pollToDisplay . ".txt";
		$this->questionFile = "questions/" . $this->pollToDisplay . ".txt";
	}
	function getResults() 
	{		
		//Read in the votes
		//Trim white space
		//echo back to flash in (xml?)
		
		//Read in the votes
		$this->votes = file($this->dataFile);
		//Read in the question
		$this->question = file($this->questionFile);
		
		//Trim whitespace for votes
		foreach($this->votes as $id=>$value)
		{
			$this->votes[$id] = trim($value);
		}
		//Trim whitespace for question
		foreach($this->question as $id=>$value)
		{
			$this->question[$id] = trim($value);
		}
		
		//Create the XML to give to flash with the votes as an attribute
		$questionXML = "<poll>\n";
		for ($i = 0; $i < count($this->question); $i++)
		{
			if ($i == 0)
			{
				$questionXML .= "<question>" . $this->question[$i] . "</question>\n";
			}
			else
			{
				$questionXML .= '<choice votes="' . $this->votes[$i-1] . '">' . $this->question[$i] . "</choice>\n";
			}
		}
		$questionXML .= "</poll>";
		return $questionXML;
	}
}


?>