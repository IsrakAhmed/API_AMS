<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allow-Methods, Authorization, X-Requested-With');

global $db;
require_once '../config.php';

/* This File Is Assigned To Bakhtiar Sahib Rizvi : @BakhtiarSahib */

// Create a new user

// Start Writing Your Code From Here


$data = json_decode(file_get_contents("php://input"),true);

if(!isset($data['username']) || !isset($data['password']) || !isset($data['fullname']) || !isset($data['phone']) || !isset($data['email']) || !isset($data['address'])) {
    echo json_encode(array('message' => 'All fields are required', 'status' => false));
    exit();
}

if(empty($data['username']) || empty($data['password']) || empty($data['fullname']) || empty($data['phone']) || empty($data['email']) || empty($data['address'])) {
    echo json_encode(array('message' => 'None of the fields can be an empty string', 'status' => false));
    exit();
}

$username = $data['username'];
$password = $data['password'];
$fullname = $data['fullname'];
$phone = $data['phone'];
$email = $data['email'];
$address = $data['address'];
$profile_img = null;

if(isset($data['profile_img']) && !empty($data['profile_img'])){
    $profile_img = $data['profile_img'];
}

$stmt = $db->prepare("INSERT INTO users (username, password, fullname, phone, email, address, profile_img) VALUES (?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssisss", $username, $password, $fullname, $phone, $email, $address, $profile_img);

if($stmt->execute()) {
    echo json_encode(array('message' => 'User Record inserted', 'status' => true));
}

else {
    echo json_encode(array('message' => 'User Record Not inserted', 'status' => false));
}

$stmt->close();
$db->close();



?>