<?php
	include 'header.php';

	$postimage = basename($_FILES['postimage']['name']);
	$tmpimage = $_FILES['postimage']['tmp_name'];
	
	// Specify the file path and key name for the object you want to upload
	$keyName = $postimage;
	$filePath = $tmpimage;

	// Upload the JPEG file to S3
	try {
		$result = $s3->putObject([
		    'Bucket' => $bucketName,
		    'Key' => $keyName,
		    'SourceFile' => $filePath,
		]);

		// Print a message to confirm the file has been uploaded
		echo "<p class='overview'>{$keyName} has been uploaded to {$bucketName}!
			<br><br>	<a href='index.php'><button >< BACK</button></a></p>";
	} catch (Aws\Exception\S3Exception $e) {
		echo "<p class='overview'>There was an error uploading the file to S3: " . $e->getMessage()."</p>";
	}
		
	

/* Additional references:
	- https://www.stackhero.io/en/services/MinIO/documentations/Getting-started/Connect-to-MinIO-from-PHP
	- https://www.php.net/manual/en/features.file-upload.post-method.php
*/
?>
</body>
</html>
