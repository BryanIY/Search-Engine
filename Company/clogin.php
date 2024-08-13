<html>
	<head>
		<title>sign-up as company</title> 
		<link href="https://fonts.googleapis.com/css2?family=Ephesis&family=Lato:wght@100&family=Libre+Baskerville:ital@1&family=Pacifico&display=swap" rel="stylesheet"> 
		<link rel="stylesheet" href="style/clogin.css" />
	</head> 

	<body class="home">
	<section class="signup-form">
		
		<header class="home">
			<div class="header">
				<div><a href="firstpage.php"><img src="image/7.jpeg" alt="Logo" class="logo" /></a></div>
			</div>
		</header>
		
		
		<div class="container">
			<div class="contact-box">
				<div class="left">
					<p class="paragraph0">Welcome Back!</p>
					<p class="paragraph1">Sign in to your account using the form at the right side.</p>
					<p class="paragraph1">Please feel free to reach us anytime if you have any issues
					signing into your account.</p>
				</div>
		
				<form class="right" action="includes/clogin.inc.php" method="post">
					<input class="field" type="text" name="uid" placeholder="Username/Email...."><br/>
					<input class="field" type="password" name="pwd" placeholder="Password...."><br/>
					
					
					<?php
						//Error Message
						if (isset($_GET["error"]))
						{
							if ($_GET["error"] == "emptyinput")
							{
								echo "<p>Fill in all fields!</p>";
							}
							else if ($_GET["error"] == "wronglogin")
							{
								echo "<p>Incorrect login information!</p>";
							}
						}
					?>
					
					<button class="btn" type="submit" name="submit">Log In</button>
					<a href="csignup.php">Create an Account</a>
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