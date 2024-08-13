<!DOCTYPE HTML>
<html lang="en">

<head>
<meta charset="utf-8" />
		<meta name="description" content="Contact Us Page" />
		<meta name="keywords"    content=" " />
        <meta name="author"      content="Cody" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="css/contactus_style.css">
        <title> Contact Us</title>
</head>

<body>
    <header> <!-- at the top of the username logout things -->
        <div class="logo">
            <a href="index.php"><img src="images/11.png" alt="EngineRay Logo"></a>
        </div>
        <div class="user-info">
            <p class="username">Username</p>
            <a href="notification_eng.php" class="notification"><i class="fas fa-bell"></i></a>
            <a href="settings.php" class="settings"><i class="fas fa-cog"></i></a>
        </div>
    </header>
        
    <!-- navigation -->
    <nav class="topnav">
        <ul>
            <li><a href="my_profile_eng.php">My Profile</a></li>
            <li><a href="dkm_eng.php">Domain Knowledge Metrics</a></li>
            <li><a href="my_interviews_eng.php">My Interviews</a></li>
            <li><a href="my_offers_eng.php">My Offers</a></li>
            <li><a href="contactus.php">Contact Us</a></li>
        </ul>
    </nav>

   <div class="container">

        <div class="col-lg-8 col-lg-offset-2">

            <h1>Contact Us from Engineray<a href="http://www.engineray.com" target="_blank"> Engineray.com</a></h1>

            

            <form id="contact-form" method="post" role="form">

                        <div class="messages"></div>

                        <div class="controls">

                            <div class="row">
                             
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="form_message">Message *</label>
                                        <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Leave us a message."></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="submit" name="submit" class="btn btn-success btn-send" value="Send message">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-muted"><strong>*</strong> These fields are required. Contact form by <a href="https://engineray.com" target="_blank">Engineray</a>.</p>
                                </div>
                            </div>
                        </div>

                    </form>
                    <?php 

                        if(isset($_POST['submit']))
                        {
                        include_once 'contactus_function.php';
                        $obj=new Contact();
                        $res=$obj->contact_us($_POST);
                        if($res==true)
                        {
                            echo "<script>alert('Query successfully Submitted.Thank you')</script>";
                        }else
                        {
                            echo "<script>alert('Query successfully Submitted.Thank you!!')</script>";
                        }
                        }
                    ?>

         </div><!-- /.8 -->

     </div> <!-- /.row-->

</div> <!-- /.container--> 

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="validator.js"></script>
        <script src="contact.js"></script>
</body>
</html>
