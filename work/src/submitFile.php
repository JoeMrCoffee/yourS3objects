<?php
	include 'header.php';

	$postobject = basename($_FILES['postobject']['name']);
	$tmpobject = $_FILES['postobject']['tmp_name'];

	// Specify the file path and key name for the object you want to upload
	$keyName = $postobject;
	$filePath = $tmpobject;
	// Upload the file to S3
	if (isset($_POST['addObject'])){
	
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
	}
	// Delete the file from S3
	else if (isset($_POST['delObject'])){
		$objectToDel = $_POST['objectToDel'];
		try {
			$result = $s3->deleteObject([
				'Bucket' => $bucketName,
				'Key' => $objectToDel,
			]);

			// Print a message to confirm the file has been uploaded
			echo "<p class='overview'>$objectToDel has been deleted from {$bucketName}!
				<br><br>	<a href='index.php'><button >< BACK</button></a></p>";
		} catch (Aws\Exception\S3Exception $e) {
			echo "<p class='overview'>There was an error deleting the file in S3: " . $e->getMessage()."</p>";
		}
	}
	

/* Additional references:
	- https://www.stackhero.io/en/services/MinIO/documentations/Getting-started/Connect-to-MinIO-from-PHP
	- https://www.php.net/manual/en/features.file-upload.post-method.php
	- https://www.linode.com/docs/products/storage/object-storage/guides/aws-sdk-for-php/
*/
?>
</body>
</html>
