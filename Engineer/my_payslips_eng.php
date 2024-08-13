<?php 
    session_start();
    $engineerID=$_SESSION["engineerID"];
    $first_name=$_SESSION["first_name"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Payslips page" />
		<meta name="keywords"    content="my payslips" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/myOffers_style.css">
        
        <title>EngineRay | My Payslips</title>
    
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
                <a target="_top" href="my_employments_eng.php">My Employments</a><br/>
                <a class="active" target="_top" href="my_payslips_eng.php">My Payslips</a><br/>
            </div> 

            <div class="content">
                <h1 class="content">My Payslips</h1>
                <p class="content">View my payslip history here.</p>
                <?php

                require_once "dbh.inc.php";

                $sqlstring="SELECT c.company_name AS company_name, o.offer_occupation AS occupation, p.pay_date AS pay_date, p.link AS link, p.status AS status
                FROM company c,offer o, payslip p
                WHERE c.companyID = o.companyID AND c.companyID=p.companyID AND o.companyID=p.companyID AND o.engineerID = p.engineerID AND o.engineerID='$engineerID' AND p.engineerID='$engineerID'";
                
                $queryResult=@mysqli_query($dbConnect, $sqlstring)
                    or die("<p>1..Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($dbConnect).": ".mysqli_error($dbConnect)."</p>");
                $row=mysqli_fetch_assoc($queryResult);
                
                if($row==0){
                    echo "<h1>Ah-Oh! You don't have any payslip yet.</h1>";
                }else{
                    echo "<table width='100%' border='1' text-align='center'>";
                    echo "<tr><th></th><th>Company Name</th><th>Occupation</th><th>Pay Date</th><th>Payslip</th><th>Status</th></tr>";
                    $i=1;
                    while($row){
                        $payslip_link=$row['link'];
                        echo "<tr style='text-align:center'><td>$i</td>";
                        echo "<td>".$row['company_name']."</td>";
                        echo "<td>".$row['occupation']."</td>";
                        echo "<td>".$row['pay_date']."</td>";
                        echo "<td><a href='$payslip_link'>Pay slip.pdf</a></td>";
                        if($row['status']==""){
                            echo "<td>Pending</td></tr>";
                        }else{
                            echo "<td>".$row['status']."</td>";
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