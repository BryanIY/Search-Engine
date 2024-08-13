<?php 
        require_once "includes/dbh.inc.php";

        $engineer = $_GET["uengineerID"];
        $engineerID = intval($engineer);
        
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Profile page" />
		<meta name="keywords"    content="my profile, name, occupation, skills, year of experience, preferred salary" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style/myprofile_style.css">
        
        <title>EngineRay | My Profile</title>
    
    </head>
    <body>
        <?php
           require_once "includes/dbh.inc.php";
            
            $sql="SELECT * FROM engineer WHERE engineerID ='$engineerID'";

            $queryResult=@mysqli_query($conn, $sql)
            or die("<p>Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($conn).": ".mysqli_error($conn)."</p>");

            $row=mysqli_fetch_assoc($queryResult);

            $first_name = $row['first_name']; 
            $last_name = $row['last_name'];
            $email = $row['email'];
            $country = $row['country'];
            $occupation = $row['occupation'];
            $year_of_experience = $row['year_of_experience'];
            $skills = $row['skills'];
            $salary = $row['salary'];
            $professional_experience = $row['professional_experience'];
            $work_avbly=$row['work_avbly'];
            $start_date=$row['start_date'];

            
            mysqli_close($conn);
        ?> 
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
                <a class="active" target="_top" href="cmy_profile_eng.php?uengineerID=<?php echo $engineerID ?>">Engineer's Profile</a><br/>
                <a target="_top" href="cprofile_image_eng.php?uengineerID=<?php echo $engineerID ?>">Engineer's Profile Image</a><br/>
				<a target="_top" href="cmy_resume_eng.php?uengineerID=<?php echo $engineerID ?>">Engineer's Resume</a><br/>
                <!-- <a target="_top" href="cmy_work_avbly_eng.php">My Work Availability</a><br/> -->
            </div> 

            <div class="content">
                <h1 class="content"><?php echo $first_name ?>'s Personal Profile </h1>
                <!-- <p class="content">View my personal profile here. Click "Update My Profile" if there is something you would like to change.</p> -->
                

                    <div class="cards">
                        <div class="card">
                            <table>
                                <tr><th style="width:40%"></th><th></th></tr>
                                <tr>
                                    <td><label for="first_name"><strong>First Name: </strong></label></td>
                                    <td><?php echo $first_name;?></td>
                                </tr>
                                <tr>
                                    <td><label for="last_name"><strong>Last Name: </strong></label></td>
                                    <td><?php echo $last_name;?></td>
                                </tr>
                                <tr>
                                    <td><label for="personality"><strong>Personality Type: </strong></label></td>
                                    <td><?php //echo personality;?></td>
                                </tr>
                                <!-- <tr>
                                    <td><label for="email"><strong>Email Address: </strong></label></td>
                                    <td><?php echo $email;?></td>
                                </tr> -->
                                <tr>
                                    <td><label for="country"><strong>Country: </strong></label></td>
                                    <td><?php echo $country; ?></td>
                                </tr>
                                <tr>
                                    <td><label for="occupation"><strong>Occupation: </strong></label></td>
                                    <td><?php echo $occupation;?></td>
                                </tr>
                                <tr>
                                    <td><label for="year_of_experience"><strong>Year of Experience: </strong></label></td>
                                    <td><?php echo $year_of_experience;?> Years</td>
                                </tr>
                                <tr>
                                    <td><label for="skills"><strong>My Skills: </strong></label></td>
                                    <td><?php echo $skills; ?></td>
                                </tr>
                                <tr>
                                    <td><label for="salary"><strong>Preferred Annual Salary: ($USD)</strong></label></td>
                                    <td><?php echo $salary;?></td>
                                </tr>
                                <tr>
                                    <td><label for="professional_experience"><strong>Professional Experience: </strong></label></td>
                                    <td style="word-wrap:break-word"><?php echo $professional_experience;?></td>
                                </tr>
                                <tr>
                                    <td><label for="work_avbly"><strong>Work Availability: </strong></label></td>
                                    <td style="word-wrap:break-word"><?php echo $work_avbly;?></td>
                                </tr>
                                <tr>
                                    <td><label for="start_date"><strong>Available Since: </strong></label></td>
                                    <td style="word-wrap:break-word"><?php echo $start_date;?></td>
                                </tr>
                            </table>
                            <style>
                                table{
                                    width:80%;
                                    table-layout:fixed;
                                    padding-left:20px;
                                    margin-top:20px;
                                    margin-bottom:30px;
                                    margin-left:30px;
                                    margin-right:30px;
                                    /* border:1px solid black; */
                                }
                            </style>
                        </div>
   
                    </div>  
                <!-- <button type="button"  class="updateProfile" onclick="window.location.href='update_my_profile_eng.php'"><span>Update My Profile</span></button> -->
            </div>
        </div>
        
        <!-- <div class="footer">
            
        </div> -->

    </body>
</html>