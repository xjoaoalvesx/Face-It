<?php
	
	include_once('../database/client/get_client.php');

	if(isset($_POST['register-submit'])){

		$username = $_POST['uid'];
		$password = $_POST['pw'];
		$userMail = $_POST['mail'];


		if(empty($username) || empty($password)|| empty($userMail)){
			header("Location: login.php?error=emptyfields&username=".$username."&mail=".$userMail);
			exit();
		}

		else if(!filter_var($userMail, FILTER_VALIDATE_EMAIL)){
			header("Location: login.php?error=invalidmail&username=".$username);
			exit();
		}

		else if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
			header("Location: login.php?error=invalidusername&mail=".$userMail);
			exit();
		}

		else{

			if(checkUsername($username)){
				header("Location: login.php?error=usertaken&mail=".$userMail);
				exit();
			}
			else{
				insertClient($username, $password, $userMail);
				header("Location: login.php?signup=success");
				exit();
			}
		}

	}

	else {
		header("Location: login.php");
		exit();
	}



?>	