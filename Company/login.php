<?php 
SESSION_START();
include('header.php');
$loginError = '';
if (!empty($_POST['username']) && !empty($_POST['pwd'])) {
	include ('Chat.php');
	$chat = new Chat();
	$user = $chat->loginUsers($_POST['username'], $_POST['pwd']);	
	if(!empty($user)) {
		$_SESSION['username'] = $user[0]['username'];
		$_SESSION['userid'] = $user[0]['userid'];
		$chat->updateUserOnline($user[0]['userid'], 1);
		$lastInsertId = $chat->insertUserLoginDetails($user[0]['userid']);
		$_SESSION['login_details_id'] = $lastInsertId;
		header("Location:index.php");
	} else {
		$loginError = "Invalid username or password!";
	}
}

?>
<title>Engineray Chat System</title>
<?php include('container.php');?>
<div class="container">		
	<h2>Engineray Chat System</h1>		
	<div class="row">
		<div class="col-sm-4">
			<h4>Chat Login:</h4>		
			<form method="post">
				<div class="form-group">
				<?php if ($loginError ) { ?>
					<div class="alert alert-warning"><?php echo $loginError; ?></div>
				<?php } ?>
				</div>
				<div class="form-group">
					<label for="username">User:</label>
					<input type="username" class="form-control" name="username" required>
				</div>
				<div class="form-group">
					<label for="pwd">Password:</label>
					<input type="password" class="form-control" name="pwd" required>
				</div>  
				<button type="submit" name="login" class="btn btn-info">Login</button>
			</form>
			<br>
			<p><b>User</b> : Cody<br><b>Password</b> : 123</p>
			<p><b>User</b> : Engineray Support man<br><b>Password</b> : 123</p>
			<p><b>User</b> : Engineray Support man2<br><b>Password</b>: 123</p>
			<p><b>User</b> : Admin<br><b>Password</b>: 123</p>
		</div>
		
	</div>
</div>	
<?php include('footer.php');?>






