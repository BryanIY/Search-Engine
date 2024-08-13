<?php 
    session_start();
    $engineerID=$_SESSION["engineerID"];
    $first_name=$_SESSION["first_name"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
		<meta name="description" content="EngineRay Engineer's My Resume page" />
		<meta name="keywords"    content="my Resume, upload" />
		<meta name="author"      content="Serena Wu" /> 
		<meta name="viewpoint"   content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/myresume_style.css">
        
        <title>EngineRay | My Resume</title>
    
    </head>
    <body>
	<?php
	
	$resume_err="";

	if(isset($_FILES['resume'])){

		$file_name = $_FILES['resume']['name'];
		//echo $file_name;
		$temp_file_location = $_FILES['resume']['tmp_name']; 
	 	$file_size = $_FILES['resume']['size'];
	 	$file_error = $_FILES['resume']['error'];
		$bucket = 'enginerayprojectstack-engineraybucket2b983bf9-9flhu9hi3w15';
		$region = 'us-east-2';		
		
		
		$fileExt =explode('.', $file_name);
		$fileActualExt=strtolower(end($fileExt));
		$fileAllowed = array('pdf','docx'); 
	
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
				$resumeID = "https://".$bucket.".s3.".$region.".amazonaws.com/".$file_name;
				
			
			    require_once "dbh.inc.php";

					$sql = "UPDATE engineer SET resumeID = '$resumeID' WHERE engineerID='$engineerID';";
					$result = mysqli_query($dbConnect, $sql);
					
					//header("Location: profile_image_eng.php?uploadsuccessfully");

					//mysqli_close($dbConnect);
	
					//$fileNameNew = "profile".$engineerID.".".$fileActualExt;
					//$fileDestination = 'profile_img/'.$fileNameNew;
					
				}else{
					$resume_err= "Your resume file is too big!";
				}
			}else{
				$resume_err= "There was an error uploading your resume!";
			}
		}else{
			$resume_err= "Please uplaod your resume file in 'pdf' or 'docx' type!";
		}		
	}

?>
		<header>
            <div class="logo">
                <a href="dash_eng.php"><img src="images/logo.png" alt="EngineRay Logo"></a>
            </div>
            <div class="user-info">
                <p class="username"><?php echo $first_name; ?></p>
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
				<a target="_top" href="profile_image_eng.php">My Profile Image</a><br/>
				<a class="active" target="_top" href="my_profile_eng.php">My Resume</a><br/>
                <a target="_top" href="my_work_avbly_eng.php">My Work Availability</a><br/>
            </div>
			<div class="content">
				<h1 class="content"> My Resume </h1>
                <p class="content">A nice resume delivers you more opportunities.</p>

				<div class="cards">
                    <div class="card">
						<br/>
						<?php
							require_once "dbh.inc.php";

							$sql = "SELECT resumeID FROM engineer WHERE engineerID='$engineerID';";
							$result = mysqli_query($dbConnect, $sql);
							$row=mysqli_fetch_assoc($result);
							
							if($row["resumeID"]==""){
								echo "<h1>You haven't upload your resume yet.</h1>";
							}else{
								$resumeID=$row['resumeID'];
								echo "<p>You have uploaded your resume already.</p><br/><p><a href='$resumeID' target='_blank'>View My Resume</a></p>";
							}

							mysqli_close($dbConnect);

						?>
						
						<style>
							.card a:link {
								background-color:#786ee466;
								color: black;
								border: 2px solid purple;
								padding: 10px 20px;
								text-align: center;
								text-decoration: none;
								display: inline-block;
								border-radius: 0.375em;
							}
							.card a:hover{
							background-color:#E2EFF3;
							color: blcak;
							text-transform: uppercase;
							}
						</style>
						<br/>
						<p>To update your resume, please select your file and hit "Upload" button.</p>
						<p>Please note that your resume file size should be smaller than 5 MB and should be in 'pdf' or 'docx' type.</p>
						<br/>
                        
						<form action="" method="post" enctype="multipart/form-data">
							<br/>
							<input type="file" name="resume" /><br/>	
							<p style="color:red"><?php echo $resume_err; ?></p><br/>
							<input type="submit" name="upload" value="Upload"/><br/>							
						</form>
                    </div>
                </div>
			</div>
		</div>
	</body>

</html>
