<?php
	session_name('monkey');
	session_start();
	
	include('Login.php');
	include('AddTopic.php');
	include('AddQuestion.php');
	
	$state = $_GET['state'];
	
	if ($state == 'login')
	{
		$loginObj = new Login();
		//echo $loginObj->displayLogin();
	}
	else if ($state == 'addtopic')
	{
		$addtopicObj = new AddTopic();
		$addtopicObj->addToDatabase();
	}
	else if ($state == 'addquestion')
	{
		$addquestionObj = new AddQuestion();
		$addquestionObj->addToDatabase();
	}

?>