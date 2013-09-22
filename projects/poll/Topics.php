<?php
//topics class for poll
class Topics 
{
	private $topicsString;
	private $topicsFile;
	private $topicsData = Array();
	
	public function __construct($aFile) 
	{
		$this->topicsFile = $aFile;
		$this->topicsData = file($this->topicsFile);
		//var_dump($this->topicsData);
	}
	function getTopicsXML() 
	{
		$topicsXML = "<polls>\n";
		foreach($this->topicsData as $oneTopic)
		{
			$topicsXML .= '<topic category="' . rtrim($oneTopic) . "\" />\n";
			
		}
		$topicsXML .= "</polls>";
		return $topicsXML;
	}
}
?>
