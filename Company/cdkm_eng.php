<?php 
        require_once "includes/dbh.inc.php";
        $engineer = $_GET["uengineerID"];
        $engineerID = intval($engineer);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Exams page" />
		<meta name="keywords"    content="my exams, my problem-solving videos, attempt an exam, record a problem-solving video" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style/myExams_style.css">
        
        <title>EngineRay | Domain Knowledge Metrics</title>
    
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
                <a class="active" target="_top" href="cdkm_eng.php?uengineerID=<?php echo $engineerID ?>">Domain Knowledge Metrics</a><br/>
                <!-- <a target="_top" href="my_personality_test_eng.php">My Personality Test</a><br/> -->
                <a target="_top" href="cmy_psv_eng.php?uengineerID=<?php echo $engineerID ?>">Problem-Solving Videos</a><br/>
                <!-- <a target="_top" href="ctake_a_psv_eng.php?uengineerID=<?php //echo $engineerID ?>">Record A Problem-Solving Video</a><br/> -->
            </div> 

            <div class="content">
                <h1 class="content">Domain Knowledge Metrics </h1>
                <p class="content">Domain knowledge metrics results show here.</p>
                <div>
                    <?php 
                    $message="<h1 style='text-align:center'>Ah-oh! You have not taken any exams yet.</h1><hr><br/>";
                    $exam1="<tr style='text-align:center'><td>Database Assessment</td><td></td><td>Uncompleted</td><td></td></tr>";
                    $exam2="<tr style='text-align:center'><td>GitHub Assessment</td><td></td><td>Uncompleted</td><td></td></tr>";
                    $exam3="<tr style='text-align:center'><td>AAA Assessment</td><td></td><td>Uncompleted</td><td></td><td></tr>";
                    $exam4="<tr style='text-align:center'><td>BBB Assessment</td><td></td><td>Uncompleted</td><td></td><td></tr>";
                    
                    require_once "includes/dbh.inc.php";

                    $sqlstring="SELECT * FROM dkm WHERE engineerID ='$engineerID'";
                    $queryResult=@mysqli_query($conn, $sqlstring)
                        or die("<p>1..Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($conn).": ".mysqli_error($conn)."</p>");
                    $row=mysqli_fetch_assoc($queryResult);
                    
                    if($row!=0){
                        $i=0;
                        $message ="";
                         while($row){
                            if($row['exam_title']=="Database Assessment"){
                                $exam1= "<tr style='text-align:center'><td>Database Assessment</td><td>{$row['timestamp']}</td><td>Completed</td><td>{$row['score']}</td><td><a href='{$row['link']}'>View</a>";
                            }
                            if($row['exam_title']=="GitHub Assessment"){
                                $exam2= "<tr style='text-align:center'><td>GitHub Assessment</td><td>{$row['timestamp']}</td><td>Completed</td><td>{$row['score']}</td><td><a href='{$row['link']}'>View</a>";
                            }
                            if($row['exam_title']=="AAA Assessment"){
                                $exam2= "<tr style='text-align:center'><td>AAA Assessment</td><td>{$row['timestamp']}</td><td>Completed</td><td>{$row['score']}</td><td><a href='{$row['link']}'>View</a>";
                            }
                            if($row['exam_title']=="BBB Assessment"){
                                $exam2= "<tr style='text-align:center'><td>BBB Assessment</td><td>{$row['timestamp']}</td><td>Completed</td><td>{$row['score']}</td><td><a href='{$row['link']}'>View</a>";
                            }
                            $i++;
                            $row=mysqli_fetch_assoc($queryResult);
                        }
                    }

                    //exam table
                    echo $message;
                    echo "<table width='100%' border='0' text-align='center'>";
                    echo "<tr><th>Exam Title</th><th>Date & Time</th><th>Status</th><th>Score</th></tr>";
                    echo $exam1;
                    echo $exam2;
                    echo $exam3;
                    echo $exam4;
                    echo "</table>";
                    ?>
                    
                </div>
              
            </div>
        </div>
        
        <!-- <div class="footer">
            width='100%' border='1' text-align='center'
        </div> -->

    </body>
</html>