<?php
if($_SERVER['HTTP_HOST']=="localhost"){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database= "prj_task_scheduler_db";
	$local_mode = true;
}
else{
	$servername = "localhost";
	$username = "u410138225_ZelosDB_task";
	$password = "Zelosit@121$";
	$database= "u410138225_task_db";
	$local_mode = false;
}
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>