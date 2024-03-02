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

if(!isset($data['transaction_id']) || !isset($data['account_id']) || !isset($data['amount']) || !isset($data['payment_type']) || !isset($data['debit']) || !isset($data['credit']) || !isset($data['reference']) || !isset($data['description'])) {
    echo json_encode(array('message' => 'All Fields Are Required', 'status' => false));
    exit();
}

if(empty($data['transaction_id']) || empty($data['account_id']) || empty($data['amount']) || empty($data['payment_type']) || empty($data['debit']) || empty($data['credit']) || empty($data['reference']) || empty($data['description'])) {
    echo json_encode(array('message' => 'All Fields Are Required', 'status' => false));
    exit();
}

$transaction_id = $data['transaction_id'];
$new_account_id = $data['account_id'];
$new_amount = $data['amount'];
$new_payment_type = $data['payment_type'];
$new_debit = $data['debit'];
$new_credit = $data['credit'];
$new_reference = $data['reference'];
$new_description = $data['description'];

if($new_amount <= 0) {
    echo json_encode(array('message' => 'Amount Must Be Greater Than 0', 'status' => false));
    exit();
}
else if($new_debit <= 0 && $new_credit <= 0) {
    echo json_encode(array('message' => 'Debit Or Credit Must Be Greater Than 0', 'status' => false));
    exit();
}
else if($new_debit > 0 && $new_credit > 0) {
    echo json_encode(array('message' => 'Debit And Credit Cannot Be Greater Than 0 At The Same Time', 'status' => false));
    exit();
}
else if($new_amount != $new_debit && $new_amount != $new_credit) {
    echo json_encode(array('message' => 'Amount Must Be Equal To Debit Or Credit', 'status' => false));
    exit();
}

$stmt = $db -> prepare("SELECT transaction_id, account_id, amount, balance_after_transaction, payment_type, debit, credit, reference, description, created_at, updated_at FROM transactions WHERE transaction_id = ?");
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

if(!isset($previous_transaction['account_id']) || !isset($previous_transaction['balance_after_transaction']) || !isset($previous_transaction['debit']) || !isset($previous_transaction['credit'])) {
    echo json_encode(array('message' => 'Transaction Cannot Be Updated', 'status' => false));
    $stmt->close();
    $db->close();
    exit();
}

$previous_transaction_account_id = $previous_transaction['account_id'];
$pt_balance_after_transaction = $previous_transaction['balance_after_transaction'];
$pt_debit = $previous_transaction['debit'];
$pt_credit = $previous_transaction['credit'];
$z_bal = $pt_balance_after_transaction - $pt_credit + $pt_debit;


$check_bal = $db -> prepare("SELECT balance FROM accounts WHERE account_id = ?");
$check_bal->bind_param("i", $new_account_id);
$check_bal->execute();
$check_bal = $check_bal->get_result();

if($check_bal->num_rows == 0) {
    echo json_encode(array('message' => 'No Account Found With This Account ID', 'status' => false));
    $check_bal->close();
    $db->close();
    exit();
}

else{
    $check_bal = $check_bal->fetch_assoc();
    $check_bal = $check_bal['balance'];

    if($previous_transaction_account_id == $new_account_id){
        $check_bal = $check_bal + $pt_debit - $pt_credit;
    }

    if($new_debit != 0 && $check_bal < $new_amount){
        echo json_encode(array('message' => 'Insufficient Balance', 'status' => false));
        $stmt->close();
        $db->close();
        exit();
    }

    $ck = $db->prepare("SELECT * FROM transactions WHERE created_at < ? AND account_id = ? ORDER BY created_at DESC LIMIT 1");
    $ck->bind_param("si", $previous_transaction['created_at'], $new_account_id);
    $ck->execute();
    $ck = $ck->get_result();
    $ck = $ck->fetch_assoc();

    if($ck){
        $ck = $ck['balance_after_transaction'];

        if($new_debit != 0 && $ck < $new_amount){
            echo json_encode(array('message' => 'Insufficient Balance', 'status' => false));
            $stmt->close();
            $db->close();
            exit();
        }

    }

}


$cr_bal = $db -> prepare("SELECT balance FROM accounts WHERE account_id = ?");
$cr_bal->bind_param("i", $previous_transaction_account_id);
$cr_bal->execute();
$cr_bal = $cr_bal->get_result();
$cr_bal = $cr_bal->fetch_assoc();
$cr_bal = $cr_bal['balance'];

$reversed_balance = $cr_bal + $pt_debit - $pt_credit;

$stmt = $db -> prepare("UPDATE accounts SET balance = ? WHERE account_id = ?");
$stmt->bind_param("di", $reversed_balance, $previous_transaction_account_id);
$stmt->execute();

$stmt = $db -> prepare("SELECT balance FROM accounts WHERE account_id = ?");
$stmt->bind_param("i", $new_account_id);
$stmt->execute();
$result = $stmt->get_result();
$balance = $result->fetch_assoc();
$balance = $balance['balance'];

