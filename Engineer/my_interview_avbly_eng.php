<?php 
    session_start();
    $engineerID=$_SESSION["engineerID"];
    $first_name=$_SESSION["first_name"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Interview Availability page" />
		<meta name="keywords"    content="my available time for mock interviews and interviews" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/myinterviewavbly_style.css">
        
        <title>EngineRay | My Interview Availability</title>
    
    </head>
    <body>
        <?php
            $interview_avbly_err=$interview_avbly=$calendly="";
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                //Fields validation
                if(empty($_POST["interview_avbly"])){
                    $interview_avbly_err="Please choose your interview availability!";
                }else{
                    $interview_avbly=trim($_POST["interview_avbly"]);
                }
            }
            
        ?>
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
                <a target="_top" href="my_interviews_eng.php">My Interviews</a><br/>
                <a target="_top" href="my_mock_interviews_eng.php">My Mock Interviews</a><br/>
                <a class="active" target="_top" href="my_interview_avbly_eng.php">My Interview Aailability</a><br/>
            </div>

            <div class="content">
                <h1 class="content"> My Interview Availability </h1>
                <p class="content">Choose your availability for both mock interviews and job interviews.</p>
                <br/>
                <form method="post" >
                    <h2 class="interview_avbly"><input type="radio" name="interview_avbly" value="unavailable" />I am unavailable to interview at the moment.</h2>
                    <h2 class="interview_avbly"><input type="radio" name="interview_avbly" value="available"/>I am available for any interviews.</h2>
                    <br/>
                    <?php echo $interview_avbly_err;?>
                    <input type="submit" name="update" value="Update My Interview Availability" />
                </form>
              
                <!-- Calendly inline widget begin -->
                <div class="calendly-inline-widget" data-url="https://calendly.com/serena-ian-ng/mock-interview" style="min-width:320px;height:630px;"></div>
                <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
                <!-- Calendly inline widget end -->
    
            </div>
        </div>
        
        <!-- <div class="footer">
            
        </div> -->

    </body>
</html>