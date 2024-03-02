<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

global $db;
require_once '../config.php';

/* This File Is Assigned To Shahriar Hossen Jamil : @ShahriarJamil8009 */

// Show All Transactions In The Database


$sql = "SELECT transaction_id, account_id, amount, balance_after_transaction, payment_type, debit, credit, reference, description, created_at, updated_at FROM transactions";
$result = mysqli_query($db, $sql) or die("SQL Query Failed.");

if(mysqli_num_rows($result) > 0){

    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
}
else{
    echo json_encode(array('message' => 'NO Record Found.','status' => false));
}
?>
