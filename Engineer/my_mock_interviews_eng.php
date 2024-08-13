<?php 
    session_start();
    $engineerID=$_SESSION["engineerID"];
    $first_name=$_SESSION["first_name"]; 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Mock Interviews page" />
		<meta name="keywords"    content="my mock interviews" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/myInterviews_style.css">
        
        <title>EngineRay | My Mock Interviews</title>
    
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
                <a target="_top" href="my_interviews_eng.php">My Interviews</a><br/>
                <a class="active" target="_top" href="my_mock_interviews_eng.php">My Mock Interviews</a><br/>
                <a target="_top" href="my_interview_avbly_eng.php">My Interview Aailability</a><br/>
            </div> 

            <div class="content">
                <h1 class="content">My Mock Interviews </h1>
                <p class="content">You will need to complete at least 3 mock interviews with EngineRay before applying for a job interview.</p>
                
                <?php

                    require_once "dbh.inc.php";

                    $sqlstring="SELECT a.admin_name AS interviewer, m.date AS date, m.time AS time, m.zoom_link AS zoom_link, m.status AS status, m.result AS result FROM admin a, mock_interview m
                    WHERE m.engineerID='$engineerID' AND a.adminID=m.adminID;";

                    $queryResult=@mysqli_query($dbConnect, $sqlstring)
                        or die("<p>1..Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($dbConnect).": ".mysqli_error($dbConnect)."</p>");
                    $row=mysqli_fetch_assoc($queryResult);

                    if($row==0){
                        echo "<h1>Ah-Oh! You don't have any mock interview records yet.</h1>";
                    }else{
                        echo "<table width='100%' border='1' text-align='center'>";
                        echo "<tr><th></th><th>Interviewer</th><th>Date</th><th>Time</th><th>Interview Link</th><th>Status</th><th>Result</th></tr>";
                        $i=1;
                        while($row){
                            $zoom_link=$row['zoom_link'];
                            echo "<tr style='text-align:center'><td>$i</td>";
                            echo "<td>".$row['interviewer']."</td>";
                            echo "<td>".$row['date']."</td>";
                            echo "<td>".$row['time']."</td>";
                            echo "<td>".$row['status']."</td>";
                            echo "<td><a href='$zoom_link'>Zoom Meeting</a></td>";
                            echo "<td>".$row['result']."</td>";
                            
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