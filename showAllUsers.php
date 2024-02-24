<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

global $db;
require_once 'config.php';

/* This File Is Assigned To Esrat Jahan Riya : @EsratRiya */

// Show all users in the database

$sql = "SELECT * FROM users";

$result = mysqli_query($db, $sql) or die("SQL Query Failed.");

if(mysqli_num_rows($result) > 0){

    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
}
else{
    echo json_encode(array('message' => 'NO Record Found.','status' => false));
}

?>