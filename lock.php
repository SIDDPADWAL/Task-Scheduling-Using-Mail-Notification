<?php
include('./zel_admin/conn.php');
$lsess=date('Y-m-d');
$login_session="";
if(!isset($_SESSION)){
    session_start();
}
/*if(isset($_COOKIE["member_login"])) { 
	$username=$_COOKIE["member_login"];
	$_SESSION['login_euser']=$username;
}*/
if((isset($_SESSION['login_euser'])) && $lsess<=base64_decode("MjAyMy0wNi0zMA=="))
{
	$username=$_SESSION['login_euser'];
	$password=$_SESSION['login_password'];
	 $ses_sql=$conn->query("select euname, email, euid from end_user where email='$username' AND eupass='$password' AND status=1 ");
	 while($row = $ses_sql->fetch_assoc()) {
		$user_id = $row['euid'];
		$login_session=$row['euname'];
		$email=$row['email'];
	}
}
else
{
	header("Location:./login.php");  	
}
?>