<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allow-Methods, Authorization, X-Requested-With');

global $db;
require_once '../config.php';

/* This File Is Assigned To Israk Ahmed : @IsrakAhmed */

// Update a Product

$data = json_decode(file_get_contents("php://input"), true);

if(!isset($data['product_id']) || !isset($data['name']) || !isset($data['stock']) || !isset($data['buying_price']) || !isset($data['selling_price']) || !isset($data['description'])) {
    echo json_encode(array('message' => 'All Fields Are Required', 'status' => false));
    die();
}

if(empty($data['product_id']) ||empty($data['name']) || empty($data['stock']) || empty($data['buying_price']) || empty($data['selling_price']) || empty($data['description'])) {
    echo json_encode(array('message' => 'All Fields Are Required', 'status' => false));
    die();
}

$product_id = $data['product_id'];
$name = $data['name'];
$stock = $data['stock'];
$buying_price = $data['buying_price'];
$selling_price = $data['selling_price'];
$description = $data['description'];


// Check if product exists
$stmt = $db->prepare("SELECT product_id FROM products WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0) {
    echo json_encode(array('message' => 'No Product Found With This Product ID', 'status' => false));
    $stmt->close();
    $db->close();
    exit();
}

// Prepare an SQL statement
$stmt = $db->prepare("UPDATE products SET name = ?, stock = ?, buying_price = ?, selling_price = ?, description = ? WHERE product_id = ?");

// Bind parameters to the SQL statement
$stmt->bind_param("siddsi", $name, $stock, $buying_price, $selling_price, $description, $product_id);

// Execute the SQL statement
if($stmt->execute()) {
    echo json_encode(array('message' => 'Product Updated Successfully', 'status' => true));
}
else {
    echo json_encode(array('message' => 'Product Not Updated', 'status' => false));
}

$stmt->close();
$db->close();

?>