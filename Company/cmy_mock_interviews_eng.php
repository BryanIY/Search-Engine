<?php 
    require_once "includes/dbh.inc.php";
    $engineer = $_GET["uengineerID"];
    $engineerID = intval($engineer);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Mock Interviews page" />
		<meta name="keywords"    content="my mock interviews" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style/myInterviews_style.css">
        
        <title>EngineRay | My Mock Interviews</title>
    
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
                <!-- <a target="_top" href="cmy_interviews_eng.php?uengineerID=<?php echo $engineerID ?>">Interviews</a><br/> -->
                <a class="active" target="_top" href="cmy_mock_interviews_eng.php?uengineerID=<?php echo $engineerID ?>">Mock Interviews</a><br/>
                <!-- <a target="_top" href="cmy_interview_avbly_eng.php?uengineerID=<?php echo $engineerID ?>">Interview Availability</a><br/> -->
            </div> 

            <div class="content">
                <h1 class="content">Mock Interviews </h1>
                <!-- <p class="content">You will need to complete at least 3 mock interviews with EngineRay before applying for a job interview.</p> -->
                
                <?php

                    require_once "includes/dbh.inc.php";

                    $sqlstring="SELECT m.mock_interview_video AS mock_interview_video, a.admin_name AS interviewer, m.date AS date, m.time AS time, m.zoom_link AS zoom_link, m.status AS status, m.result AS result 
                    FROM admin a, mock_interview m
                    WHERE m.engineerID='$engineerID' AND a.adminID=m.adminID;";

                    $queryResult=@mysqli_query($conn, $sqlstring)
                        or die("<p>1..Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($conn).": ".mysqli_error($conn)."</p>");
                    $row=mysqli_fetch_assoc($queryResult);

                    if($row==0){
                        echo "<h1>Ah-Oh! You don't have any mock interview records yet.</h1>";
                    }else{
                        echo "<table width='100%' border='1' text-align='center'>";
                        echo "<tr><th></th><th>Interviewer</th><th>Date</th><th>Time</th><th>Status</th><th>Mock Interview Video Link</th><th>Result</th></tr>";
                        $i=1;
                        while($row){
                            $mock_video=$row['mock_interview_video'];
                            echo "<tr style='text-align:center'><td>$i</td>";
                            echo "<td>".$row['interviewer']."</td>";
                            echo "<td>".$row['date']."</td>";
                            echo "<td>".$row['time']."</td>";
                            echo "<td>".$row['status']."</td>";
                            echo "<td><a href='$mock_video'>Video</a></td>";
                            echo "<td>".$row['result']."</td>";
                            
                            $i++;
                            $row=mysqli_fetch_assoc($queryResult);
                        }
                        echo "</table>";
                    }
                    mysqli_close($conn);
                ?>
                                    
                
            </div>
        </div>
        
        <!-- <div class="footer">
            
        </div> -->

    </body>
</html>