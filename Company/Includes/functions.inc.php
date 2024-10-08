<?php
	
	//Signup Function
	function emptyInputSignup($cname, $email, $username, $pwd, $pwdrepeat)
	{
		$result;
		if (empty($cname) || empty($email) || empty($username) || empty($pwd) || empty($pwdrepeat)) 
		{
			$result = true;
		}
		else
		{
			$result = false;
		}
		return $result;
	}
	function invalidUid($username)
	{
		$result;
		if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) 
		{
			$result = true;
		}
		else
		{
			$result = false;
		}
		return $result;
	}
	function invalidEmail($email)
	{
		$result;
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			$result = true;
		}
		else
		{
			$result = false;
		}
		return $result;
	}
	function pwdMatch($pwd, $pwdrepeat)
	{
		$result;
		if ($pwd !== $pwdrepeat) 
		{
			$result = true;
		}
		else
		{
			$result = false;
		}
		return $result;
	}
	
	function uidExists($conn, $username, $email)
	{
		$sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
		$stmt= mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql))
		{
			header("location:../csignup.php?error=stmtfailed");
			exit();
		}
			
		mysqli_stmt_bind_param($stmt, "ss", $username, $email);
		mysqli_stmt_execute($stmt);
			
		$resultData = mysqli_stmt_get_result($stmt);
			
		if($row = mysqli_fetch_assoc($resultData))
		{
			return $row;
		}
		else
		{
			$result = false;
			return $result;
		}
		mysqli_stmt_close($stmt);
	}
	
	function createUser($conn, $cname, $email, $username, $pwd)
	{
		$sql = "INSERT INTO users (usersname, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
			$stmt= mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql))
			{
				header("location: ../csignup.php?error=stmtfailed");
				exit();
			}
			
			$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
			
			mysqli_stmt_bind_param($stmt, "ssss", $cname, $email, $username, $hashedPwd);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			header("location: ../csignup.php?error=none");
			exit();
	}
	
	//Login function
	function emptyInputLogin($username, $pwd)
	{
		$result;
		if (empty($username) || empty($pwd)) 
		{
			$result = true;
		}
		else
		{
			$result = false;
		}
		return $result;
	}
	
	function loginUser($conn, $username, $pwd)
	{
		$uidExists = uidExists($conn, $username, $username);
		
		if($uidExists === false)
		{
			header("location: ../clogin.php?error=wronglogin");
			exit();
		}
		
		$pwdHashed = $uidExists["usersPwd"];
		$checkPwd = password_verify($pwd, $pwdHashed);
		
		if($checkPwd === false)
		{
			header("location: ../clogin.php?error=wronglogin");
			exit();
		}
		else if ($checkPwd === true)
		{
			session_start();
			$_SESSION["userid"] = $uidExists["usersId"];
			$_SESSION["useruid"] = $uidExists["usersUid"];
			header("location: ../findengineers.php");
			exit();
		}
	}
	
?>