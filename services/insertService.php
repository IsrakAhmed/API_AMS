<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allow-Methods, Authorization, X-Requested-With');

global $db;
require_once '../config.php';

/* This File Is Assigned To Bakhtiar Sahib Rizvi : @BakhtiarSahib */

// Create a new Service

// Start Writing Your Code From Here


$data = json_decode(file_get_contents("php://input"),true);

if(!isset($data['name']) || !isset($data['selling_price']) || !isset($data['description'])) {
    echo json_encode(array('message' => 'All Fields Are Required', 'status' => false));
    die();
}

if(empty($data['name']) || empty($data['selling_price']) || empty($data['description'])) {
    echo json_encode(array('message' => 'All Fields Are Required', 'status' => false));
    die();
}

$name = $data['name'];
$selling_price = $data['selling_price'];
$description = $data['description'];


$stmt = $db->prepare("INSERT INTO services (name, selling_price, description) VALUES (?, ?, ?)");

$stmt->bind_param("sds", $name, $selling_price, $description);

if($stmt->execute()) {
    echo json_encode(array('message' => 'Service Record inserted', 'status' => true));
}

else {
    echo json_encode(array('message' => 'Service Record Not inserted', 'status' => false));
}

$stmt->close();
$db->close();



?>