<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allow-Methods, Authorization, X-Requested-With');

global $db;
require_once '../config.php';

/* This File Is Assigned To Israk Ahmed : @IsrakAhmed */

// Update a Service

$data = json_decode(file_get_contents("php://input"), true);

if(!isset($data['service_id']) || !isset($data['name']) || !isset($data['selling_price']) || !isset($data['description'])) {
    echo json_encode(array('message' => 'All Fields Are Required', 'status' => false));
    die();
}

if(empty($data['service_id']) ||empty($data['name']) || empty($data['selling_price']) || empty($data['description'])) {
    echo json_encode(array('message' => 'All Fields Are Required', 'status' => false));
    die();
}

$service_id = $data['service_id'];
$name = $data['name'];
$selling_price = $data['selling_price'];
$description = $data['description'];


// Check if Service exists
$stmt = $db->prepare("SELECT service_id FROM services WHERE service_id = ?");
$stmt->bind_param("i", $service_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0) {
    echo json_encode(array('message' => 'No Service Found With This Service ID', 'status' => false));
    $stmt->close();
    $db->close();
    exit();
}

// Prepare an SQL statement
$stmt = $db->prepare("UPDATE services SET name = ?, selling_price = ?, description = ? WHERE service_id = ?");

// Bind parameters to the SQL statement
$stmt->bind_param("sdsi", $name, $selling_price, $description, $service_id);

// Execute the SQL statement
if($stmt->execute()) {
    echo json_encode(array('message' => 'Service Updated Successfully', 'status' => true));
}
else {
    echo json_encode(array('message' => 'Service Not Updated', 'status' => false));
}

$stmt->close();
$db->close();

?>