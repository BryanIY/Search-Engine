<?php 
    session_start();
    $engineerID=$_SESSION["engineerID"];
    $first_name=$_SESSION["first_name"];
    //if($_SESSION["offerID"]!=""){
        //$offerID=$_SESSION["offerID"];
    //}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Offers page" />
		<meta name="keywords"    content="my offers, my employments, my payments" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/myOffers_style.css">
        
        <title>EngineRay | My Offers</title>
    
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
                <a class="active" target="_top" href="my_offers_eng.php">My Offers</a><br/>
                <a target="_top" href="my_employments_eng.php">My Employments</a><br/>
                <a target="_top" href="my_payslips_eng.php">My Payslips</a><br/>
            </div> 

            <div class="content">
                <h1 class="content">My Offers</h1>
                <p class="content">View and choose to accept/reject an offer received.</p>
                
                <div>
                <?php 
                        
                    ?>
                    <?php
                        $message="";
                        echo $message;

                        require_once "dbh.inc.php";
                        
                        $sqlstring="SELECT c.company_name AS company_name,o.offerID AS offerID, o.offer_occupation AS offer_occupation, o.offer_start_date AS start_date, o.offer_end_date AS end_date, o.offer_salary AS offer_salary, o.status AS status
                        FROM company c,offer o
                        WHERE c.companyID = o.companyID AND o.engineerID='$engineerID'";
                        $queryResult=@mysqli_query($dbConnect, $sqlstring)
                            or die("<p>1..Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($dbConnect).": ".mysqli_error($dbConnect)."</p>");
                        $row=mysqli_fetch_assoc($queryResult);
                        
                        if($row==0){
                            echo "<h1>Ah-Oh! You have not received any offer yet.</h1>";
                        }else{
                            echo "<table width='100%' border='1' text-align='center'>";
                            echo "<tr><th></th><th>Company Name</th><th>Offered Occupation</th><th>Start Date</th><th>End Date</th><th>Offered Salary</th><th>Action</th><th></th></tr>";
                            $i=1;
                            while($row){
                                $offerID=$row['offerID'];
                                echo "<tr style='text-align:center'><td>$i</td>";
                                echo "<td>".$row['company_name']."</td>";
                                echo "<td>".$row['offer_occupation']."</td>";
                                echo "<td>".$row['start_date']."</td>";
                                echo "<td>".$row['end_date']."</td>";
                                echo "<td>".$row['offer_salary']."</td>";
                                if($row['status']=="sent"){
                                    echo "<td><form action='' method='post'><select name='action{$offerID}'>"; 
                                    echo "<option value=''></option>";
                                    echo "<option value='accept'>Accept</option>";
                                    echo "<option value='reject'>Reject</option>";
                                    echo "</select></td>";
                                    echo "<td><input type='submit' name='submit' value='Confirm'></form></td></tr>";
                                    $_SESSION["offerID"]=$offerID;
                                }else{
                                    echo "<td>".$row['status']."</td><td>Completed</td></tr>";
                                }
                                $i++;
                                $row=mysqli_fetch_assoc($queryResult);
                                
                            }
                            echo "</table>";
                        }

                        if(isset($_POST['submit']) && isset($_POST["action{$offerID}"])){
                            require_once "dbh.inc.php";

                           if(($_POST["action{$offerID}"])=="accept"){
                            $sqlstring="UPDATE offer SET status='Accepted' WHERE offerID ='$offerID'";
                            $queryResult=@mysqli_query($dbConnect, $sqlstring)
                                or die("<p>1..Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($dbConnect).": ".mysqli_error($dbConnect)."</p>");
                            
                           }elseif($_POST["action{$offerID}"]=="reject"){
                            $sqlstring="UPDATE offer SET status='Rejected' WHERE offerID ='$offerID'";
                            $queryResult=@mysqli_query($dbConnect, $sqlstring)
                                or die("<p>1..Unable to execute the query.</p>"."<p>Error Code ". mysqli_errno($dbConnect).": ".mysqli_error($dbConnect)."</p>");
                           }else{
                             echo "<h3>Please choose to accept or reject the offer!</h3>";
                           }
                           
                        }
                        mysqli_close($dbConnect);
                    ?>

                    
                </div>
                
                
                
            </div>
        </div>
        
        
        <!-- <div class="footer">
            
        </div> -->

    </body>
</html>