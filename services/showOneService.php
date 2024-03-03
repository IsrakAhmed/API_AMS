<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

global $db;
require_once '../config.php';

/* This File Is Assigned To Sumaiya Tasnim : @SumaiyaTasnim12 */

// Show one Service in the database

// Start Writing Your Code From Here



$data = json_decode(file_get_contents("php://input"),true);

if(empty($data['service_id']))
{
    echo json_encode(array('message' => 'Service ID is required.','status'=>false));
    exit();
}

$service_id = $data['service_id'];

$stmt = $db->prepare("SELECT service_id, name, selling_price, description, created_at, updated_at FROM services WHERE service_id = ?");
$stmt->bind_param("i",$service_id);
$stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) >0){

    $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode($output);

}

else
{
 echo json_encode(array('message' => 'No Record Found.','status'=>false));

}

?>