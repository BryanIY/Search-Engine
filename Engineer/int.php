	<?php
	if(isset($_FILES['image'])){
		$file_name = $_FILES['image']['name'];   
		$temp_file_location = $_FILES['image']['tmp_name']; 

		require 'aws-autoloader.php';	
	//	use aws\Aws\S3\S3Client;
	//	use \Aws\S3\Exception\S3Exception;

		$s3 = new Aws\S3\S3Client([
			'region'  => 'us-east-2'	,
			'version' => 'latest',
			'credentials' => [
				'key'    => "AKIAUTEXLE6CKXRRL4N4",
			    'secret' => "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",
			]
		]);		

		$result = $s3->putObject([
			'Bucket' => 'enginerayprojectstack-engineraybucket2b983bf9-9flhu9hi3w15',
			'Key'    => $file_name,
			'SourceFile' => $temp_file_location			
		]);
		$object_id = $temp_file_location;
		echo $object_id;
		//var_dump($result);
	}
?>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">         
	<input type="file" name="image" />
	<input type="submit"/>
</form>      