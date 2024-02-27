<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allow-Methods, Authorization, X-Requested-With');

global $db;
require_once '../config.php';

/* This File Is Assigned To Bakhtiar Sahib Rizvi : @BakhtiarSahib */

// Update An Account


// Start Writing Your Code From Here






$data = json_decode(file_get_contents("php://input"), true);

if (
    empty($data['account_id']) ||
    empty($data['account_title']) ||
    empty($data['account_type']) ||
    empty($data['balance']) ||
    empty($data['bank_name']) ||
    empty($data['branch_name']) 
   
) {
    echo json_encode(array('message' => 'Missing required fields', 'status' => false));
    exit();
}





if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Update a user
$account_id = $data['account_id'];
$account_title = $data['account_title'];
$account_type = $data['account_type'];
$balance = $data['balance'];
$bank_name = $data['bank_name'];
$branch_name = $data['branch_name'];

$stmt = $db->prepare("UPDATE accounts SET account_title = ?, account_type = ?, balance = ?, bank_name = ?, branch_name = ? WHERE account_id = ?");
$stmt->bind_param("sssssi", $account_title, $account_type, $balance, $bank_name, $branch_name, $account_id);

if ($stmt->execute()) {
    echo json_encode(array('message' => 'User Updated Successfully', 'status' => true));
} else {
    echo json_encode(array('message' => 'User Not Updated', 'status' => false));
}

$stmt->close();
$db->close();



?>