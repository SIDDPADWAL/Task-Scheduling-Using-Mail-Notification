<?php 	
//require_once 'core.php';
require_once './zel_admin/conn.php';
require_once 'lock.php';
$today=date('Y-m-d');
$valid['success'] = array('success' => false, 'messages' => array());
$task_id = $_POST['task_id'];
if($task_id) { 
 $sql = "UPDATE task SET task_status=0 WHERE task_id=$task_id";
 if($conn->query($sql) === TRUE ) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 $conn->close();
 echo json_encode($valid);
} // /if $_POST