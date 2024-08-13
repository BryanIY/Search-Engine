<?php

require_once 'includes/dbh.inc.php';

$offer_occupation=$offer_start_date=$offer_end_date=$offer_salary="";
$offer_occupation_err=$offer_start_date_err=$offer_end_date_err=$offer_salary_err="";
$i = 0;


if(isset($_POST['acandidate']))
{
    //validation
    if(trim($_POST["offer_start_date"])=="Please select your offer start date"){
        $offer_start_date_err="Please select your offer start date!";
    }else{
        $offer_start_date=trim($_POST["offer_start_date"]);
    }

    if(trim($_POST["offer_end_date"])=="Please select your offer end date"){
        $offer_end_date_err="Please select your offer end date!";
    }else{
        $offer_end_date=trim($_POST["offer_end_date"]);
    }

    if(trim($_POST["offer_salary"])=="Please fill offer salary"){
        $offer_salary_err="Please fill offer salary!";
    }else{
        $offer_salary=trim($_POST["offer_salary"]);
    }

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
    $offer_start_date = $_POST['offer_start_date'];
    $offer_end_date = $_POST['offer_end_date'];
    $offer_salary = $_POST['offer_salary'];

    $sql1 = mysqli_query($conn, "INSERT INTO `offer`(`companyID`, `engineerID`, `offer_occupation`, `offer_start_date`, `offer_end_date`, `offer_salary`, `status`, `sign`) 
    VALUES ('223','$engineerID','$occupation', '$offer_start_date', '$offer_end_date','$offer_salary','sent', 'No')");

    $sql2 =  mysqli_query($conn, "UPDATE `interview` SET `status` = 'Interviewed', result = 'Passed' WHERE `engineerID` = '$engineerID' AND `companyID` = '223' AND `status` = 'Scheduled'");
            
}

if(isset($_POST['rcandidate']))
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
    $engineerID = $_POST['eusersId'];
     
    $sql3 = mysqli_query($conn, "INSERT INTO `rejection`(`meetingID`, `companyID`, `engineerID`)
                                VALUES('1', '223', '$engineerID')");

    $sql4 = mysqli_query($conn, "UPDATE `interview` SET `status` = 'Interviewed', result = 'Rejected' WHERE `engineerID` = '$engineerID' AND `companyID` = '223' AND `status` = 'Scheduled'");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay sub menu page" />
		<meta name="keywords"    content=" " />
		<meta name="author"      content="Bryan & Serena" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style/mcstyle2.css">
        
        <title>EngineRay | My Candidates </title>
    
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
            </div>
        </header>

        <nav class="topnav">
            <ul>
                <li><a href="findengineers.php">Find Engineers</a></li>
                <li><a href="mycandidates.php">My Candidates</a></li>
                <li><a href="hiredengineers.php">Hired Engineers</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
            </ul>
        </nav>

        <div class="row">
            <div class="sidenav">
                <a target="_top" href="mycandidates.php">Added Candidates</a><br/>
                <a class="active" target="_top"  href="mycandidates2.php">Interviewed Candidates</a><br/>
                <a target="_top"  href="mycandidates3.php">Accepted Candidates</a><br/>
                <p>Search</p>
                <form action="" method="get">
                    <input type="text" name="search" placeholder="Search"><br/>
                    <input class="btn" type="submit" value="Search" name="submit"><br/>
                    <input class="btn" type="reset" value="Reset" name="reset">
                </form>
            </div> 

            <div class="content">

                <div class="main">
                    
                    <?php

                    $search = "%%"; 
                    $i = 0;
                    if ($_SERVER["REQUEST_METHOD"] == "GET")
                    {
                        if(!empty($_GET["search"]))
                        {
                            $search=trim($_GET["search"]);
                        }
                    }     
                    require_once 'includes/dbh.inc.php';


                    if (isset($_GET["submit"]))
                    {
                        $sql = "SELECT e.engineerID AS engineerID, e.first_name AS first_name, e.last_name AS last_name, e.occupation AS occupation, e.year_of_experience AS year_of_experience, e.skills AS skills, e.salary AS salary, e.start_date AS start_date, p.objectID AS profile_image, d.score AS dkm
                        FROM engineer e, dkm d, profile_image p, psv i, mock_interview m, interview l 
                        WHERE  
                        e.engineerID = d.engineerID AND
                        e.engineerID = p.engineerID AND
                        e.engineerID = i.engineerID AND
                        e.engineerID = m.engineerID AND
                        e.engineerID = l.engineerID AND
                        d.engineerID = p.engineerID AND
                        d.engineerID = i.engineerID AND
                        d.engineerID = m.engineerID AND
                        d.engineerID = l.engineerID AND
                        p.engineerID = i.engineerID AND
                        p.engineerID = m.engineerID AND
                        p.engineerID = l.engineerID AND
                        i.engineerID = m.engineerID AND
                        i.engineerID = l.engineerID AND
                        m.engineerID = l.engineerID AND
                        m.mock_interview_video IS NOT NULL AND m.mock_interview_video<>'' AND
                        l.status = 'scheduled' AND
                        (first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR e.occupation LIKE '%$search%' OR year_of_experience LIKE '%$search%' OR skills LIKE '%$search%' OR salary LIKE '%$search%' OR start_date LIKE '%$search%')";


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

                        ?>

                            <form class="form" action="" method="POST">
                                <div class="card">
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

                                        <label for="offer_start_date">* Offer Start Date</label>
                                        <input type="date" name="offer_start_date" class="form-control" value="<?php //echo $salary;?>"/>
                                        <p style="color:red"><?php //echo $salary_err; ?></p>

                                        <label for="offer_end_date">* Offer End Date</label>
                                        <input type="date" name="offer_end_date" class="form-control" value="<?php //echo $salary;?>"/>
                                        <p style="color:red"><?php //echo $salary_err; ?></p>

                                        <label for="offer_salary">* Offered Salary($AUS)</label>
                                        <input type="text" name="offer_salary" class="form-control" value="<?php //echo $salary;?>"/>
                                        <p style="color:red"><?php //echo $salary_err; ?></p>

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
                                        <label for="offer_start_date">* Offer Start Date</label>

                                    </div> 

                                    <div class="acceptreject">
                                        <input type="submit" class="btn" value="Accept Candidate" name="acandidate"></br>
                                        <input type="submit" class="btn" value="Reject Candidate" name="rcandidate">
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
                        require_once 'includes/dbh.inc.php';
                        $sql = "SELECT e.engineerID AS engineerID, e.first_name AS first_name, e.last_name AS last_name, e.occupation AS occupation, e.year_of_experience AS year_of_experience, e.skills AS skills, e.salary AS salary, e.start_date AS start_date, p.objectID AS profile_image, d.score AS dkm
                        FROM engineer e, dkm d, profile_image p, psv i, mock_interview m, interview l 
                        WHERE 
                        e.engineerID = d.engineerID AND
                        e.engineerID = p.engineerID AND
                        e.engineerID = i.engineerID AND
                        e.engineerID = m.engineerID AND
                        e.engineerID = l.engineerID AND
                        d.engineerID = p.engineerID AND
                        d.engineerID = i.engineerID AND
                        d.engineerID = m.engineerID AND
                        d.engineerID = l.engineerID AND
                        p.engineerID = i.engineerID AND
                        p.engineerID = m.engineerID AND
                        p.engineerID = l.engineerID AND
                        i.engineerID = m.engineerID AND
                        i.engineerID = l.engineerID AND
                        m.engineerID = l.engineerID AND
                        m.mock_interview_video IS NOT NULL AND m.mock_interview_video<>'' AND
                        l.status = 'scheduled' ";
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
                        ?>
                            <form class="form" action="" method="POST">
                                <div class="card">

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
                                        
                                        <label for="offer_start_date">* Offer Start Date</label>
                                        <input type="date" name="offer_start_date" class="form-control" value="<?php //echo $salary;?>"/>
                                        <p style="color:red"><?php //echo $salary_err; ?></p>

                                        <label for="offer_end_date">* Offer End Date</label>
                                        <input type="date" name="offer_end_date" class="form-control" value="<?php //echo $salary;?>"/>
                                        <p style="color:red"><?php //echo $salary_err; ?></p>

                                        <label for="offer_salary">* Offered Salary($AUS)</label>
                                        <input type="text" name="offer_salary" class="form-control" value="<?php //echo $salary;?>"/>
                                        <p style="color:red"><?php //echo $salary_err; ?></p>

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

                                    <div class="acceptreject">
                                        <input type="submit" class="btn" value="Accept Candidate" name="acandidate"></br>
                                        <input type="submit" class="btn" value="Reject Candidate" name="rcandidate">
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

  