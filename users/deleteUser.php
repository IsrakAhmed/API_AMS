<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

global $db;
require_once '../config.php';

/* This File Is Assigned To Shahriar Hossen Jamil : @ShahriarJamil8009 */

// Delete a user

$data = json_decode(file_get_contents('php://input'), true);
$userid = $data['userid'];

$stmt = $db->prepare("SELECT * FROM users WHERE userid = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if(!$row)
{
    echo json_encode(array('message' => 'No record found.', 'status' => false));
    exit();
}

$sql = "DELETE FROM users WHERE userid = {$userid}";

if(mysqli_query($db, $sql))
{
    echo json_encode(array('message' => 'User record deleted.', 'status' => true));
}
else
{
    echo json_encode(array('message' => 'No record found.', 'status' => false));
}

?>