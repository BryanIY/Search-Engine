<?php 
    session_start();
    $engineerID=$_SESSION["engineerID"];
    $first_name=$_SESSION["first_name"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's Record A Problem-Solving Video page" />
		<meta name="keywords"    content="Record A Problem-Solving Video" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/takeApsv_style.css">
        
        <title>EngineRay | Record A Problem-Solving Video</title>
    
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
                <!-- <a target="_top" href="my_personality_test_eng.php">My Personality Test</a><br/> -->
                <a target="_top" href="my_psv_eng.php">My Problem-Solving Videos</a><br/>
                <a class="active" target="_top" href="take_a_psv_eng.php">Record A Problem-Solving Video</a><br/>
            </div> 

            <div class="content">
                <h1 class="content"> Record A Problem-Solving Video </h1>
                <p class="content">Show your problem-solving ability to potential employers.</p>

                <div class="cards">
                    <div class="card">
                        <h1> Please Note:</h1>
                        <br/>
                        <p>You must complete the recording once you have started it. Otherwise it will be canceled and will not be saved.<p>
                        <p>It takes no more than 15 minutes to complete the recording.</p>
                        <p>You are not allow to choose the question.</p>
                        <p>Please click the "Start" button which will redirect you to a new page and start recording automatically.</p>
                        <br/>
                        <p><button type="button"  class="recording" onclick="window.location.href='https://clipchamp.com/en/screen-recorder/'"><span>Start</span></button><p>
                        <img src="images/takeApsv.jpg" alt="Record A Problem-Solving Video">
                    </div>
                    
                </div>
                
                
            </div>
        </div>
        
        <!-- <div class="footer">
            
        </div> -->

    </body>
</html>