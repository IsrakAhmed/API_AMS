<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allow-Methods, Authorization, X-Requested-With');

global $db;
require_once '../config.php';

/* This File Is Assigned To Israk Ahmed : @IsrakAhmed */

// Update a user

$data = json_decode(file_get_contents("php://input"), true);

$userid = $data['userid'];
$username = $data['username'];
$password = $data['password'];
$fullname = $data['fullname'];
$phone = $data['phone'];
$email = $data['email'];
$address = $data['address'];

// Check if user exists
$stmt = $db->prepare("SELECT * FROM users WHERE userid = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0) {
    echo json_encode(array('message' => 'No User Found With This User ID', 'status' => false));
    $stmt->close();
    $db->close();
    exit();
}

// Prepare an SQL statement
$stmt = $db->prepare("UPDATE users SET username = ?, password = ?, fullname = ?, phone = ?, email = ?, address = ? WHERE userid = ?");

// Bind parameters to the SQL statement
$stmt->bind_param("sssissi", $username, $password, $fullname, $phone, $email, $address, $userid);

// Execute the SQL statement
if($stmt->execute()) {
    echo json_encode(array('message' => 'User Updated Successfully', 'status' => true));
}
else {
    echo json_encode(array('message' => 'User Not Updated', 'status' => false));
}

$stmt->close();
$db->close();

?>