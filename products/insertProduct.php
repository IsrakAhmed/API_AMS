<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allow-Methods, Authorization, X-Requested-With');

global $db;
require_once '../config.php';

/* This File Is Assigned To Bakhtiar Sahib Rizvi : @BakhtiarSahib */

// Create a new Product

// Start Writing Your Code From Here


$data = json_decode(file_get_contents("php://input"),true);

if(!isset($data['name']) || !isset($data['stock']) || !isset($data['buying_price']) || !isset($data['selling_price']) || !isset($data['description'])) {
    echo json_encode(array('message' => 'All Fields Are Required', 'status' => false));
    die();
}

if(empty($data['name']) || empty($data['stock']) || empty($data['buying_price']) || empty($data['selling_price']) || empty($data['description'])) {
    echo json_encode(array('message' => 'All Fields Are Required', 'status' => false));
    die();
}

$name = $data['name'];
$stock = $data['stock'];
$buying_price = $data['buying_price'];
$selling_price = $data['selling_price'];
$description = $data['description'];


$stmt = $db->prepare("INSERT INTO products (name, stock, buying_price, selling_price, description) VALUES (?, ?, ?, ?, ?)");

$stmt->bind_param("sidds", $name, $stock, $buying_price, $selling_price, $description);

if($stmt->execute()) {
    echo json_encode(array('message' => 'Product Record inserted', 'status' => true));
}

else {
    echo json_encode(array('message' => 'Product Record Not inserted', 'status' => false));
}

$stmt->close();
$db->close();



?>