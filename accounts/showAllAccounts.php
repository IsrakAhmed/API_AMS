<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

global $db;
require_once '../config.php';

/* This File Is Assigned To Sumaiya Tasnim : @SumaiyaTasnim12 */

// Show All Accounts In The Database


// Start Writing Your Code From Here


$stmt = $db->prepare("SELECT account_id, userid, account_title, account_type, balance, bank_name, branch_name, created_at, updated_at FROM accounts");
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $output = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($output);
}
else{
    echo json_encode(array('message' => 'NO Record Found.','status' => false));
}

$stmt->close();
$db->close();


?>