<?php 
   session_start();
   $engineerID=$_SESSION["engineerID"];
   $first_name=$_SESSION["first_name"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Personality Test page" />
		<meta name="keywords"    content="My Personality Test" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/personalityTest_style.css">
        
        <title>EngineRay | My Personality Test</title>
    
    </head>
    <body>
        <header>
            <div class="logo">
                <a href="dash_eng.php"><img src="images/logo.png" alt="EngineRay Logo"></a>
            </div>
            <div class="user-info">
                <?php echo $first_name;?>
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
                <a class="active" target="_top" href="my_personality_test_eng.php">My Personality Test</a><br/>
                <a target="_top" href="my_psv_eng.php">My Problem-Solving Videos</a><br/>
                <a target="_top" href="take_a_psv_eng.php">Record A Problem-Solving Video</a><br/>
            </div> 

            <div class="content">
                <h1 class="content"> My Personality Test </h1>
                <p class="content">It helps recruiters take a deeper look into your work attitude, professional persona, and suitability for the role and the organisation's culture.</p>

                <div class="cards">
                    <div class="card">
                        <br/>
                        <p>Please be adviced that you can take this test once only.</p>
                        <p>Hit the "Test Now" button below to find out your personality type.<p>
                        
                        <br/>
                        <p><button type="button"  class="startExam" onclick="window.location.href='https://forms.gle/n5AFEKez4pBzRJMW8'"><span>Test Now</span></button></p>
                        <img src="images/personality.png" alt="Personality Test">
                    </div>
                    
                </div>
                
                
            </div>
        </div>
        
        <!-- <div class="footer">
            
        </div> -->

    </body>
</html>