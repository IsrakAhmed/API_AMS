<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

global $db;
require_once '../config.php';

/* This File Is Assigned To Sumaiya Tasnim : @SumaiyaTasnim12 */

// Delete An Account


// Start Writing Your Code From Here

$data = json_decode(file_get_contents('php://input'), true);

if(empty($data['account_id']))
{
    echo json_encode(array('message' => 'Account ID is required.', 'status' => false));
    die();
}

$account_id= $data['account_id'];

$stmt = $db->prepare("SELECT account_id FROM accounts WHERE account_id = ?");
$stmt->bind_param("i", $account_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if(!$row)
{
    echo json_encode(array('message' => 'No record found.', 'status' => false));
    die();
}


$stmt = $db->prepare("DELETE FROM accounts WHERE account_id = ?");
$stmt->bind_param("i", $account_id);


if($stmt->execute())
{
    echo json_encode(array('message' => 'Account record deleted.', 'status' => true));
}
else
{
    echo json_encode(array('message' => 'No record found.', 'status' => false));
}

$stmt->close();



?>