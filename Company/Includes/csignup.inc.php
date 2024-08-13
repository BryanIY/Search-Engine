<?php
	
	if (isset($_POST["submit"]))
	{
		$cname = $_POST["cname"];
		$email = $_POST["email"];
		$username = $_POST["uid"];
		$pwd = $_POST["pwd"];
		$pwdrepeat = $_POST["pwdrepeat"];
		
		require_once 'dbh.inc.php';
		require_once 'functions.inc.php';
		
		if (emptyInputSignup($cname, $email, $username, $pwd, $pwdrepeat)!== false)
		{
			header("location: ../csignup.php?error=emptyinput");
			exit();
		}
		if (invalidUid($username)!== false)
		{
			header("location: ../csignup.php?error=invaliduid");
			exit();
		}
		if (invalidEmail($email)!== false)
		{
			header("location: ../csignup.php?error=invalidemail");
			exit();
		}
		if (pwdMatch($pwd, $pwdrepeat)!== false)
		{
			header("location: ../csignup.php?error=passwordsnotmatch");
			exit();
		}
		if (uidExists($conn, $username, $email)!== false)
		{
			header("location: ../csignup.php?error=usernametaken");
			exit();
		}
		
		createUser($conn, $cname, $email, $username, $pwd);
		
	}
	else
	{
		header("location:../csignup.php");
		exit();
	}


?>