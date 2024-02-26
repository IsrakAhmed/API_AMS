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
//$userid = $data['userid'];
$username = $data['username'];
$password = $data['password'];
$fullname = $data['fullname'];
$phone = $data['phone'];
$email = $data['email'];
$address = $data['address'];
//include "config.php";
$sql = "INSERT INTO users(username,password,fullname,phone,email,address)
 VALUES('{$username}','{$password}','{$fullname}','{$phone}','{$email}','{$address}')";


if(mysqli_query($db,$sql)){

    echo json_encode(array('message' => 'User Record inserted','status'=>true));

}

else
{
 echo json_encode(array('message' => 'User Record Not inserted','status'=>flase));

}



?>