<!DOCTYPE html>
<html>
<head>
<title>YourS3objects</title>

</head>


<style>
body {
    font-family: Sans-serif;
}

.titlebar {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    background-color: #27252E;
    min-height: 25px;
    z-index: 1;
    vertical-align: middle;
    border-spacing: 0;
    color: white;
    font-size: 28px;
}

.overview {
    word-wrap: break-word;
    overflow-wrap: break-word; 
    font-family: Sans-serif;
    font-size: 16px;
    border-radius: 5px;
	padding: 10px;
	background-color: white;
	border: 2px solid #27252E;
	max-width: 80%;
	margin: auto;	
}

.popup {
    position: absolute;
    top: 180px;
    left: 30%;
    min-width: 40%;
    background-color: white;
    max-height: 500px;
    overflow: auto;
    z-index: 1;
    word-wrap: break-word;
    overflow-wrap: break-word; 
    font-family: Sans-serif;
    font-size: 16px;
    border-radius: 5px;
    padding: 15px;
    border: 2px solid #27252E;
    box-shadow: 0px 0px 5px 0px black;
}

.closepopup {
	position: absolute;
	top: 15px;
	right: 15px;
	max-width: 10%;

}

.addObject {
	position: fixed;
	bottom: 25px;
	right: 25px;
	max-width: 50px;

}


</style>
<body>
<table class='titlebar' cellpadding='5px'><tr><td>Your S3 Objects</td><tr></table><br><br><br>
<?php
	//S3 account credentials
	require '/var/www/vendor/autoload.php'; // Include the AWS SDK for PHP library

	use Aws\S3\S3Client;

	// Set up an S3 client
	//keys are created in the Minio console, may need to recreate them
	//The keys can also use the ROOT Minio user credentials, but should not as a best practice
	$s3 = new S3Client([
		'version' => 'latest',
		'region' => 'us-east-1',
		'endpoint' => 'http://minio:9000',
		'use_path_style_endpoint' => true,
		'credentials' => [
		    'key' => 'minioadmin',
		    'secret' => 'minioadmin',
		],
	]);
	
	// Specify the bucket name and key name for the object you want to upload
	$bucketName = 'uploads';

	//specify the host address or domain name of the server (http://localhost:9090 is the default in the provided Docker containers)
	$hostName = "http://localhost:9090"; 


?>