$new_balance_after_transaction = $balance + $new_credit - $new_debit;

$stmt = $db -> prepare("UPDATE accounts SET balance = ? WHERE account_id = ?");
$stmt->bind_param("di", $new_balance_after_transaction, $new_account_id);
$stmt->execute();


if($new_debit != $pt_debit || $new_credit != $pt_credit || $new_account_id != $previous_transaction_account_id){
    $timestamp = $previous_transaction['created_at'];
    $stmt = $db->prepare("SELECT transaction_id, account_id, amount, balance_after_transaction, payment_type, debit, credit, reference, description, created_at, updated_at FROM transactions WHERE created_at > ? AND account_id = ? ORDER BY created_at ASC");
    $stmt->bind_param("si", $timestamp, $previous_transaction_account_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $balance = $row['balance_after_transaction'] - $pt_credit + $pt_debit;
        $stmt = $db->prepare("UPDATE transactions SET balance_after_transaction = ? WHERE transaction_id = ?");
        $stmt->bind_param("di", $balance, $row['transaction_id']);
        $stmt->execute();
    }

    if($previous_transaction_account_id != $new_account_id){
        $timestamp = $previous_transaction['created_at'];
        $stmt = $db->prepare("SELECT transaction_id, account_id, amount, balance_after_transaction, payment_type, debit, credit, reference, description, created_at, updated_at FROM transactions WHERE created_at > ? AND account_id = ? ORDER BY created_at ASC");
        $stmt->bind_param("si", $timestamp, $new_account_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $balance = $row['balance_after_transaction'] + $new_credit - $new_debit;
            $stmt = $db->prepare("UPDATE transactions SET balance_after_transaction = ? WHERE transaction_id = ?");
            $stmt->bind_param("di", $balance, $row['transaction_id']);
            $stmt->execute();
        }

        $stmt = $db->prepare("SELECT balance_after_transaction FROM transactions WHERE created_at < ? AND account_id = ? ORDER BY created_at DESC LIMIT 1");
        $stmt->bind_param("si", $previous_transaction['created_at'], $new_account_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $balance_before_update = 0;

        $flag = 0;

        if(!$row){
            $stmt = $db->prepare("SELECT balance_after_transaction FROM transactions WHERE created_at > ? AND account_id = ? ORDER BY created_at ASC LIMIT 1");
            $stmt->bind_param("si", $previous_transaction['created_at'], $new_account_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if(!$row){
                $flag = 1;
            }
            else{
                $balance_before_update = $row['balance_after_transaction'] - $row['credit'] + $row['debit'];
            }
        }

        else{
            $balance_before_update = $row['balance_after_transaction'];
        }

        $b_a_t_to_put = $balance_before_update + $new_credit - $new_debit;

        if($flag == 1){
            $stmt = $db->prepare("SELECT balance FROM accounts WHERE account_id = ?");
            $stmt->bind_param("i", $new_account_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $b_a_t_to_put = $row['balance'];
        }

        $stmt = $db -> prepare("UPDATE transactions SET balance_after_transaction = ? WHERE transaction_id = ?");
        $stmt->bind_param("di", $b_a_t_to_put, $transaction_id);
        $stmt->execute();

    }

    else{

        $timestamp = $previous_transaction['created_at'];
        $stmt = $db->prepare("SELECT transaction_id, account_id, amount, balance_after_transaction, payment_type, debit, credit, reference, description, created_at, updated_at FROM transactions WHERE created_at > ? AND account_id = ? ORDER BY created_at ASC");
        $stmt->bind_param("si", $timestamp, $previous_transaction_account_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $balance = $row['balance_after_transaction'] + $new_credit - $new_debit;
            $stmt = $db->prepare("UPDATE transactions SET balance_after_transaction = ? WHERE transaction_id = ?");
            $stmt->bind_param("di", $balance, $row['transaction_id']);
            $stmt->execute();
        }

        $stmt = $db->prepare("SELECT balance_after_transaction FROM transactions WHERE transaction_id = ?");
        $stmt->bind_param("i",$transaction_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $b_a_t_to_put = $z_bal + $new_credit - $new_debit;

        $stmt = $db -> prepare("UPDATE transactions SET balance_after_transaction = ? WHERE transaction_id = ?");
        $stmt->bind_param("di", $b_a_t_to_put, $transaction_id);
        $stmt->execute();

    }
}


$stmt = $db -> prepare("UPDATE transactions SET account_id = ?, amount = ?, payment_type = ?, debit = ?, credit = ?, reference = ?, description = ? WHERE transaction_id = ?");
$stmt->bind_param("idsddssi", $new_account_id, $new_amount, $new_payment_type, $new_debit, $new_credit, $new_reference, $new_description, $transaction_id);


if($stmt->execute()) {
    echo json_encode(array('message' => 'Transaction Updated Successfully', 'status' => true));
}
else {
    echo json_encode(array('message' => 'Transaction Could Not Be Updated', 'status' => false));
}

$stmt->close();
$db->close();



?>