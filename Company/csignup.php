

<html>
	<head>
		<title>sign-up as company</title> 
		<link href="https://fonts.googleapis.com/css2?family=Ephesis&family=Lato:wght@100&family=Libre+Baskerville:ital@1&family=Pacifico&display=swap" rel="stylesheet"> 
		<link rel="stylesheet" href="style/csignup.css" />
		
	</head> 
	
	<body class="home">
	<section class="signup-form">
		
		<header class="home">
			<div class="header">
				<div><a href="firstpage.php"><img src="image/7.jpeg" alt="Logo" class="logo" /></a></div>
				<div><a href="login.php" class="login">Log-in</a></div><br/>
			</div>
		</header>
		
		<div class="container">
			<div class="contact-box">
				<div class="left"></div>
				<form class="right" action="includes/csignup.inc.php" method="post">
					<h2>Company Sign-Up</h2>
					<input type="text" class="field" name="cname" placeholder="Company Name...."><br/>
					<input type="text" class="field" name="email" placeholder="Email...."><br/>
					<input type="text" class="field" name="uid" placeholder="Username...."><br/>
					<input type="password" class="field" name="pwd" placeholder="Password...."><br/>
					<input type="password" class="field" name="pwdrepeat" placeholder="Repeat password...."><br/><br/>	

		
		<?php
		//Error Message
		if (isset($_GET["error"]))
		{
			if ($_GET["error"] == "emptyinput")
			{
				echo "<p>Fill in all fields!</p>";
			}
			else if ($_GET["error"] == "invaliduid")
			{
				echo "<p>Choose a proper username!</p>";
			}
			else if ($_GET["error"] == "invalidemail")
			{
				echo "<p>Choose a proper email!</p>";
			}
			else if ($_GET["error"] == "passwordsnotmatch")
			{
				echo "<p>Password does not match!</p>";
			}
			else if ($_GET["error"] == "passwordsnotmatch")
			{
				echo "<p>Password does not match!</p>";
			}
			else if ($_GET["error"] == "usernametaken")
			{
				echo "<p>Username already taken. Try again!</p>";
			}
			else if ($_GET["error"] == "stmtfailed")
			{
				echo "<p>Something went wrong, try again!</p>";
			}
			else if ($_GET["error"] == "none")
			{
				echo "<p>You have successfully signed up!</p>";
			}
		}
		
		?>
					<button class="btn" type="submit" name="submit">Sign Up</button>
				</form>
			</div>
		</div>
		
		
	</section>
	
	</div class="section1">
			<figure class="image-section">
					<img src="image/11.png" alt="image"/>
			</figure>
			<p class="paragraph2">©2023 Engineray Inc.</p>
			
		</div>
	
	</body>
	
</html>

