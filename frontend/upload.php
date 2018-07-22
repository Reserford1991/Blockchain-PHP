<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
//if (file_exists($target_file)) {
//    echo "Sorry, file already exists.<br>";
//    $uploadOk = 0;
//}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.<br>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "txt") {
    echo "Sorry, only txt files are allowed.<br>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.<br>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
    } else {
        echo "Sorry, there was an error uploading your file.<br>";
    }
}

// Sending curl request with file and waiting for response

file_put_contents(__DIR__."/log.txt", __LINE__);

//phpinfo();

echo 'Curl: ', function_exists('curl_init') ? 'Enabled' : 'Disabled';


//Initialise the cURL var
$ch = curl_init();

//Get the response from cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//Set the Url
curl_setopt($ch, CURLOPT_URL, 'http://localhost:91');

//Create a POST array with the file in it
$postData = array(
    'testData' => '@/path/to/file.txt',
);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

// Execute the request
$response = curl_exec($ch);



//$key = file_get_contents(dirname( dirname(__FILE__) ). '/configs/key.txt');
//
//
//$key1 = hash('sha256', $key);
//$key2 = hash('sha256', $key);
//
//echo md5($key1) . '<br>';
//echo md5($key2) . '<br>';;
//
//if(hash_equals($key1, $key2)) {
//    echo "Key are identical";
//}
