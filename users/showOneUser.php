<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

global $db;
require_once '../config.php';

/* This File Is Assigned To Sumaiya Tasnim : @SumaiyaTasnim12 */

// Show one user in the database

// Start Writing Your Code From Here



$data = json_decode(file_get_contents("php://input"),true);
$user_id = $data['userid'];
//include "config.php";
$sql = "SELECT * FROM users WHERE userid = {$user_id}";
$result = mysqli_query($db,$sql) or die("SQL Query failed");

if(mysqli_num_rows($result) >0){

    $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode($output);

}

else
{
 echo json_encode(array('message' => 'No Record Found.','status'=>false));

}

?>