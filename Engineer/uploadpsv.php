<!-- <!DOCTYPE html>
<html>
<head>
	<title>Feedback Form</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<h1>Feedback Form</h1>
	<button onclick="getFeedback()">Leave Feedback</button>

	<script>
		function getFeedback() {
			var feedback = prompt("Please enter your feedback:");
			if (feedback != null && feedback != "") {
				$.ajax({
					url: "save_feedback.php",
					type: "POST",
					data: { feedback: feedback },
					success: function(response) {
						alert("Thank you for your feedback!");
					},
					error: function(xhr, status, error) {
						alert("An error occurred while saving your feedback.");
						console.log(error);
					}
				});
			}
		}
	</script>
</body>
</html> -->















<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
    <?php
	 

	if(isset($_FILES['resume'])){

	$file_name = $_FILES['resume']['name'];
	echo "<1></br>".$file_name;
	$temp_file_location = $_FILES['resume']['tmp_name']; 
	 	$file_size = $_FILES['resume']['size'];
	  	$file_error = $_FILES['resume']['error'];
	 	$bucket = 'enginerayprojectstack-engineraybucket2b983bf9-9flhu9hi3w15';
		$region = 'us-east-2';		
		
		
	 	$fileExt =explode('.', $file_name);
		$fileActualExt=strtolower(end($fileExt));
		$fileAllowed = array('mp4','docx'); 
	
		if(in_array($fileActualExt, $fileAllowed)){
			if($file_error === 0){
				if($file_size < 500000000){ //5000000b=5mb
					
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
				echo "2... <br/>";
				$resumeID = "https://".$bucket.".s3.".$region.".amazonaws.com/".$file_name;
				echo "ID name:".$resumeID;
				//https://enginerayprojectstack-engineraybucket2b983bf9-9flhu9hi3w15.s3.us-east-2.amazonaws.com/demo.mp4
				//var_dump($result);
                }
            }
        }
	}
?>
        <form action="" method="post" enctype="multipart/form-data">
            <br/>
            <input type="file" name="resume" /><br/>	
            <input type="submit" name="upload" value="Upload"/><br/>							
		</form>
    </body>
</html>