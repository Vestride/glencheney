<?php
//question class for poll
class Question 
{
	private $specificQuestion;
	private $questionFile;
	private $lines = Array();
	
	public function __construct() 
	{
		$this->specificQuestion = $_GET['poll'];
		$this->questionFile = "questions/" . $this->specificQuestion . ".txt";
		$this->lines = file($this->questionFile);
	}
	function getQuestionXML() 
	{
		$questionXML = "<poll>\n";
		foreach($this->lines as $line)
		{
			//If it's the first line
			if ($line == $this->lines[0])
			{
				$questionXML .= "<question>" .rtrim($line) . "</question>\n";
			}
			else
			{
				$questionXML .= "<choice>" . rtrim($line) . "</choice>\n";
			}
		}
		$questionXML .= "</poll>";
		return $questionXML;
	}
}
?>