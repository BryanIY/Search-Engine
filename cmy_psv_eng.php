<?php 
    require_once "includes/dbh.inc.php";
    $engineer = $_GET["uengineerID"];
    $engineerID = intval($engineer);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Problem-Solving Videos page" />
		<meta name="keywords"    content="My Problem-Solving Videos" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style/mypsv_style.css">
        
        <title>EngineRay | My Problem-Solving Videos</title>
    
    </head>
    <body>
        <header>
            <div class="logo">
                <a href="findengineers.php"><img src="image/11.png" alt="EngineRay Logo"></a>
            </div>
            <div class="user-info">
                <p class="username"><a href="user_profile.php">Username</a></p>
                <a href="notification_eng.php" class="notification"><i class="fas fa-bell"></i></a>
                <a href="settings.php" class="settings"><i class="fas fa-cog"></i></a>
                <!-- <form action="logout.php" method="POST">
                    <button type="submit" class="logout" name="logout">Logout</button>
                </form> -->
            </div>
        </header>

        <nav class="topnav1">
            <ul>
                <li><a href="findengineers.php">Find Engineers</a></li>
                <li><a href="mycandidates.php">My Candidates</a></li>
                <li><a href="hiredengineers.php">Hired Engineers</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
            </ul>
        </nav>

        <nav class="topnav">
            <ul>
                <li><a href="cmy_profile_eng.php?uengineerID=<?php echo $engineerID ?>">Engineer's Profile</a></li>
                <li><a href="cdkm_eng.php?uengineerID=<?php echo $engineerID ?>">Domain Knowledge Metrics</a></li>
                <li><a href="cmy_mock_interviews_eng.php?uengineerID=<?php echo $engineerID ?>">Engineer's Interviews</a></li>
                <!-- <li><a href="my_offers_eng.php">My Offers</a></li>
                <li><a href="contactus.php">Contact Us</a></li> -->
            </ul>
        </nav>

        <div class="row">
            <div class="sidenav">
                <a target="_top" href="cdkm_eng.php?uengineerID=<?php echo $engineerID ?>">Domain Knowledge Metrics</a><br/>
                <!-- <a target="_top" href="my_personality_test_eng.php">My Personality Test</a><br/> -->
                <a class="active" target="_top" href="cmy_psv_eng.php?uengineerID=<?php echo $engineerID ?>">Problem-Solving Videos</a><br/>
                <!-- <a target="_top" href="ctake_a_psv_eng.php?uengineerID=<?php //echo $engineerID ?>">Record A Problem-Solving Video</a><br/> -->
            </div> 

            <div class="content">
                <h1 class="content"> Engineer's Problem-Solving Videos </h1>
                <!-- <p class="content">You will need to complete at least 2 problem-solving videos before applying for a mock interview.</p> -->
                <br/>
                
                <?php
							require_once "includes/dbh.inc.php";
		
							$sql = "SELECT * FROM psv WHERE engineerID='$engineerID';";
							$result = mysqli_query($conn, $sql);
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

							mysqli_close($conn);

						?>
                </div>
            </div>
        </div>
        
        <!-- <div class="footer">
            
        </div> -->

    </body>
</html>