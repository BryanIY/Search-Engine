<?php 
    session_start();
    $engineerID=$_SESSION["engineerID"];
    $first_name=$_SESSION["first_name"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Exams page" />
		<meta name="keywords"    content="my exams, my problem-solving videos, attempt an exam, record a problem-solving video" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/myExams_style.css">
        
        <title>EngineRay | Domain Knowledge Metrics</title>
    
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
                <a class="active" target="_top" href="dkm_eng.php">Domain Knowledge Metrics</a><br/>
                <!-- <a target="_top" href="my_personality_test_eng.php">My Personality Test</a><br/> -->
                <a target="_top" href="my_psv_eng.php">My Problem-Solving Videos</a><br/>
                <a target="_top" href="take_a_psv_eng.php">Record A Problem-Solving Video</a><br/>
            </div> 

            <div class="content">
                <h1 class="content">Domain Knowledge Metrics </h1>
                <p class="content">My domain knowledge metrics results show here.</p>
                <div>
                    <?php 
                    $message="<h1 style='text-align:center'>Ah-oh! You have not taken any exams yet.</h1><hr><br/>";
                    $exam1="<tr style='text-align:center'><td>Database Assessment</td><td></td><td>Uncompleted</td><td></td><td><a href='https://forms.gle/AbxHtNtdDadHjiHB7'>Attempt</a></td></tr>";
                    $exam2="<tr style='text-align:center'><td>GitHub Assessment</td><td></td><td>Uncompleted</td><td></td><td><a href='https://forms.gle/AbxHtNtdDadHjiHB7'>Attempt</a></td></tr>";
                    $exam3="<tr style='text-align:center'><td>AAA Assessment</td><td></td><td>Uncompleted</td><td></td><td><a href='https://forms.gle/AbxHtNtdDadHjiHB7'>Attempt</a></td></tr>";
                    $exam4="<tr style='text-align:center'><td>BBB Assessment</td><td></td><td>Uncompleted</td><td></td><td><a href='https://forms.gle/AbxHtNtdDadHjiHB7'>Attempt</a></td></tr>";
                    
                    require_once "dbh.inc.php";

                    $sqlstring="SELECT * FROM dkm WHERE engineerID ='$engineerID'";
                    $queryResult=@mysqli_query($dbConnect, $sqlstring)
                        or die("<p>1..Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($dbConnect).": ".mysqli_error($dbConnect)."</p>");
                    $row=mysqli_fetch_assoc($queryResult);
                    
                    if($row!=0){
                        $i=0;
                        $message ="";
                         while($row){
                            if($row['exam_title']=="Database Assessment"){
                                $exam1= "<tr style='text-align:center'><td>Database Assessment</td><td>{$row['timestamp']}</td><td>Completed</td><td>{$row['score']}</td><td><a href='{$row['link']}'>View</a> / <a href='https://forms.gle/AbxHtNtdDadHjiHB7'>Retake</a></td></tr>";
                            }
                            if($row['exam_title']=="GitHub Assessment"){
                                $exam2= "<tr style='text-align:center'><td>GitHub Assessment</td><td>{$row['timestamp']}</td><td>Completed</td><td>{$row['score']}</td><td><a href='{$row['link']}'>View</a> / <a href='https://forms.gle/AbxHtNtdDadHjiHB7'>Retake</a></td></tr>";
                            }
                            if($row['exam_title']=="AAA Assessment"){
                                $exam2= "<tr style='text-align:center'><td>AAA Assessment</td><td>{$row['timestamp']}</td><td>Completed</td><td>{$row['score']}</td><td><a href='{$row['link']}'>View</a> / <a href='https://forms.gle/AbxHtNtdDadHjiHB7'>Retake</a></td></tr>";
                            }
                            if($row['exam_title']=="BBB Assessment"){
                                $exam2= "<tr style='text-align:center'><td>BBB Assessment</td><td>{$row['timestamp']}</td><td>Completed</td><td>{$row['score']}</td><td><a href='{$row['link']}'>View</a> / <a href='https://forms.gle/AbxHtNtdDadHjiHB7'>Retake</a></td></tr>";
                            }
                            $i++;
                            $row=mysqli_fetch_assoc($queryResult);
                        }
                    }

                    //exam table
                    echo $message;
                    echo "<table width='100%' border='0' text-align='center'>";
                    echo "<tr><th>Exam Title</th><th>Date & Time</th><th>Status</th><th>Score</th><th>Action</th></tr>";
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