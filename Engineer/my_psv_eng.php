<?php 
    session_start();
    $engineerID=$_SESSION["engineerID"];
    $first_name=$_SESSION["first_name"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Problem-Solving Videos page" />
		<meta name="keywords"    content="My Problem-Solving Videos" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/mypsv_style.css">
        
        <title>EngineRay | My Problem-Solving Videos</title>
    
    </head>
    <body>
        <header>
            <div class="logo">
                <a href="dash_eng.php"><img src="images/logo.png" alt="EngineRay Logo"></a>
            </div>
            <div class="user-info">
                <?php $first_name;?>
                <a href="notification_eng.php" class="notification"><i class="fas fa-bell"></i></a>
                <a href="settings.php" class="settings"><i class="fas fa-cog"></i></a>
                <form action="logout.php" method="POST">
                    <button type="submit" class="logout" name="logout">Logout</button>
                </form>
            </div>
        </header>

        <nav class="topnav">
            <ul>
                <li><a href="my_profile_eng.php">My Profile</a></li>
                <li><a href="dkm_eng.php">Domain Knowledge Metrics</a></li>
                <li><a href="my_interviews_eng.php">My Interviews</a></li>
                <li><a href="my_offers_eng.php">My Offers</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
            </ul>
        </nav>

        <div class="row">
            <div class="sidenav">
                <a target="_top" href="dkm_eng.php">Domain Knowledge Metrics</a><br/>
                <!--<a target="_top" href="my_personality_test_eng.php">My Personality Test</a><br/> -->
                <a class="active" target="_top" href="my_psv_eng.php">My Problem-Solving Videos</a><br/>
                <a target="_top" href="take_a_psv_eng.php">Record A Problem-Solving Video</a><br/>
            </div> 

            <div class="content">
                <h1 class="content"> My Problem-Solving Videos </h1>
                <p class="content">You will need to complete at least 2 problem-solving videos before applying for a mock interview.</p>
                <br/>
                
                <?php
							require_once "dbh.inc.php";
		
							$sql = "SELECT * FROM psv WHERE engineerID='$engineerID';";
							$result = mysqli_query($dbConnect, $sql);
							$row=mysqli_fetch_assoc($result);
							
							if($row==0){
								echo "<h1>Ah-Oh! You don't have any problem-solving videos yet.</h1>";
							}else{
                                $i=0;
                                echo "<div class='videos'>";
                                while($row){
                                    $link=$row['psv_link'];
								    echo "<video width='330' height='240' controls='controls' style='margin:2.5px'>";
                                    echo "<source src='$link' type='video/mp4'>";
                                    echo " Sorry, your browser doesn't support the video element.";
                                    echo "</video>";

                                    $i++;
                                    $row=mysqli_fetch_assoc($result);
                                }
								echo "</div>";
							}

							mysqli_close($dbConnect);

						?>
                </div>
            </div>
        </div>
        
        <!-- <div class="footer">
            
        </div> -->

    </body>
</html>