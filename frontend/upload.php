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

$privateKey = openssl_pkey_new(array(
    'private_key_bits' => 2048,      // Size of Key.
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
));
// Save the private key to private.key file. Never share this file with anyone.
openssl_pkey_export_to_file($privateKey, 'keys/private.key');

$sslError = openssl_error_string();

if($sslError !== '') {
    print_r($sslError."<br>");
}

// Generate the public key for the private key
$a_key = openssl_pkey_get_details($privateKey);
// Save the public key in public.key file. Send this file to anyone who want to send you the encrypted data.
file_put_contents('keys/public.key', $a_key['key']);

// Free the private Key.
openssl_free_key($privateKey);

$nodesArr = [
    'http://localhost:91',
    'http://localhost:92',
    'http://localhost:93'
];

$path = 'uploads/';
$files = array_values(array_diff(scandir($path), array('.', '..')));

$target_url = $nodesArr[array_rand($nodesArr)];
$file_name_with_full_path = realpath('uploads/'.$files[0]);

$args['file'] = new CurlFile('uploads/test.txt', 'text/plain');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$target_url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
$result = curl_exec ($ch);
curl_close ($ch);

unlink($file_name_with_full_path);
