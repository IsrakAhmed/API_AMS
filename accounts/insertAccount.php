<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allow-Methods, Authorization, X-Requested-With');

global $db;
require_once '../config.php';

/* This File Is Assigned To Shahriar Hossen Jamil : @ShahriarJamil8009 */

// Create A New Account


$data = json_decode(file_get_contents('php://input'), true);

if(!isset($data['userid']) || !isset($data['account_title']) || !isset($data['account_type']) || !isset($data['balance']) || !isset($data['bank_name']) || !isset($data['branch_name']))
{
    echo json_encode(array('message' => 'All fields are required.', 'status' => false));
    die();
}

if(empty($data['userid']) || empty($data['account_title']) || empty($data['account_type']) || empty($data['balance']) || empty($data['bank_name']) || empty($data['branch_name']))
{
    echo json_encode(array('message' => 'All fields are required.', 'status' => false));
    die();
}

$userid = $data['userid'];
$account_title = $data['account_title'];
$account_type = $data['account_type'];
$balance = $data['balance'];
$bank_name = $data['bank_name'];
$branch_name = $data['branch_name'];

$stmt = $db->prepare("SELECT userid FROM users WHERE userid = ?");
$stmt->bind_param("s", $userid);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows <= 0)
{
    echo json_encode(array('message' => 'User not found.', 'status' => false));
    die();
}

$stmt = $db->prepare("INSERT INTO accounts (userid, account_title, account_type, balance, bank_name, branch_name) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issdss", $userid, $account_title, $account_type, $balance, $bank_name, $branch_name);


if($stmt->execute())
{
    echo json_encode(array('message' => 'Account record inserted.', 'status' => true));
}
else
{
    echo json_encode(array('message' => 'No record inserted.', 'status' => false));
}

?>