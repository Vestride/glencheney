<?php
//vote class for poll
class Vote 
{
	private $pollToVoteOn;
	private $voteFile;
	private $choice;
	private $votes = Array();
	
	public function __construct() 
	{
		$this->pollToVoteOn = $_GET['poll'];
		$this->choice = $_GET['choice'];
		$this->voteFile = "data/" . $this->pollToVoteOn . ".txt";
		
		//var_dump($this->votes);
	}
	function tallyVote() 
	{		
		//For some reason, it doesn't like the { after the if statement...
		//if(file_exists($this->voteFile)
		//{
			
		$fh = fopen($this->voteFile, "r");
		flock($fh, LOCK_EX);
		$this->votes = file($this->voteFile);
		fclose($fh);
		
		//Trim whitespace
		foreach($this->votes as $id=>$value)
		{
			$this->votes[$id] = trim($value);
		}
		
		//Add one to the vote count and convert back to a string
		$this->votes[$this->choice - 1] = strval($this->votes[$this->choice - 1] + 1);
		
		//Convert array to string with line breaks
		$newVotes = implode("\n",$this->votes);
		
		//Open the file to write
		$fh = fopen($this->voteFile, "w");
		
		//overwrite if it exists and create new file if it doesn't
		if($fh) 
		{
			fwrite($fh, $newVotes);
			flock($fh, LOCK_UN);//release the lock on file
			fclose($fh);
		} 
		else 
		{
		  echo "<br /> can't open the file to write <br />\n";
		}
		//}
	}
}
?>