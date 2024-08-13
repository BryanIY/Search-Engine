<?php

require_once 'includes/dbh.inc.php';

$sql = "SELECT * FROM offer";
$offer = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay sub menu page" />
		<meta name="keywords"    content=" " />
		<meta name="author"      content="Cody" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style/sendoffer_style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
        <title> Send Offer </title>
</head>

        <header> <!-- at the top of the username logout things -->
            <div class="logo">
                <a href="index.php"><img src="image/11.png" alt="EngineRay Logo"></a>
            </div>
            <div class="user-info">
                <p class="username">Username</p>
                <a href="notification_eng.php" class="notification"><i class="fas fa-bell"></i></a>
                <a href="settings.php" class="settings"><i class="fas fa-cog"></i></a>
            </div>
        </header>

        <body>

        
        
        <!-- navigation -->
        <nav class="topnav">
            <ul>
                <li><a href="findengineers.php">Find Engineers</a></li>
                <li><a href="mycandidates.php">My Candidates</a></li>
                <li><a href="hiredengineers.php">Hired Engineers</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
            </ul>
        </nav>

        <div class="whole">
          
            <h2>Congradulation! You passed our interview, now please check your Offer.</h2>

                <form action="" method="POST">

                <label for="offer_occupation">Occupation:</label>
                    <?php
                            $occupations = file("materials/occupation.txt"); //load occupations to $occupations array;
                            echo "<select name='offer_occupation' class='form-control'>";
                            for ($i = 0; $i < count($occupations); $i++) 
                            {   
                                $occupation_option=$occupations[$i];
                                echo "<option value='$occupation_option'>". $occupation_option . "</option>"; 
                            }
                            echo "</select><br/><br/>";   
                    ?>
                    <p style="color:red"><?php //echo $occupation_err; ?></p>

                    <label for="offer_start_date">* Offer Start Date</label>
                    <input type="date" name="offer_start_date" class="form-control" value="<?php //echo $salary;?>"/><br/><br/>
                    <p style="color:red"><?php //echo $salary_err; ?></p>

                    <label for="offer_end_date">* Offer End Date</label>
                    <input type="date" name="offer_end_date" class="form-control" value="<?php //echo $salary;?>"/><br/><br/>
                    <p style="color:red"><?php //echo $salary_err; ?></p>

                    <label for="offer_salary">* Offerred Salary($AUS)</label>
                    <input type="text" name="offer_salary" class="form-control" value="<?php //echo $salary;?>"/><br/><br/>
                    <p style="color:red"><?php //echo $salary_err; ?></p>

                    <!-- submit button -->
                    <input class="btn" type="submit" value="submit" name="submit">


                </form>
                <div class="profile">
                    <?php 

                        $offer_occupation=$offer_start_date=$offer_end_date=$offer_salary="";
                        $offer_occupation_err=$offer_start_date_err=$offer_end_date_err=$offer_salary_err="";
                        $i = 0;


                        if($_SERVER["REQUEST_METHOD"]=="POST")
                        {
                            
                            //Fields validation
                            
                            if(trim($_POST["offer_occupation"])=="Please select your offerred occupation"){
                                $offer_occupation_err="Please choose your offerred occupation!";
                            }else{
                                $offer_occupation=trim($_POST["offer_occupation"]);
                            }

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

                            if(trim($_POST["offer_salary"])=="Please select your offer salary"){
                                $offer_salary_err="Please select your offer salary!";
                            }else{
                                $offer_salary=trim($_POST["offer_salary"]);
                            }
                            
                        }
                        
                        require_once 'includes/dbh.inc.php';

                        if (isset($_GET["submit"]))
                        {
                                $sql = "SELECT * FROM offer WHERE offer_occupation LIKE '$offer_occupation' AND offer_start_date LIKE '$offer_start_date' AND offer_end_date >= '$offer_end_date' AND offer_salary LIKE '$offer_salary'";
                            
                                $queryResult=@mysqli_query($conn, $sql)
                                or die("<p>Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($conn).": ".mysqli_error($conn)."</p>");
                                

                                $row=mysqli_fetch_assoc($queryResult);
                        }

                       
                    ?>

                        
                  
                

   


        </div>


</body>
</html>

