<?php 
    session_start();
    $engineerID=$_SESSION["engineerID"];
    $first_name=$_SESSION["first_name"]; 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Profile Image page" />
		<meta name="keywords"    content="my profile image, upload" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/profile_image_style.css">
        
        <title>EngineRay | My Profile Image</title>
    
    </head>
    <body>
<?php	
	$profile_img_err=$objectID="";

	if(isset($_FILES['profile_img'])){

		$file_name = $_FILES['profile_img']['name'];
		//echo  "<br>2. filename:".$file_name;
		$temp_file_location = $_FILES['profile_img']['tmp_name']; 
	 	$file_size = $_FILES['profile_img']['size'];
	 	$file_error = $_FILES['profile_img']['error'];
		$bucket = 'enginerayprojectstack-engineraybucket2b983bf9-9flhu9hi3w15';
		$region = 'us-east-2';		
		
		
		$fileExt =explode('.', $file_name);
		$fileActualExt=strtolower(end($fileExt));
		$fileAllowed = array('jpg','jpeg','png'); 
	
		if(in_array($fileActualExt, $fileAllowed)){
			if($file_error === 0){
				if($file_size < 5000000){ //5000000b=5mb
					
				require 'aws-autoloader.php';	
			//	use aws\Aws\S3\S3Client;
			//	use \Aws\S3\Exception\S3Exception;

				$s3 = new Aws\S3\S3Client([
					'region'  => $region	,
					'version' => 'latest',
					'credentials' => [
						'key'    => "AKIAUTEXLE6CKXRRL4N4",
						'secret' => "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",
					]
				]);		

				$result = $s3->putObject([
					'Bucket' => $bucket,
					'Key'    => $file_name,
					'SourceFile' => $temp_file_location			
				]);
				$objectID = "https://".$bucket.".s3.".$region.".amazonaws.com/".$file_name;
				//echo "<br>3. objectID:". $objectID;
				//var_dump($result);
			
				require_once "dbh.inc.php";

				$sql = "UPDATE profile_image SET status=0, objectID = '$objectID' WHERE engineerID='$engineerID';";
				$result = mysqli_query($dbConnect, $sql);
				
				//$sql2 = "UPDATE engineer SET objectID = '$objectID' WHERE engineerID='$engineerID';";
				//$result = mysqli_query($dbConnect, $sql2);
				//header("Location: profile_image_eng.php?uploadsuccessfully");

				//mysqli_close($dbConnect);

				//$fileNameNew = "profile".$engineerID.".".$fileActualExt;
				//$fileDestination = 'profile_img/'.$fileNameNew;
					
				}else{
					$profile_img_err= "Your profile image is too big!";
				}
			}else{
				$profile_img_err= "There was an error uploading your profile image!";
			}
		}else{
			$profile_img_err= "Please uplaod your profile image in 'jpg', 'jpeg', or 'png' type!";
		}		
	}
?>
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
                <a target="_top" href="my_profile_eng.php">My Profile</a><br/>
				<a class="active" target="_top" href="profile_image_eng.php">My Profile Image</a><br/>
				<a target="_top" href="my_resume_eng.php">My Resume</a><br/>
                <a target="_top" href="my_work_avbly_eng.php">My Work Availability</a><br/>
            </div>
			<div class="content">
				<h1 class="content">  My Profile Image </h1>
                <p class="content">An impressive profile shows your professions.</p>
				<div class="cards">
                    <div class="card">
						<br/>
						<p>To change your profile image, please select your file and hit "Update" button.</p>
						<p>Please note that your profile image size should be smaller than 5 MB and should be in 'jpg', 'jpeg', or 'png' type.</p>
						<br/>
					<?php 
							require_once "dbh.inc.php";

							$sqlImg = "SELECT status, objectID FROM profile_image WHERE engineerID='$engineerID'";
							$resultImg = mysqli_query($dbConnect,$sqlImg);
							$imgrow = mysqli_fetch_assoc($resultImg);
							echo "<div class='image'>";
							if($imgrow['status']==0){
								$objectID=$imgrow["objectID"];
								echo "<img src='{$objectID}' alt='My Profile Image'>";
							}else{
								$bucket = 'enginerayprojectstack-engineraybucket2b983bf9-9flhu9hi3w15';
								$region = 'us-east-2';
								//show default profile img
								$defaultImg="https://".$bucket.".s3.".$region.".amazonaws.com/defaultProfile.jpg";
								echo '<img src="'.$defaultImg.'"  alt="Default Profile Image">';
								//echo '<img src="images/defaultProfile.jpg"  alt="Default Profile Image">';
							}
							echo "</div>";	
							mysqli_close($dbConnect);
						?>
                        
						<form action="" method="post" enctype="multipart/form-data">
							<br/>
							<input type="file" name="profile_img" /><br/>
							<p style="color:red"><?php echo $profile_img_err; ?></p>
							<input type="submit" name="update" value="Update"/><br/>							
						</form>
                    </div>
                </div>
			</div>
		</div>
	</body>

</html>
