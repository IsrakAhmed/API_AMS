<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

global $db;
require_once '../config.php';

/* This File Is Assigned To Esrat Jahan Riya : @EsratRiya */

// Show One Account In The Database


$data = json_decode(file_get_contents("php://input"), true);

if(empty($data['account_id'])){
    echo json_encode(array('message' => 'Account ID is required.', 'status' => false));
    die();
}

$account_id = $data['account_id'];

$stmt = $db->prepare("SELECT account_id, userid, account_title, account_type, balance, bank_name, branch_name, created_at, updated_at FROM accounts WHERE account_id = ?");
$stmt->bind_param("i", $account_id);
$stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) > 0){
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
}
else{
   echo json_encode(array('message' => 'No Record Found.','status' => false));
}


?>