<?php
//vote class for poll
class Vote 
{
	private $pollToVoteOn;
	private $questionID;
	private $choice;
	private $vote;
	private $votes = Array();
	private $choices = Array();
	
	public function __construct() 
	{
		$this->pollToVoteOn = $_GET['poll'];
		$this->choice = $_GET['choice'];
	}
	function tallyVote() 
	{		
		//Connect to the database
		include('../../db.php');
		
		//Get the questionID from the question table
		$sql = "SELECT * FROM `questions` WHERE `category` = '$this->pollToVoteOn';";
		if ($result = $mysqli->query($sql)) 
		{
			if ($result->num_rows > 0)
			{
				while ($row = $result->fetch_object())
				{
					$this->questionID = $row->ID;
				}
			}
		}
		else
		{
			echo "there was an error from MySQL: " . $mysqli->error;
		}
		
		//Put the votes and the choices into 2 arrays
		$sql = "SELECT * FROM `choices` WHERE `Qid` = '$this->questionID';";
		if ($result = $mysqli->query($sql)) 
		{
			if ($result->num_rows > 0)
			{
				while ($row = $result->fetch_object())
				{
					$this->votes[] = $row->votes;
					$this->choices[] = $row->choice;
				}
			}
		}
		else
		{
			echo "there was an error from MySQL: " . $mysqli->error;
		}
		
		//Add one to the votes
		$newVote = strval((int)$this->votes[$this->choice] + 1);
		
		//Write to db.
		$sql = "UPDATE `choices` SET `votes` = " . $newVote . " WHERE `Qid` = " . $this->questionID . " AND `choice` = '" . $this->choices[$this->choice] . "';";
		$mysqli->query($sql);
		$mysqli->close();
	}
}
?>