<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

global $db;
require_once '../config.php';

/* This File Is Assigned To Shahriar Hossen Jamil : @ShahriarJamil8009 */

// Delete a Customer

$data = json_decode(file_get_contents('php://input'), true);


if(empty($data['customer_id']))
{
    echo json_encode(array('message' => 'Customer ID is required.', 'status' => false));
    exit();
}


$customer_id = $data['customer_id'];

$stmt = $db->prepare("SELECT customer_id FROM customers WHERE customer_id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if(!$row)
{
    echo json_encode(array('message' => 'No record found.', 'status' => false));
    exit();
}

$stmt = $db->prepare("DELETE FROM customers WHERE customer_id = ?");
$stmt->bind_param("i", $customer_id);


if($stmt->execute())
{
    echo json_encode(array('message' => 'Customer record deleted.', 'status' => true));
}
else
{
    echo json_encode(array('message' => 'No record found.', 'status' => false));
}

?>