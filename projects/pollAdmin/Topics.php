<?php
//topics class for poll
class Topics 
{
	private $topicsData = Array();
	
	public function __construct() 
	{
		include('../../db.php');
		
		$sql = "SELECT `category` FROM `topics`";
		if ($result = $mysqli->query($sql)) 
		{
			//echo "there were ".$result->num_rows." rows\n";
			if ($result->num_rows > 0)
			{
				while ($row = $result->fetch_object())
				{
					$this->topicsData[] = $row->category;
				}
			}
		}
		else
		{
			echo "there was an error from MySQL: " . $mysqli->error;
		}
		$mysqli->close();
		
		//var_dump($this->topicsData);
	}
	function getTopicsXML() 
	{
		$topicsXML = "<polls>\n";
		foreach($this->topicsData as $oneTopic)
		{
			$topicsXML .= '<topic category="' . $oneTopic . "\" />\n";
			
		}
		$topicsXML .= "</polls>";
		return $topicsXML;
	}
}
?>
