<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

global $db;
require_once '../config.php';

/* This File Is Assigned To Esrat Jahan Riya : @EsratRiya */

// Show One Transaction In The Database


$data = json_decode(file_get_contents("php://input"), true);

if(empty($data['transaction_id'])){
    echo json_encode(array('message' => 'Transaction ID is required.', 'status' => false));
    die();
}

$transaction_id = $data['transaction_id'];

$stmt = $db->prepare("SELECT transaction_id FROM transactions WHERE transaction_id = ?");
$stmt->bind_param("i", $transaction_id);
$stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) <= 0){
    echo json_encode(array('message' => 'No Record Found.','status' => false));
    die();
}

$stmt = $db->prepare("SELECT transaction_id, account_id, amount, balance_after_transaction, payment_type, debit, credit, reference, description, created_at, updated_at FROM transactions WHERE transaction_id = ?");
$stmt->bind_param("i", $transaction_id);
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