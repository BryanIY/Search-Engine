<?php 
    session_start();
    $engineerID=$_SESSION["engineerID"];
    $first_name=$_SESSION["first_name"]; 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Interviews page" />
		<meta name="keywords"    content="my interviews, my mock interviews, my interview availability" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/myInterviews_style.css">
        
        <title>EngineRay | My Interviews</title>
    
    </head>
    <body>
    <header>
            <div class="logo">
                <a href="dash_eng.php"><img src="images/logo.png" alt="EngineRay Logo"></a>
            </div>
            <div class="user-info">
                <p class="username"><?php $first_name;?></p>
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
                <a class="active" target="_top" href="my_interviews_eng.php">My Interviews</a><br/>
                <a target="_top" href="my_mock_interviews_eng.php">My Mock Interviews</a><br/>
                <a target="_top" href="my_interview_avbly_eng.php">My Interview Aailability</a><br/>
            </div> 

            <div class="content">
                <h1 class="content">My Interviews </h1>
                <p class="content">View all my interviews details here.</p>
                
                <?php

                    require_once "dbh.inc.php";

                    $sqlstring="SELECT c.company_name AS interviewer, i.interviewID AS interviewID, i.occupation AS occupation, i.date AS date, i.time AS time, i.zoom_link AS zoom_link, i.status AS status, i.result AS result, i.engineer_feedback AS feedback
                    FROM company c, interview i 
                    WHERE i.engineerID='$engineerID' AND c.companyID=i.companyID;";

                    $queryResult=@mysqli_query($dbConnect, $sqlstring)
                        or die("<p>1..Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($dbConnect).": ".mysqli_error($dbConnect)."</p>");
                    $row=mysqli_fetch_assoc($queryResult);

                    if($row==0){
                        echo "<h1>Ah-Oh! You don't have any interview records yet.</h1>";
                    }else{
                        echo "<table width='100%' border='1' text-align='center'>";
                        echo "<tr><th></th><th>Interviewer</th><th>Occupation</th><th>Date</th><th>Time</th><th>Status</th><th>Interview Link</th><th>Result</th><th>Feedback</th></tr>";
                        $i=1;
                        while($row){
                            $zoom_link=$row['zoom_link'];
                            $interviewID =$row['interviewID'];
                            echo "<tr style='text-align:center'><td>$i</td>";
                            echo "<td>".$row['interviewer']."</td>";
                            echo "<td>".$row['occupation']."</td>";
                            echo "<td>".$row['date']."</td>";
                            echo "<td>".$row['time']."</td>";
                            echo "<td>".$row['status']."</td>";
                            echo "<td><a href='$zoom_link'>Zoom Meeting</a></td>";
                            if($row['result']!="N/A"){
                                echo "<td>".$row['result']."</td>";
                                if($row['feedback']==""){
                                    echo "<td><a href='https://forms.gle/7yv42WMFbnmBKywt8'>Leave A Feedback</a></td>"; //sample 
                                }else{
                                    echo "<td>Done</td>";
                                }  
                            }else{
                                echo "<td>Not Available</td><td><a class='disabled'>Leave A Feedback</a></td>";

                            }                                           
                            $i++;
                            $row=mysqli_fetch_assoc($queryResult);
                        }
                        echo "</table>";
                    }
                    mysqli_close($dbConnect);
                ?>

                
            </div>
        </div>
        
        <!-- <div class="footer">
            
        </div> -->

    </body>
</html>