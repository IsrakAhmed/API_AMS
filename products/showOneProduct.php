<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

global $db;
require_once '../config.php';

/* This File Is Assigned To Sumaiya Tasnim : @SumaiyaTasnim12 */

// Show one Product in the database

// Start Writing Your Code From Here



$data = json_decode(file_get_contents("php://input"),true);

if(empty($data['product_id']))
{
    echo json_encode(array('message' => 'Product ID is required.','status'=>false));
    exit();
}

$product_id = $data['product_id'];

$stmt = $db->prepare("SELECT product_id, name, stock, buying_price, selling_price, description, created_at, updated_at FROM products WHERE product_id = ?");
$stmt->bind_param("i",$product_id);
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