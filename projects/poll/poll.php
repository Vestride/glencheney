<?php
	include('Topics.php');
	include('Question.php');
	include('Vote.php');
	include('Results.php');
	
	//entry point for poll.php  acts like a dispatcher
	//$questionFile = "questions.txt";
	$topicsFile = "topics.txt";
	$state = $_GET['state'];
	
	if($state=="start") 
	{
		//return the xml for a list of topics
		$topicsObj = new Topics($topicsFile);
		echo $topicsObj->getTopicsXML();
	} 
	else if ($state=="poll") 
	{
		//return the xml for a specific poll
		$questionObj = new Question();
		echo $questionObj->getQuestionXML();
	}
	else if ($state=="vote") 
	{
		//tabulate the vote for the specified poll
		$voteObj = new Vote();
		$voteObj->tallyVote();
		
		//Send results information
		$resultsObj = new Results();
		echo $resultsObj->getResults();
		
	}
	else if ($state=="results") 
	{
		//return the results xml for the specified poll
		$resultsObj = new Results();
		echo $resultsObj->getResults();
	
	}

?>