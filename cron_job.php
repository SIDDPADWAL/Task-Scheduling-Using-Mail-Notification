<?php
include('/home/u410138225/public_html/task_scheduler/zel_admin/conn.php');
require_once('/home/u410138225/public_html/task_scheduler/mail/class.phpmailer.php');
require_once('/home/u410138225/public_html/task_scheduler/mail/class.smtp.php');
$sql = "SELECT * FROM task t, end_user eu WHERE  eu.euid=t.euid AND t.task_status=1 ORDER BY t.task_id DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
		$euid = $row["euid"];
		$euname = $row["euname"];
		$email = $row["email"];
		$task_id = $row["task_id"];
		$task_title = $row["task_title"];
		$task_date = $row["task_date"];
		$task_time = $row["task_time"];
		$task_datetime = date('Y-m-d H:i', strtotime($row['task_datetime']));
		$currentdatetime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
		$currentdatetime = $currentdatetime->format('Y-m-d H:i');
		//echo $task_datetime."<br/>";
		//echo $currentdatetime."<br/>";
		if($currentdatetime==$task_datetime){
			//Email Code
			$subject="This is reminder for your scheduled Task.";
			$body="Hi <b>".$euname.",</b> <br/>This mail is auto generated for your scheduled task reminder.<br/> Your Task Details:<br/>
			Task Title:<b>  ".$task_title." </b><br/> 
			Task Date: <b>".$task_date." </b><br/>
			Task Time: <b>".$task_time." </b><br/>
			Thank You.";
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->SMTPDebug = 0;
			$mail->Host = 'smtp.hostinger.com';
			$mail->Port = 587;
			$mail->SMTPAuth = true;
			$mail->Username = 'contacttemp@zelosit.com';
			$mail->Password = 'Contact@121$';
			$mail->setFrom('contacttemp@zelosit.com', 'Task Scheduler');
			$mail->addReplyTo('contacttemp@zelosit.com', 'Task Scheduler');
			$mail->addAddress($email, 'Task Scheduler');
			$mail->Subject = $subject;
			$mail->msgHTML($body);
			//$mail->msgHTML(file_get_contents('message.html'), __DIR__);
			//$mail->Body = $body;
			if (!$mail->send()) {
				//echo 'Mailer Error: ' . $mail->ErrorInfo;
			}
			else{
			    $sql = "UPDATE task SET task_status=2 WHERE task_id=$task_id";
                $conn->query($sql);
			}
		}
	}
}

?>

