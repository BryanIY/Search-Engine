<?php
    //start the session to store engineerID for further use 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's Initialize My Profile page" />
		<meta name="keywords"    content="my profile, name, occupation, skills, year of experience, preferred salary" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/update_myprofile_style.css">
        
        <title>EngineRay | My Profile</title>
    
    </head>
    <body>
        <?php 
            //Initialize all variables
            $first_name=$last_name=$email=$country=$occupation=$year_of_experience=$project_name=$project_dscp=$salary=$skills="";
            $first_name_err=$last_name_err=$email_err=$country_err=$occupation_err=$year_of_experience_err=$project_name_err=$project_dscp_err=$salary_err=$skills_err=$message="";
        ?>
        <header>
            <div class="logo">
                <a href="dash_eng.php"><img src="images/logo.png" alt="EngineRay Logo"></a>
            </div>
            <div class="user-info">
                <p class="username">Username</p>
                <a href="notification_eng.php" class="notification"><i class="fas fa-bell"></i></a>
                <a href="settings.php" class="settings"><i class="fas fa-cog"></i></a>
            </div>
        </header>

        <nav class="topnav">
            <ul>
                <li><a href="my_profile_eng.php">My Profile</a></li>
                <li><a href="my_exams_eng.php">My Exams</a></li>
                <li><a href="my_interviews_eng.php">My Interviews</a></li>
                <li><a href="my_offers_eng.php">My Offers</a></li>
                <li><a href="contact_us.php">Contact Us</a></li>
            </ul>
        </nav>

        <div class="row">
            <div class="sidenav">
                <a class="active" target="_top" href="my_profile_eng.php">My Profile</a><br/>
                <a target="_top" href="profile_image_eng.php">My Profile Image</a><br/>
				<a target="_top" href="my_resume_eng.php">My Resume</a><br/>
                <a target="_top" href="my_work_avbly_eng.php">My Work Availability</a><br/>
                <a target="_top" href="my_dkm_eng.php">My Domain Knowledge Metrics</a><br/>
            </div> 

            <div class="content">
                <h1 style="text-align:center"> My Personal Profile </h1>
                

                <div class="profile">
                    <?php 
                        if($_SERVER["REQUEST_METHOD"]=="POST"){
                            //Fields validation
                            if(empty($_POST["first_name"])){
                                $first_name_err="Please enter your first name!";
                            }else{
                                $first_name=trim($_POST["first_name"]);
                            }
                            if(empty($_POST["last_name"])){
                                $last_name_err="Please enter your last name!";
                            }else{
                                $last_name=trim($_POST["last_name"]);
                            }
                            if(empty($_POST["email"])){
                                $email_err="Please enter your email address!";
                            }else{
                                $email=trim($_POST["email"]);
                            }
                            if(trim($_POST["country"])=="Please select your residential country"){
                                $country_err="Please choose your residential country!";
                            }else{
                                $country=trim($_POST["country"]);
                            }
                            if(trim($_POST["occupation"])=="Please select your occupation"){
                                $occupation_err="Please select your occupation!";
                            }else{
                                $occupation=trim($_POST["occupation"]);
                            }
                            if(empty($_POST["year_of_experience"])){
                                $year_of_experience_err="Please enter the year of experience of your occupation!";
                            }else{
                                $year_of_experience=trim($_POST["year_of_experience"]);
                            }
                            if(empty($_POST["salary"])){
                                $salary_err="Please enter your preferred annual salary!";
                            }else{
                                $salary=trim($_POST["salary"]);
                            }
                            if(empty($_POST["skills"])){
                                $skills_err="Please choose your skills as many as possible!";
                            }else{
                                $skills = implode(',', $_POST['skills']);   //now $skills type:string                                                                  
                            }
                            if(empty($_POST["project_name"])){
                                $project_name_err="Please provide the project name!";
                            }else{
                                $project_name=trim($_POST["project_name"]);
                            }
                            if(empty($_POST["project_dscp"])){
                                $project_dscp_err="Please provide the project description!";
                            }else{
                                $project_dscp=trim($_POST["project_dscp"]);
                            }
                            
                        }
                        if(isset($_POST["update"]) && isset($first_name) && isset($last_name) && isset($email) && isset($country) && isset($occupation) && isset($year_of_experience)&& isset($salary)&& isset($skills)&& isset($project_name)&&isset($project_dscp)){
                            if($first_name_err=="" && $last_name_err=="" && $country_err=="" && $email_err==""&& $occupation_err=="" && $year_of_experience_err=="" && $salary_err=="" && $skills_err==""&& $project_name_err=="" && $project_dscp_err==""){
                                //echo "<br>7".gettype($skills);
                                //$selectedSkills=implode(" ", $skills);
                                //echo "<br>8".gettype($selectedSkills);
            

                                //connect to the database
                                $dbConnect=@mysqli_connect("localhost","root","",)
                                    or die("<p>The database server is not available!</p>");
                
                                $dbName="tap";
                                @mysqli_select_db($dbConnect, $dbName)
                                    or die("<p>Database '{$dbName}' is not available!</p>"); 
            
                                $sqlstring="INSERT INTO engineer(first_name,last_name,email,country,occupation,year_of_experience,salary,skills,project_name,project_description)VALUES( '$first_name','$last_name','$email','$country','$occupation','$year_of_experience','$salary','$skills','$project_name','$project_dscp')";
                                $queryResult=@mysqli_query($dbConnect, $sqlstring)
                                                or die("<p>Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($dbConnect).": ".mysqli_error($dbConnect)."</p>");
                                //find engineerID
                                $sqlstring="SELECT engineerID FROM engineer WHERE email='$email'";
                                $queryResult=@mysqli_query($dbConnect, $sqlstring)
                                    or die($message="Unable to query the customer table.");
                                    $row=mysqli_fetch_assoc($queryResult);
                                    $engineerID=$row['engineerID'];
                                    
                                $sqlString="INSERT INTO profile_image(engineerID, status)VALUES('$engineerID', 1)";
                                $queryResult=@mysqli_query($dbConnect, $sqlString)
                                                or die("<p>Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($dbConnect).": ".mysqli_error($dbConnect)."</p>");
                                $_SESSION['engineerID']=$engineerID;
                                    //session_commit();
                                    header("Location:my_profile_eng.php?engineerID=".$_SESSION['engineerID']);

                                mysqli_close($dbConnect);
                            }
                        }
                    ?>

                    <form method="post" action="">
                        <p class="personal_details">
                            <fieldset>
                                <legend>Personal Details</legend>
                                <label for="first_name">* First Name:</label>
                                <input type="text" id="first_name" name="first_name" value="<?php echo $first_name;?>"/>
                                <p style="color:red"><?php echo $first_name_err; ?></p> 

                                <label for="last_name">* Last Name:</label>
                                <input type="text" id="last_name" name="last_name" value="<?php echo $last_name;?>"/>
                                <p style="color:red"><?php echo $last_name_err; ?></p>

                                <label for="email">* Email Address:</label>
                                <input type="text" id="email" name="email" value="<?php echo $email;?>" placeholder="example@email.com"/>
                                <p style="color:red"><?php echo $email_err; ?></p>

                                <label for="country">* Country:</label>
                                <?php
                                    $countries = file("materials/country.txt"); //load country names to $countries array;
                                    echo "<select name='country' class='form-control'>";
                                    for ($i = 0; $i < count($countries); $i++) 
                                    {   
                                        $country_option=$countries[$i];
                                        echo "<option value='$country_option'>". $country_option . "</option>"; 
                                    }
                                    echo "</select><br/><br/>";   
                                ?>
                                <p style="color:red"><?php echo $country_err; ?></p>
                            </fieldset>
                        </p>
                        <p class="work_exp">
                            <fieldset>
                                <legend>Work Experience</legend>
                                <label for="skills">* My Skills:</label>
                                <?php 
                                    $skills = file("materials/skills.txt"); //load skills to $skills array;
                                    echo "<select name='skills[]' class='form-control' id='skills' multiple>";
                                    for ($i = 0; $i < count($skills); $i++) 
                                    {   
                                        $skill=$skills[$i];
                                        echo "<option value='$skill'>". $skill . "</option>"; 
                                    }
                                    echo "</select><br/><br/>";                               ?>
                                <p style="color:red"><?php echo $skills_err; ?></p>
                                <script src="js/multi-select-tag.js"></script>
                                <script>
                                    new MultiSelectTag('skills')  
                                </script>
                                <!--Here lists all jobs that are being offered and Engineers can choose a job from the list to apply for !-->
                                <label for="occupation">* Occupation:</label>
                                <?php
                                    $occupations = file("materials/occupation.txt"); //load occupations to $occupations array;
                                    echo "<select name='occupation' class='form-control'>";
                                    for ($i = 0; $i < count($occupations); $i++) 
                                    {   
                                        $occupation_option=$occupations[$i];
                                        echo "<option value='$occupation_option'>". $occupation_option . "</option>"; 
                                    }
                                    echo "</select><br/><br/>";   
                                ?>
                                <p style="color:red"><?php echo $occupation_err; ?></p>

                                <label for="year_of_experience">* Year of Experience:</label>
                                <input type="text" name="year_of_experience" class="form-control" value="<?php echo $year_of_experience;?>"/><br/><br/>
                                <p style="color:red"><?php echo $year_of_experience_err; ?></p>

                                <label for="salary">* Preferred Annual Salary: ($USD)</label>
                                <input type="text" name="salary" class="form-control" value="<?php echo $salary;?>"/><br/><br/>
                                <p style="color:red"><?php echo $salary_err; ?></p>
                            </fieldset>
                        </p>
                        <p class="project_exp">
                            <fieldset>
                                <legend>Project Experience</legend>
                                <label for="project_name">* Project Name:</label>
                                <input type="text" id="project_name" name="project_name" value="<?php echo $project_name;?>"/>
                                <p style="color:red"><?php echo $project_name_err; ?></p> 
                                <!--Upload image input -->
                                <label>Profile Image:</label>
                                <input type="file" name="image" class="form-control" /><br/><br/>

                                <label for="project_dscp">* Project Description:</label><br>
                                <textarea name="project_dscp" class="form-control" value="<?php echo $project_dscp;?>" row="10" col="50"></textarea><br/><br/>
                                <p style="color:red"><?php echo $project_dscp_err; ?></p>
                                <style> 
                                    textarea {
                                    width: 100%;
                                    height: 350px;
                                    padding: 12px;
                                    box-sizing: border-box;
                                    border: 1px solid grey;
                                    border-radius: .375rem;
                                    font-size: 16px;
                                    resize: vertical;
                                    transition: 0.5s;
                                    }
                                </style>
                            </fieldset>
                        </p>
                            <input type="submit" name="update" value="Update"/>
                    </form>
                </div>
            </div>
        </div>
        <?php
            
            
            

        ?>
        
        <!-- <div class="footer">
            
        </div> -->

    </body>
</html>