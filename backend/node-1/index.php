<?php

echo "Node 1<br>";

//// generate private and public open ssl keys
//
//$privateKey = openssl_pkey_new(array(
//    'private_key_bits' => 2048,      // Size of Key.
//    'private_key_type' => OPENSSL_KEYTYPE_RSA,
//));
//// Save the private key to private.key file. Never share this file with anyone.
//openssl_pkey_export_to_file($privateKey, 'keys/private.key');
//
//// Generate the public key for the private key
//$a_key = openssl_pkey_get_details($privateKey);
//// Save the public key in public.key file. Send this file to anyone who want to send you the encrypted data.
//file_put_contents('keys/public.key', $a_key['key']);
//
//// Free the private Key.
//openssl_free_key($privateKey);

$uploaddir = 'uploads/';

$uploadfile = $uploaddir . basename($_FILES['file']['name']);
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.<br>";
} else {
    echo "Possible file upload attack!<br>";
}

if(!isset($_POST['node'])){
    $nodesArr = [
        'http://localhost:92',
        'http://localhost:93'
    ];

    $path = 'uploads/';
    $files = array_values(array_diff(scandir($path), array('.', '..')));

    $target_url = $nodesArr[array_rand($nodesArr)];

    $target_url = $nodesArr[array_rand($nodesArr)];
    $file_name_with_full_path = realpath('uploads/'.$files[0]);
    $args['file'] = new CurlFile('uploads/test.txt', 'text/plain');
    $args['node'] = 'node-1';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$target_url);
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
    $result=curl_exec ($ch);
    curl_close ($ch);

    unlink($file_name_with_full_path);
}



