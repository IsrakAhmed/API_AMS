<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

global $db;
require_once '../config.php';

/* This File Is Assigned To Sumaiya Tasnim : @SumaiyaTasnim12 */

// Show one user in the database

// Start Writing Your Code From Here



$data = json_decode(file_get_contents("php://input"),true);

if(empty($data['userid']))
{
    echo json_encode(array('message' => 'User ID is required.','status'=>false));
    exit();
}

$user_id = $data['userid'];

$stmt = $db->prepare("SELECT * FROM users WHERE userid = ?");
$stmt->bind_param("i",$user_id);
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