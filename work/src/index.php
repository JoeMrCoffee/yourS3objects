<?php include 'header.php';
	
	$iterator = $s3->getIterator('ListObjects', array(
    	'Bucket' => $bucketName
	));
	
	echo "<div class='overview'><ul>";
	foreach ($iterator as $object) {
		$objectKey = $object['Key'];
		echo "<li><form action='submitFile.php' method='post'><a href='$hostName/$bucketName/$objectKey'>$objectKey</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type='hidden' name='bucket' value='$bucketName'>
				<input type='hidden' name='objectToDel' value='$objectKey'>
				<input type='submit' name='delObject' value='DELETE' onclick='return confirmfunction()'>
			</form></li>" ;
	}
	
	echo "</ul></div>";
	
	echo "<img src='addObject.png' class='addObject' onclick='addObject()'>
		<div class='popup' id='addObjectForm' style='visibility: hidden;'>
			<img class='closepopup' onclick='addObject()' src='close.png'>
			<form action='submitFile.php' method='post' enctype='multipart/form-data'>
			<p>Choose an image to upload: <input type='file' name='postobject'></p>
			<p><input type='submit' name='addObject'></p>
			</form>
		</div>";
	

/* Additional references:
	- https://www.stackhero.io/en/services/MinIO/documentations/Getting-started/Connect-to-MinIO-from-PHP
	- https://www.php.net/manual/en/features.file-upload.post-method.php
	- https://www.linode.com/docs/products/storage/object-storage/guides/aws-sdk-for-php/
*/
?>
</body>
<script>
	function addObject() {
		var groupform = document.getElementById('addObjectForm');
		if (groupform.style.visibility == 'hidden') {
				groupform.style.visibility = 'visible';
				scroll(0,0); //moves to top of page in case of tall images
		} 
		else { groupform.style.visibility = 'hidden'; }
	}
	
	function confirmfunction() { return confirm('Do you really want to delete this object?'); 	}

</script>
</html>
