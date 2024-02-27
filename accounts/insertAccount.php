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

$userid = $data['userid'];
$account_title = $data['account_title'];
$account_type = $data['account_type'];
$balance = $data['balance'];
$bank_name = $data['bank_name'];
$branch_name = $data['branch_name'];

$sql = "INSERT INTO accounts(userid, account_title, account_type, balance, bank_name, branch_name) VALUES('{$userid}','{$account_title}','{$account_type}','{$balance}','{$bank_name}','{$branch_name}')";

if(mysqli_query($db, $sql))
{
    echo json_encode(array('message' => 'Account record inserted.', 'status' => true));
}
else
{
    echo json_encode(array('message' => 'No record inserted.', 'status' => false));
}

?>