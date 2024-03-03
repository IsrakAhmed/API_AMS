<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allow-Methods, Authorization, X-Requested-With');

global $db;
require_once '../config.php';

/* This File Is Assigned To Israk Ahmed : @IsrakAhmed */

// Create a new customer

// Start Writing Your Code From Here


$data = json_decode(file_get_contents("php://input"),true);

if(!isset($data['name'])) {
    echo json_encode(array('message' => 'Customer name required', 'status' => false));
    exit();
}

if(empty($data['name'])) {
    echo json_encode(array('message' => 'Customer name can not be an empty string', 'status' => false));
    exit();
}

$name = $data['name'];
$phone = (empty($data['phone'])) ? null : $data['phone'];
$email = (empty($data['email'])) ? null : $data['email'];
$address = (empty($data['address'])) ? null : $data['address'];
$profile_img = (empty($data['profile_img'])) ? null : $data['profile_img'];


$stmt = $db->prepare("INSERT INTO users (name, phone, email, address, profile_img) VALUES (?, ?, ?, ?, ?)");

$stmt->bind_param("sisss", $name, $phone, $email, $address, $profile_img);

if($stmt->execute()) {
    echo json_encode(array('message' => 'Customer Record inserted', 'status' => true));
}

else {
    echo json_encode(array('message' => 'Customer Record Not inserted', 'status' => false));
}

$stmt->close();
$db->close();



?>