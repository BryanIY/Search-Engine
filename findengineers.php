<?php

require_once 'includes/dbh.inc.php';


if(isset($_POST['add']))
{   
    $fname = $_POST['efname'];
    $lname = $_POST['elname'];
    $occupation = $_POST['ejobdesc'];
    $exp = $_POST['eexp'];
    $date = $_POST['eadate'];
    $skills = $_POST['eskills'];
    $salary = $_POST['easalary'];
    $profile_image = $_POST['eprofileimage'];
    $dkm = $_POST['edomainknowledge'];
    $engineerID = $_POST['eusersId'];

    $select_users = mysqli_query($conn, "SELECT * FROM `faveng` WHERE engineerID = '$engineerID'");       

    if(mysqli_num_rows($select_users)>0)
    {
        $message = "Users already added to your candidate list";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else
    {
        $insert_users = mysqli_query($conn, "INSERT INTO `faveng`(`companyID`, `engineerID`) 
        VALUES('223','$engineerID')");

        $message = "Users added to your My Candidates list";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay sub menu page" />
		<meta name="keywords"    content=" " />
		<meta name="author"      content="Cody & Bryan & Serena" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style/findengineerstyle.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
        
        <title>EngineRay | Find Engineers </title>
    </head>

    <body>

        <header> <!-- at the top of the username logout things -->
            <div class="logo">
                <a href="findengineers.php"><img src="image/11.png" alt="EngineRay Logo"></a>
            </div>
            <div class="user-info">
                <p class="username"><a href="user_profile.php">Username</a></p>
                <a href="notification_eng.php" class="notification"><i class="fas fa-bell"></i></a>
                <a href="settings.php" class="settings"><i class="fas fa-cog"></i></a>
            </div>
        </header>
        
        <!-- navigation -->
        <nav class="topnav">
            <ul>
                <li><a href="findengineers.php">Find Engineers</a></li>
                <li><a href="mycandidates.php">My Candidates</a></li>
                <li><a href="hiredengineers.php">Hired Engineers</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
            </ul>
        </nav>

        <!-- body stuff -->
        <div class="row">

            <div class="sidenav">

                <form method="get" action="findengineers.php">

                    <p>Search/Sort</p>
                    
                    </br>

                    <!-- label of the occupation -->
                    <label for="occupation">Occupation</label></br>
                    <select name='occupation' class='form-control mult-select-tag width100 sp-select'>
                        <?php
                                $occupations = file("materials/occupation.txt"); //load occupations to $occupations array;
                                for ($i = 0; $i < count($occupations); $i++) 
                                {   
                                    echo $occupations[$i];
                                    $occupation_option = $occupations[$i] === 'Please select your occupation' ? "" : $occupations[$i];
                                    echo "<option value='$occupation_option'>". $occupation_option . "</option>"; 
                                }
                                echo "</select><br/><br/>";   
                        ?>
                    </select>
                        <p style="color:red"><?php //echo $occupation_err; ?></p>
                    
                    
                    <!-- label of the skills -->
                    <label for="skills">My Skills</label></br>
                        <?php 
                                $skills = file("materials/skills.txt"); //load skills to $skills array;
                                echo "<select name='skills[]' class='form-control width100' id='skills' multiple>";
                                for ($i = 0; $i < count($skills); $i++) 
                                {   
                                    $skill=$skills[$i];
                                    echo "<option value='$skill'>". $skill . "</option>"; 
                                }
                                echo "</select><br/><br/>";                               
                        ?>
                        <p style="color:red"><?php //echo $skills_err; ?></p>
                        <script src="js/multi-select-tag.js"></script>
                        <!-- <script>new MultiSelectTag('skills')</script> call fucntion -->   

                        <label for="year_of_experience">Year of Experience</label></br></br>
                        <input type="text" name="year_of_experience" class="form-control" value="<?php if(isset($_GET['year_of_experience'])) echo $_GET['year_of_experience']; ?>"/><br/><br/>
                        <p style="color:red"><?php //echo $year_of_experience_err; ?></p>

                        <label for="salary">Preferred Annual Salary($USD)</label></br></br>
                        <input type="text" name="salary" class="form-control" value="<?php if(isset($_GET['salary'])) echo $_GET['salary']; ?>"/><br/><br/>
                        <p style="color:red"><?php //echo $salary_err; ?></p>

                        <label for="start_date">Start Date</label></br></br>
                        <input type="date" name="start_date" class="form-control" value="<?php if(isset($_GET['start_date'])) echo $_GET['start_date']; ?>"/><br/><br/>
                        <p style="color:red"><?php //echo $salary_err; ?></p>

                    <!-- search button -->
                    <input class="btn" type="submit" value="Search" name="submit"><br/>
                    <input class="btn" type="reset" value="Reset" name="reset">
                </form> 
                
                <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
                <script>new MultiSelectTag('skills')</script> <!-- display the mutiple stuff -->    
                
            </div></br>            
            
            <div class="content">

                 <div class="main">

                        <?php

                        $occupation = $skills = $year_of_experience = $salary = $start_date = ""; 
                        $i = 0;

                        if (true)
                        {
                            if(!empty($_GET["occupation"]))
                            {
                                $occupation=trim($_GET["occupation"]);
                                if($occupation=="Please select your occupation")
                                {
                                    $occupation='';
                                }
                            }

                            if(!empty($_GET["skills"])){
                                $skills = $_GET['skills'];
                                // echo $skills;
                            }

                            if(!empty($_GET["year_of_experience"]))
                            {
                                $year_of_experience=trim($_GET["year_of_experience"]);
                            }

                            if(!empty($_GET["salary"]))
                            {
                                $salary=trim($_GET["salary"]);
                            }

                            if(!empty($_GET["start_date"]))
                            {
                                $start_date=trim($_GET["start_date"]);
                            }
                        }

                        //search query
                            require_once 'includes/dbh.inc.php';

                            if (isset($_GET["submit"]) && $_GET["submit"] == 'Search')
                            {
                                $sql = "SELECT e.engineerID AS engineerID, e.first_name AS first_name, e.last_name AS last_name, e.occupation AS occupation, e.year_of_experience AS year_of_experience, e.skills AS skills, e.salary AS salary, e.start_date AS start_date, p.objectID AS profile_image, d.score AS dkm, i.psv_link AS pvideo, m.mock_interview_video AS mvideo, e.work_avbly AS work_avbly
                                FROM engineer e, dkm d, profile_image p, psv i, mock_interview m
                                WHERE e.engineerID = d.engineerID AND
                                    e.engineerID = p.engineerID AND
                                    e.engineerID = i.engineerID AND
                                    e.engineerID = m.engineerID AND
                                    d.engineerID = p.engineerID AND
                                    d.engineerID = i.engineerID AND
                                    d.engineerID = m.engineerID AND
                                    p.engineerID = i.engineerID AND
                                    p.engineerID = m.engineerID AND
                                    i.engineerID = m.engineerID AND
                                    m.mock_interview_video IS NOT NULL AND m.mock_interview_video<>''AND
                                    e.work_avbly = 'Available'AND
                                    1=1
                                    ";
                                
                                if($occupation){
                                    $sql .= ' and occupation = "'.$occupation .'"';
                                }
                                
                                if($skills){
                                    $skill_sql = "";
                                    foreach($skills as $skill){
                                        if($skill_sql){
                                            $skill_sql .= ' AND skills like "%'.trim($skill).'%"';
                                        }else{
                                            $skill_sql .= ' skills like "%'.trim($skill).'%"';
                                        }
                                    }
                                    $sql .= " and ($skill_sql)";
                                }
                                
                                if($year_of_experience){
                                    $sql .= ' and year_of_experience >= '. $year_of_experience;
                                }
                                if($salary){
                                    $sql .= ' and salary <=' .$salary;
                                }
                                if($start_date){
                                    $sql .= ' and start_date <="' . $start_date .'"';
                                    // $sql .= ' and start_date =' . date('Y-m-d', strtotime($start_date));
                                }
                                
                                $queryResult=@mysqli_query($conn, $sql)
                                or die("<p>Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($conn).": ".mysqli_error($conn)."</p>");

                                $row=mysqli_fetch_assoc($queryResult);
                                
                                while($row)
                                {

                                    $fname = $row['first_name'];
                                    $lname = $row['last_name'];
                                    $occupation = $row['occupation'];
                                    $year_of_experience = $row['year_of_experience'];
                                    $start_date = $row['start_date'];
                                    $skills = $row['skills'];
                                    $salary = $row['salary'];
                                    $profileimage = $row['profile_image'];
                                    $domainknowledge = $row['dkm'];
                                    $engineerID = $row['engineerID'];
                                    $pvideo = $row['pvideo'];
                                    $mvideo = $row['mvideo'];
                                
                                    ?>    

                                    <form class="form" action="" method="POST">
                                        
                                        <div class="card">
                                            
                                            <div class="interview-button">
                                                <input type="submit" class="btn" value="+" name="add">
                                            </div>

                                            <div class="image">
                                                <img src="<?php echo $profileimage ?>">
                                            </div>

                                            <div class="caption">
                                                <a class="aa" href='cmy_profile_eng.php?uengineerID=<?php echo $engineerID ?>'><?php echo $fname ?> <?php echo $lname ?><a>
                                                <p><?php echo $occupation; ?></p>
                                                <p>Job Experience: <?php echo $year_of_experience; ?> Years</p>
                                                <p>Availability: <?php echo $start_date; ?></p>
                                                <p>Skills: <?php echo $skills; ?></p>
                                                <p>Annual Salary: $<?php echo $salary; ?></p>
                                                <p>Domain Knowledge Score: <?php echo $domainknowledge ?></p>
                                                <input type=hidden name="efname" value = "<?php echo $fname; ?>">
                                                <input type=hidden name="elname" value = "<?php echo $lname; ?>">
                                                <input type=hidden name="ejobdesc" value = "<?php echo $occupation; ?>">
                                                <input type=hidden name="eexp" value = "<?php echo $year_of_experience; ?>">
                                                <input type=hidden name="eadate" value = "<?php echo $start_date; ?>">
                                                <input type=hidden name="eskills" value = "<?php echo $skills; ?>">
                                                <input type=hidden name="easalary" value = "<?php echo $salary; ?>">
                                                <input type=hidden name="eprofileimage" value = "<?php echo $profileimage; ?>">
                                                <input type=hidden name="edomainknowledge" value = "<?php echo $domainknowledge; ?>">
                                                <input type=hidden name="eusersId" value = "<?php echo $engineerID; ?>">
                                            </div> 

                                            <div class="video">
                                                <video src="<?php echo $pvideo; ?>"controls="controls" width="300">demo</video></br>
                                                <video src="<?php echo $mvideo; ?>"controls="controls" width="300">demo</video>
                                            </div>
                                        </div>
                                           
                                    </form>
                                    <?php   
                                    
                                    $i++;
                                    $row=mysqli_fetch_assoc($queryResult);

                                }
                            }
                            else
                            {
                                $sql = "SELECT e.engineerID AS engineerID, e.first_name AS first_name, e.last_name AS last_name, e.occupation AS occupation, e.year_of_experience AS year_of_experience, e.skills AS skills, e.salary AS salary, e.start_date AS start_date, p.objectID AS profile_image, d.score AS dkm, i.psv_link AS pvideo, m.mock_interview_video AS mvideo, e.work_avbly AS work_avbly
                                FROM engineer e, dkm d, profile_image p, psv i, mock_interview m
                                WHERE e.engineerID = d.engineerID AND
                                    e.engineerID = p.engineerID AND
                                    e.engineerID = i.engineerID AND
                                    e.engineerID = m.engineerID AND
                                    d.engineerID = p.engineerID AND
                                    d.engineerID = i.engineerID AND
                                    d.engineerID = m.engineerID AND
                                    p.engineerID = i.engineerID AND
                                    p.engineerID = m.engineerID AND
                                    i.engineerID = m.engineerID AND
                                    m.mock_interview_video IS NOT NULL AND m.mock_interview_video<>''AND
                                    e.work_avbly = 'Available'";

                                $queryResult=@mysqli_query($conn, $sql)
                                or die("<p>Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($conn).": ".mysqli_error($conn)."</p>");
                            

                                $row=mysqli_fetch_assoc($queryResult);
                                
                                while($row)
                                {
                                    $fname = $row['first_name'];
                                    $lname = $row['last_name'];
                                    $occupation = $row['occupation'];
                                    $year_of_experience = $row['year_of_experience'];
                                    $start_date = $row['start_date'];
                                    $skills = $row['skills'];
                                    $salary = $row['salary'];
                                    $profileimage = $row['profile_image'];
                                    $domainknowledge = $row['dkm'];
                                    $engineerID = $row['engineerID'];
                                    $pvideo = $row['pvideo'];
                                    $mvideo = $row['mvideo'];
                                
                                ?>
                                    <form class="form" action="" method="POST">
                                    
                                            <div class="card">
                                                
                                                <div class="interview-button">
                                                    <input type="submit" class="btn" value="+" name="add">
                                                </div>

                                                <div class="image">
                                                    <img src="<?php echo $profileimage ?>">
                                                </div>

                                                <div class="caption">
                                                    <a class="aa" href='cmy_profile_eng.php?uengineerID=<?php echo $engineerID ?>'><?php echo $fname ?> <?php echo $lname ?><a>
                                                    <p><?php echo $occupation; ?></p>
                                                    <p>Job Experience: <?php echo $year_of_experience; ?> Years</p>
                                                    <p>Availability: <?php echo $start_date; ?></p>
                                                    <p>Skills: <?php echo $skills; ?></p>
                                                    <p>Annual Salary: $<?php echo $salary; ?></p>
                                                    <p>Domain Knowledge Score: <?php echo $domainknowledge ?></p>
                                                    <input type=hidden name="efname" value = "<?php echo $fname; ?>">
                                                    <input type=hidden name="elname" value = "<?php echo $lname; ?>">
                                                    <input type=hidden name="ejobdesc" value = "<?php echo $occupation; ?>">
                                                    <input type=hidden name="eexp" value = "<?php echo $year_of_experience; ?>">
                                                    <input type=hidden name="eadate" value = "<?php echo $start_date; ?>">
                                                    <input type=hidden name="eskills" value = "<?php echo $skills; ?>">
                                                    <input type=hidden name="easalary" value = "<?php echo $salary; ?>">
                                                    <input type=hidden name="eprofileimage" value = "<?php echo $profileimage; ?>">
                                                    <input type=hidden name="edomainknowledge" value = "<?php echo $domainknowledge; ?>">
                                                    <input type=hidden name="eusersId" value = "<?php echo $engineerID; ?>">
                                                </div> 

                                                <div class="video">
                                                    <video src="<?php echo $pvideo; ?>"controls="controls" width="300">demo</video></br>
                                                    <video src="<?php echo $mvideo; ?>"controls="controls" width="300">demo</video>
                                                </div>
                                            </div>
                                          
                                    </form>
                                <?php

                                    $i++;
                                    $row=mysqli_fetch_assoc($queryResult);
                                   

                                }    

                            }    

                        ?>  
                </div>          
            </div>
        </div>

    </body>
</html>