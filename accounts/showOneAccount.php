<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

global $db;
require_once '../config.php';

/* This File Is Assigned To Esrat Jahan Riya : @EsratRiya */

// Show One Account In The Database


$data = json_decode(file_get_contents("php://input"), true);
$account_id = $data['account_id'];

$sql = "SELECT * FROM accounts WHERE account_id = {$account_id}";

$result = mysqli_query($db, $sql) or die("SQL Query Failed.");

if(mysqli_num_rows($result) > 0){
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
}
else{
   echo json_encode(array('message' => 'No Record Found.','status' => false));
}


?>