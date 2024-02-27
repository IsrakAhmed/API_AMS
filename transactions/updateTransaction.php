<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allow-Methods, Authorization, X-Requested-With');

global $db;
require_once '../config.php';

/* This File Is Assigned To Israk Ahmed : @IsrakAhmed  */

// Update A Transaction


$data = json_decode(file_get_contents("php://input"),true);

$transaction_id = $data['transaction_id'];
$account_id = $data['account_id'];
$amount = $data['amount'];
$payment_type = $data['payment_type'];
$debit = $data['debit'];
$credit = $data['credit'];
$reference = $data['reference'];
$description = $data['description'];

if($amount <= 0) {
    echo json_encode(array('message' => 'Amount Must Be Greater Than 0', 'status' => false));
    exit();
}
else if($debit <= 0 && $credit <= 0) {
    echo json_encode(array('message' => 'Debit Or Credit Must Be Greater Than 0', 'status' => false));
    exit();
}
else if($debit > 0 && $credit > 0) {
    echo json_encode(array('message' => 'Debit And Credit Cannot Be Greater Than 0 At The Same Time', 'status' => false));
    exit();
}
else if($amount != $debit && $amount != $credit) {
    echo json_encode(array('message' => 'Amount Must Be Equal To Debit Or Credit', 'status' => false));
    exit();
}

$stmt = $db -> prepare("SELECT * FROM transactions WHERE transaction_id = ?");
$stmt->bind_param("i", $transaction_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0) {
    echo json_encode(array('message' => 'No Transaction Found With This Transaction ID', 'status' => false));
    $stmt->close();
    $db->close();
    exit();
}

$previous_transaction = $result->fetch_assoc();
$previous_transaction_account_id = $previous_transaction['account_id'];

$reversed_balance = $previous_transaction['balance_after_transaction'] + $previous_transaction['debit'] - $previous_transaction['credit'];
$stmt = $db -> prepare("UPDATE accounts SET balance = ? WHERE account_id = ?");
$stmt->bind_param("di", $reversed_balance, $previous_transaction_account_id);
$stmt->execute();

$stmt = $db -> prepare("SELECT balance FROM accounts WHERE account_id = ?");
$stmt->bind_param("i", $account_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0) {
    echo json_encode(array('message' => 'No Account Found With This Account ID', 'status' => false));
    $stmt->close();
    $db->close();
    exit();
}

$balance = $result->fetch_assoc();
$balance = $balance['balance'];

if($debit != 0 && $balance < $amount){
    echo json_encode(array('message' => 'Insufficient Balance', 'status' => false));
    $stmt->close();
    $db->close();
    exit();
}

$balance_after_transaction = $balance + $credit - $debit;

$stmt = $db -> prepare("UPDATE accounts SET balance = ? WHERE account_id = ?");
$stmt->bind_param("di", $balance_after_transaction, $account_id);
$stmt->execute();

$stmt = $db -> prepare("UPDATE transactions SET account_id = ?, amount = ?, balance_after_transaction = ?, payment_type = ?, debit = ?, credit = ?, reference = ?, description = ? WHERE transaction_id = ?");
$stmt->bind_param("iddsddssi", $account_id, $amount, $balance_after_transaction, $payment_type, $debit, $credit, $reference, $description, $transaction_id);


if($stmt->execute()) {
    echo json_encode(array('message' => 'Transaction Updated Successfully', 'status' => true));
}
else {
    echo json_encode(array('message' => 'Transaction Could Not Be Updated', 'status' => false));
}

$stmt->close();
$db->close();



?>