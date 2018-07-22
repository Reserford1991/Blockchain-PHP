<?php

echo "Node 3" . "<br>";;

$id = file_get_contents(dirname(dirname(__DIR__)). '/configs/node-3.txt');


$id1 = hash('sha256', $id);
$id2 = hash('sha256', $id);

echo md5($id1) . '<br>';
echo md5($id2) . '<br>';;

if(hash_equals($id1, $id2)) {
    echo "Key are identical" . '<br>';
}

echo $id;

file_put_contents(__DIR__."/log.txt", $id);