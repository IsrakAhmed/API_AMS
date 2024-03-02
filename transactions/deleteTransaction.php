<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

global $db;
require_once '../config.php';

/* This File Is Assigned To Bakhtiar Sahib Rizvi : @BakhtiarSahib */

// Delete a Transaction


// Start Writing Your Code From Here

$data = json_decode(file_get_contents('php://input'), true);

if(empty($data['transaction_id']))
{
    echo json_encode(array('message' => 'Transaction ID is required.', 'status' => false));
    exit();
}

$transaction_id = $data['transaction_id'];

$stmt = $db->prepare("SELECT transaction_id, account_id, amount, balance_after_transaction, payment_type, debit, credit, reference, description, created_at, updated_at FROM transactions WHERE transaction_id = ?");
$stmt->bind_param("i", $transaction_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if(!$row)
{
    echo json_encode(array('message' => 'No record found.', 'status' => false));
    exit();
}

$ndnd = $db -> prepare("SELECT balance FROM accounts WHERE account_id = ?");
$ndnd->bind_param("i", $row['account_id']);
$ndnd->execute();
$n_balance = $ndnd->get_result();
$n_balance = $n_balance->fetch_assoc();


$reversed_balance = $n_balance['balance'] + $row['debit'] - $row['credit'];
$d_ac_id = $row['account_id'];
$d_debit = $row['debit'];
$d_credit = $row['credit'];
$stmt = $db -> prepare("UPDATE accounts SET balance = ? WHERE account_id = ?");
$stmt->bind_param("di", $reversed_balance, $row['account_id']);
$stmt->execute();


// Fetch the timestamp of the row being deleted
$timestamp = $row['created_at'];

// Prepare an SQL statement to select the rows
$stmt = $db->prepare("SELECT transaction_id, account_id, amount, balance_after_transaction, payment_type, debit, credit, reference, description, created_at, updated_at FROM transactions WHERE created_at > ?  AND account_id = ? ORDER BY created_at ASC");
$stmt->bind_param("si", $timestamp, $d_ac_id);
$stmt->execute();
$result = $stmt->get_result();

// Loop through the rows
while ($row = $result->fetch_assoc()) {
    // Calculate the new balance after the transaction
    $balance = $row['balance_after_transaction'] + $d_debit - $d_credit;

    // Prepare an SQL statement to update the balance_after_transaction
    $stmt = $db->prepare("UPDATE transactions SET balance_after_transaction = ? WHERE transaction_id = ?");
    $stmt->bind_param("di", $balance, $row['transaction_id']);

    // Execute the SQL statement
    $stmt->execute();
}


$stmt = $db->prepare("DELETE FROM transactions WHERE transaction_id = ?");
$stmt->bind_param("i", $transaction_id);


if($stmt->execute())
{
    echo json_encode(array('message' => 'Transaction record deleted.', 'status' => true));
}
else
{
    echo json_encode(array('message' => 'No record found.', 'status' => false));
}



?>