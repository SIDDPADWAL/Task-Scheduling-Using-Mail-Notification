<?php 
include('./lock.php');
require_once('./mail/class.phpmailer.php');
require_once('./mail/class.smtp.php');
$error="";
$show="display:none;";
$alert="";
  
if (isset($_POST['submit'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $task_title = test_input($_POST["task_title"]);
	 $task_date = test_input($_POST["task_date"]);
	 $task_time = test_input($_POST["task_time"]);
	 //$hh=test_input($_POST['hh']); 
	 //$mm=test_input($_POST['mm']); 
	// $ss=test_input($_POST['ss']); 
	 //$task_time=$hh.":".$mm.":".$ss;
	 $task_datetime=$task_date." ".$task_time;
	 
     $sql = "SELECT * FROM task WHERE task_title='$task_title' AND euid=$user_id AND task_status=1";
	 $query = $conn->query($sql);
	 $count = $query->num_rows;
	 $today=date("Y-m-d");
      if ($count > 0){
        $error="Your Task is Already Submitted!";
        $show="display:show;";
        $alert="alert alert-danger";		
      }
	  else{
		$sql = "INSERT INTO task (task_title, task_date, task_time, task_datetime, task_status, task_regdate, euid) VALUES('$task_title','$task_date','$task_time','$task_datetime',1, '$today', $user_id)";
		if($conn->query($sql)===TRUE){
			$subject="Task is submitted Successfully.";
			$body="Hi <b>".$login_session."</b>, <br/> Your Task is submitted successfully From Task Scheduler App, <br/>Task Details:<br/> 
			Task Title:<b>  ".$task_title." </b><br/> 
			Task Date: <b>".$task_date." </b><br/>
			Task Time: <b>".$task_time." </b><br/>
			Task added Date: <b>".$today." </b><br/>
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
			$mail->Body = $body;
			//$mail->addAttachment('test.txt');
			if (!$mail->send()) {
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			}
			$error="Your Task Is submitted Successfully!";
			$show="display:show;";
			$alert="alert alert-success";
		}
		else{
			$error="Process Is Invalid!";
			$show="display:show;";
			$alert="alert alert-success";
		}
	  }
	  header( "Refresh:1; url=./add_task.php?alert=$alert&show=$show&error=$error", true, 303);
	}
}
if (isset($_GET['alert'])) {
 $alert=$_GET['alert'];
 $error=$_GET['error'];
 $show=$_GET['show'];
}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:03 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#100DD1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>Add Task</title>
    <!-- Favicon-->
    <link rel="icon" href="img/icons/icon-72x72.png">
    <!-- Apple Touch Icon-->
    <link rel="apple-touch-icon" href="img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icons/icon-180x180.png">
    <!-- Stylesheet-->
    <link rel="stylesheet" href="style.css">
    <!-- Web App Manifest-->
    <link rel="manifest" href="manifest.json">
  </head>
  <body>
    <!-- Preloader-->
    <div class="preloader" id="preloader">
      <div class="spinner-grow text-secondary" role="status">
        <div class="sr-only">Loading...</div>
      </div>
    </div>
    <!-- Header Area-->
    <div class="header-area" id="headerArea">
      <div class="container h-100 d-flex align-items-center justify-content-between">
        <!-- Back Button-->
        <div class="back-button"><a href="index.php"><i class="lni lni-arrow-left"></i></a></div>
        <!-- Page Title-->
        <div class="page-heading">
          <h6 class="mb-0">Schedule Task</h6>
        </div>
        <!-- Navbar Toggler-->
        <div class="suha-navbar-toggler d-flex justify-content-between flex-wrap" id="suhaNavbarToggler"><span></span><span></span><span></span></div>
      </div>
    </div>
    <?php
	include('sidenav.php');
	?>
    <div class="page-content-wrapper" style="padding-top:10px;">
      <!-- Google Maps-->
      <div class="container">
        <div class="section-heading mt-3">
          <h5 class="mb-1">Submit Task Schedule</h5>
        </div>
        <!-- Contact Form-->
        <div class="contact-form mt-3 pb-3">
		<div class="alert <?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
          <form action="" method="POST">
            <div class="form-group text-left mb-4"><span>Task Title</span>
			  <input class="form-control mb-3" id="task_title" name="task_title" type="text" placeholder="Task Title" required>
			</div>			
			<div class="form-group text-left mb-4"><span>Task Date</span>
			  <input class="form-control mb-3" id="task_date" name="task_date" type="date" placeholder="Task Date" required>
			</div>
			<!--<div class="form-group text-left mb-4"><span>Task Time</span>
                  <div class="row">
					  <div class="col-md-4">
					  <input class="form-control" name="hh" id="hh" min="00" max="12" type="number" placeholder="Horus" required>
					  </div>
					  <div class="col-md-4">
						<input class="form-control" name="mm" id="mm" min="01" max="60" type="number" placeholder="Minutes" required>
					  </div>
					  <div class="col-md-4">
						<input class="form-control" min="01" max="60" name="ss" id="ss" type="number" placeholder="Seconds" required>
					  </div>
				  </div>
                </div>-->
			<div class="form-group text-left mb-4"><span>Task Time</span>
			  <input class="form-control mb-3" id="task_time" name="task_time" type="time" placeholder="Task Time" required>
			</div>			
            <button name="submit" class="btn btn-success btn-lg w-100">Submit Task</button>
          </form>
        </div>
      </div>
    </div>
    <?php
	include('footer.php');
	?>
    <!-- All JavaScript Files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/default/jquery.passwordstrength.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jarallax.min.js"></script>
    <script src="js/jarallax-video.min.js"></script>
    <script src="js/default/dark-mode-switch.js"></script>
    <script src="js/default/no-internet.js"></script>
    <script src="js/default/active.js"></script>
    <script src="js/pwa.js"></script>
  </body>

<!-- Mirrored from designing-world.com/suha-v2.1.0/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:03 GMT -->
</html>