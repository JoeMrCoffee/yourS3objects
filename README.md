### Your S3 Objects

Your S3 Objects is a simple PHP site just to demonstrate interacting and uploading files to an S3 object storage container. The goal is mostly just as a reference, but might be useful for browsing or uploading files to an S3 object store if user credentials need to be fixed. For example, if users have an open container for certain users, but don't wish them to have access to the whole backend of say a MinIO instance, this could be a simple way to grant limited access. 

The docker-comopse and dockerfile build the environment based on the php-apache repository, and install the PHP SDK needed to interact with S3 objects. A minio instance is also provided as a companion container, but it doesn't have to be used, in theory. 

#### Create a bucket

By default the environment expects there to be a bucket called 'uploads' in the Minio container. To get started one neeeds to log into the Minio container using the Minio dashboard and default credentials user: "minioadmin" , pwd: "minioadmin". All of this could be adjusted in the docker-compose.yml file. 

#### Basic usage

Pressing the plus button to show the pop up for uploading a file. Once uploaded press the back button to return to the home page and the new file should be shown. Clicking any file link will prompt for a download.

#### Adjust the max file size 

The max file size in the default Docker build is a max size of 20M. To adjust, change the dockerfile parameters in lines 7 and 8. 

    RUN sed -i 's/upload_max_filesize = 2M/upload_max_filesize = XXM/' /usr/local/etc/php/php.ini
    RUN sed -i 's/post_max_size = 8M/post_max_size = XXM/' /usr/local/etc/php/php.ini

#### Adjust S3 object store

To adjust the S3 object store environment, users can simply change the settings at the bottom of the header.php file. Changing the endpoint and the log in credentials can allow for essentially any S3 object storage to be used. 

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
