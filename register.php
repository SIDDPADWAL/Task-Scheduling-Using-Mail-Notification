<?php
$error="";
$login_session="";
$show="display:none;";
$alert="";
include('./zel_admin/conn.php');
require_once('./mail/class.phpmailer.php');
require_once('./mail/class.smtp.php');
//check up
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 if(isset($_SESSION['login_euser']))
{
  header("Location:./index.php");
  exit;
}
else
{
  //header("Location:login.php");
  //exit;
}
if (isset($_POST['submitsignup']))
{
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{  
		$euname=test_input($_POST['euname']); 
		$myusername=test_input($_POST['email']); 
		$mypassword=test_input($_POST['registerPassword']); 		
		$conf_Password=test_input($_POST['conf_Password']); 		
		$today=date('Y-m-d');
		$sql="SELECT status FROM end_user WHERE email='$myusername' AND eupass='$mypassword'"; 
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()) {
				$status=$row['status'];
			}
			if($status==1){
				$_SESSION['login_euser']=$myusername;
				$_SESSION['login_password']=$mypassword;
				header("location:./index.php");
				die();
			}
			else{
				$error="Your Account Approval is Pending.";
				$show="display:show;";
				$alert="alert alert-danger";
				header("Location:./register.php?alert=$alert&show=$show&error=$error");
			}
		}
		else if($mypassword==$conf_Password){
			$sql1="SELECT email FROM end_user WHERE email='$myusername'"; 
			$result = $conn->query($sql1);
			if ($result->num_rows > 0){
				$error=$myusername." "."User Name Is Already Exist!";
				$show="display:show;";
				$alert="alert alert-danger";
				header("Location:./register.php?alert=$alert&show=$show&error=$error");
			}
			else{
				$sql = "INSERT INTO end_user (euname, eupass, email, euregdate, status)
				VALUES ('$euname', '$mypassword','$myusername', '$today', 1)";
				if ($conn->query($sql) === TRUE) {
					$_SESSION['login_euser']=$myusername;
					$_SESSION['login_password']=$mypassword;
					setcookie ("member_login",$myusername,time()+ (10 * 365 * 24 * 60 * 60));  
					setcookie ("member_password",$mypassword,time()+ (10 * 365 * 24 * 60 * 60));
					//Email Code
					$subject="Great! ".$myusername." is registered on Task Scheduler App.";
					$body="Hi <b>".$euname."</b> ,<br/> <b>".$myusername."</b>, <br/> Your new Registration completed successfully on Task Scheduler App <br/> User Details:<br/> Username:<b>  ".$myusername." </b><br/> Password: <b>".$mypassword." </b><br/>Thank You.";
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
					$mail->addAddress($myusername, "Task Scheduler");
					$mail->Subject = $subject;
					$mail->msgHTML($body);
					//$mail->msgHTML(file_get_contents('message.html'), __DIR__);
					$mail->Body = $body;
					//$mail->addAttachment('test.txt');
					if (!$mail->send()) {
						echo 'Mailer Error: ' . $mail->ErrorInfo;
					}
					header("location:./login.php");
					die();							
				}
				else{
				$error="Your Sign-Up is invalid";
				$show="display:show;";
				$alert="alert alert-danger";
				header("Location:./register.php?alert=$alert&show=$show&error=$error");
				}
			}
		}
		else{
			$error="Password and Confirm Password Not Match.";
			$show="display:show;";
			$alert="alert alert-danger";
			header("Location:./register.php?alert=$alert&show=$show&error=$error");
		}
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
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="LMS">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#e7eaf5">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>New User Registration</title>
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
    <!-- Login Wrapper Area-->
    <div class="login-wrapper d-flex align-items-center justify-content-center text-center">
      <!-- Background Shape-->
      <div class="background-shape"></div>
      <div class="container">	  
        <div class="row justify-content-center">
          <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5"><img class="big-logo" src="img/core-img/logo-small.png" alt="">
            <!-- Register Form-->
			<div class="alert <?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
            <div class="register-form mt-5 px-4">
              <form action="./register.php" method="POST">                
				<div class="form-group text-left mb-4"><span>User Name</span>
                  <label for="mobile"><i class="lni lni-home"></i></label>
                  <input class="form-control" name="euname" id="euname" type="text" placeholder="User Name" required>
                </div>
				<div class="form-group text-left mb-4"><span>Email Id</span>
                  <label for="mobile"><i class="lni lni-phone"></i></label>
                  <input class="form-control" name="email" id="email" type="email" placeholder="Email Id" required>
                </div>	
                <div class="form-group text-left mb-4"><span>Password</span>
                  <label for="password"><i class="lni lni-lock"></i></label>
                  <input class="input-psswd form-control" name="registerPassword" id="registerPassword" type="password" placeholder="********************" required>
                </div>
				<div class="form-group text-left mb-4"><span>Confirm Password</span>
                  <label for="password"><i class="lni lni-lock"></i></label>
                  <input class="input-psswd form-control" name="conf_Password" id="conf_Password" type="password" placeholder="********************" required>
                </div>											
                <button class="btn btn-success btn-lg w-100" name="submitsignup" type="submit">Sign Up</button>
              </form>
            </div>
            <!-- Login Meta-->
            <div class="login-meta-data">
              <p class="mt-3 mb-0">Already have an account?<a class="ml-1" href="login.php">Sign In</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
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
    <script src="js/default/active.js"></script>
    <script src="js/pwa.js"></script>
  </body>

<!-- Mirrored from designing-world.com/suha-v2.1.0/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
</html>