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
$student_id = $data['transaction_id'];
$sql = "DELETE FROM transactions WHERE transaction_id = {$student_id}";
if(mysqli_query($db, $sql))
{
    echo json_encode(array('message' => 'Student record deleted.', 'status' => true));
}
else
{
    echo json_encode(array('message' => 'No record found.', 'status' => false));
}



?>