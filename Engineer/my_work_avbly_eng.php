<?php
    session_start();
    $engineerID=$_SESSION["engineerID"];
    $first_name=$_SESSION["first_name"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Work Availability page" />
		<meta name="keywords"    content="my work time, work availability" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/myworkavbly_style.css">
        
        <title>EngineRay | My Work Availability</title>
    
    </head>
    <body>
        <?php 
            $work_avbly=$start_date=$err=$workmessage="";

            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!empty($_POST["work_avbly"])){
                    
                    $work_avbly=trim($_POST["work_avbly"]);
                  
                }
                if(!empty($_POST["start_date"])){
                    $start_date=trim($_POST["start_date"]);
                   
                }
            }
            if(isset($_POST["update"])){
                require_once "dbh.inc.php";

                if($work_avbly==""){
                    $err="Please choose your work availability!";
                }elseif($work_avbly=="unavailable"){
                    $sqlstring="UPDATE engineer SET work_avbly='Unavailable', start_date='Unspecified' WHERE engineerID='$engineerID'";
                    $queryResult=@mysqli_query($dbConnect, $sqlstring)
                        or die("<p>Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($dbConnect).": ".mysqli_error($dbConnect)."</p>");
                    $workmessage="You have set your work availability to ' <strong>UNAVAILABLE</strong> '.";
                }else{ //$work_avbly=="ready"
                        if($start_date==""){
                            $err="Please choose your available start date!";
                        }else{
                            $sqlstring="UPDATE engineer SET work_avbly='Available', start_date='$start_date' WHERE engineerID='$engineerID'";
                            $queryResult=@mysqli_query($dbConnect, $sqlstring)
                                or die("<p>Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($dbConnect).": ".mysqli_error($dbConnect)."</p>");
                            $workmessage="You have set your work availability to ' <strong>READY</strong> ' and you can start a remote full-time job after <strong>".$start_date."</strong>.";
                        }
                    }
                
                mysqli_close($dbConnect);
            } 
           
        ?>
        <header>
            <div class="logo">
                <a href="dash_eng.php"><img src="images/logo.png" alt="EngineRay Logo"></a>
            </div>
            <div class="user-info">
                <p class="username"><?php echo $first_name;?></p>
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
                <a target="_top" href="my_profile_eng.php">My Profile</a><br/>
                <a target="_top" href="profile_image_eng.php">My Profile Image</a><br/>
				<a target="_top" href="my_profile_eng.php">My Resume</a><br/>
                <a class="active" target="_top" href="my_work_avbly_eng.php">My Work Availability</a><br/>
            </div> 

            <div class="content">
                <h1 class="content"> My Work Availability </h1>
                <p class="content">Choose your work availability for a remote job offer.</p>
                <?php echo "<h3 style='text-align:center'>".$workmessage."</h3>";?>
                <form method="POST">
                    <div class="cards">
                            <div class="card">
                                    <h2><input type="radio" name="work_avbly" value="ready" /> Ready to work</h2>
                                    <br/>
                                    <p>I am actively looking for a new remote software job.<p>
                                    <p>Mark me available to work for the next 30 days.</p>
                                    <img src="images/readyToWork.png" alt="Ready to work">
                            </div>
                            <div class="card">
                                    <h2><input type="radio" name="work_avbly" value="unavailable" /> Unavailable for work</h2>
                                    <br/>
                                    <p>I am not looking for a new remote software job at the moment.<p>
                                    <img src="images/laterForWork.png" alt="Unavailable for work">
                            </div>
                    </div>
                
                    <p>If you are ready to work, since when can you start working with EngineRay? (Please ignore this if your work availability is unavailable.)</p>        
                    <p>I can start after: <input type="date" name="start_date" /></p>
                    <p style="color:red"><?php echo $err; ?></p>
                    <br/>
                    <input type="submit" name="update" value="Update My Work Availability" />
                </form> 
                
            </div>
        </div>
        
        <!-- <div class="footer">
            
        </div> -->

    </body>
</html>