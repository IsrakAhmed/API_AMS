<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allow-Methods, Authorization, X-Requested-With');

global $db;
require_once '../config.php';

/* This File Is Assigned To Bakhtiar Sahib Rizvi : @BakhtiarSahib */

// Update a user

$data = json_decode(file_get_contents("php://input"), true);

if(!isset($data['name']) || !isset($data['customer_id'])) {
    echo json_encode(array('message' => 'Customer id and name required', 'status' => false));
    exit();
}

if(empty($data['name']) || empty($data['customer_id'])) {
    echo json_encode(array('message' => 'Customer id or name can not be an empty string', 'status' => false));
    exit();
}

$customer_id = $data['customer_id'];
$name = $data['name'];
$phone = (empty($data['phone'])) ? null : $data['phone'];
$email = (empty($data['email'])) ? null : $data['email'];
$address = (empty($data['address'])) ? null : $data['address'];
$profile_img = (empty($data['profile_img'])) ? null : $data['profile_img'];


// Check if user exists
$stmt = $db->prepare("SELECT customer_id FROM customers WHERE customer_id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0) {
    echo json_encode(array('message' => 'No Customer Found With This Customer ID', 'status' => false));
    $stmt->close();
    $db->close();
    exit();
}

// Prepare an SQL statement
$stmt = $db->prepare("UPDATE customers SET name = ?, phone = ?, email = ?, address = ? WHERE customer_id = ?");

// Bind parameters to the SQL statement
$stmt->bind_param("sissi", $name, $phone, $email, $address, $customer_id);

// Execute the SQL statement
if($stmt->execute()) {
    echo json_encode(array('message' => 'Customer Updated Successfully', 'status' => true));
}
else {
    echo json_encode(array('message' => 'Customer Not Updated', 'status' => false));
}

$stmt->close();
$db->close();

?>