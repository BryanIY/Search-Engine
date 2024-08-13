<style>
*{
	box-sizing:border-box;
}
body {
	margin: 0;
	padding: 0;
	font-family: Arial, sans-serif;
}
header {
	display: flex;
	align-items: center;
	height: 80px;
	background-color: white;
	color: black;
	padding: 0 20px;
}
.logo img {
    margin-top:10px;
	height: 50px;
}
.user-info {
	margin-left: auto;
	display: flex;
	align-items: center;
}
.user-info p {
	margin: 0;
	margin-right: 20px;
}
.notification, .settings {
	color: #fff;
	text-decoration: none;
	margin-left: 20px;
}
/*Top nav bar*/
.topnav {
	background-color:#0693E3;
}
.topnav ul {
	list-style-type: none;
	margin: 0;
	padding: 0;
	display: flex;
	justify-content: center;
}
.topnav li {
	margin-right: 20px;
    display:inline-block;
}
.topnav li:last-child {
	margin-right: 0;
}
.topnav a {
	display: block;
	padding: 25px 20px;
	color: white;
	text-decoration: none;
    text-align:center;
    font-size:23px;
    font-weight:bold;
}
.topnav a:hover {
	background-color: #ccc;
    color:black;
    text-transform:uppercase;
}
</style>

<head>

</head>
<body class="">
<header> <!-- at the top of the username logout things -->
		<div class="logo">
			<a href="findengineers.php"><img src="image/11.png" alt="EngineRay Logo"></a>
		</div>
		<div class="user-info">
			<p class="username"><a href="user_profile.php">Username</a></p> 
			<a href="notification_eng.php" class="notification"><i class="fas fa-bell"></i></a>
			<a href="settings.php" class="settings"><i class="fas fa-cog"></i></a>
            </div>
        </header>
        
        <!-- navigation -->
        <nav class="topnav">
            <ul>
                <li><a href="findengineers.php">Find Engineers</a></li>
                <li><a href="mycandidates.php">My Candidates</a></li>
                <li><a href="hiredengineers.php">Hired Engineers</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
            </ul>
        </nav>
         
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div class="container" style="min-height:500px;">
	<div class=''>
	</div>