<?php 
    session_start();
    $engineerID=$_SESSION["engineerID"];
    $first_name=$_SESSION["first_name"]; 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Employments page" />
		<meta name="keywords"    content="my employments" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/myOffers_style.css">
        
        <title>EngineRay | My Employments</title>
    
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
                <a target="_top" href="my_offers_eng.php">My Offers</a><br/>
                <a class="active" target="_top" href="my_employments_eng.php">My Employments</a><br/>
                <a target="_top" href="my_payslips_eng.php">My Payslips</a><br/>
            </div> 

            <div class="content">
                <h1 class="content">My Employments</h1>
                <p class="content">View my EngineRay employment history here.</p>
                
                <?php
                $message="";
                echo $message;

                require_once "dbh.inc.php";

                $sqlstring="SELECT c.company_name AS company_name, o.offer_occupation AS occupation, o.offer_start_date AS start_date, o.offer_end_date AS end_date, o.contract_link AS contract_link, o.sign AS sign
                FROM company c,offer o
                WHERE c.companyID = o.companyID AND o. engineerID ='$engineerID'";
                $queryResult=@mysqli_query($dbConnect, $sqlstring)
                    or die("<p>Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($dbConnect).": ".mysqli_error($dbConnect)."</p>");
                $row=mysqli_fetch_assoc($queryResult);
                // print_r($row);
                if($row==0){
                    echo "<h1>Ah-Oh! You don't have any employment yet.</h1>";
                }else{
                    echo "<table width='100%' border='1' text-align='center'>";
                    echo "<tr><th></th><th>Company Name</th><th>Occupation</th><th>Start Date</th><th>End Date</th><th>Contract</th><th>Status</th></tr>";
                    $i=1;
                    while($row){
                        $contract_link=$row['contract_link'];
                        echo "<tr style='text-align:center'><td>$i</td>";
                        echo "<td>".$row['company_name']."</td>";
                        echo "<td>".$row['occupation']."</td>";
                        echo "<td>".$row['start_date']."</td>";
                        echo "<td>".$row['end_date']."</td>";
                        echo "<td><a href='$contract_link'>Contract.pdf</a></td>";
                        if($row['sign']==""){
                            echo "<td>Wait to be signed</td>";
                        }else{
                            echo "<td>Signed</td></tr>";
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