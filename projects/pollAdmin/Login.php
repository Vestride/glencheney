<?php
class Login
{
	//Instance variables
	
	public function __construct()
	{
		if(isset($_GET['username']) && isset($_GET['password']))
		{
			//Get password from database
			include("../../db.php");
			$sql = "SELECT `password` FROM `users` WHERE `username` = '" . $_GET['username'] . "';";
			if($result = $mysqli->query($sql))
			{
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_object())
					{
						$thePassword = $row->password;
					}
				}
			}
			//Compare given password with one from database
			if($_GET['password'] == $thePassword)
			{
				$_SESSION['username'] = $_GET['username'];
				$_SESSION['password'] = $_GET['password'];
				$_SESSION['login'] = true;
				echo 'true';
			}
			else
			{
				//Redo login
				echo 'false';
			}
		}
		
	}
}
?>