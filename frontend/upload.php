<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.<br>";
    $uploadOk = 0;
}

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

// Free the private Key.
openssl_free_key($privateKey);

$nodesArr = [
    'http://localhost:91',
    'http://localhost:92',
    'http://localhost:93'
];

$path = 'uploads/';
$files = array_values(array_diff(scandir($path), array('.', '..')));
$file_name_with_full_path = realpath('uploads/'.$files[0]);

$target_url = $nodesArr[array_rand($nodesArr)];


$args['file'] = new CurlFile('uploads/test.txt', 'text/plain');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$target_url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
$result = curl_exec ($ch);
curl_close ($ch);

unlink($file_name_with_full_path);
