<?php
$error="";
$login_session="";
$show="display:none;";
$alert="";
include("./zel_admin/conn.php");
include('./sms.php');
include('./otpgenerator.php');
require_once('./mail/class.phpmailer.php');
require_once('./mail/class.smtp.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//check up
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 if(isset($_SESSION['login_euser']))
{
  header("Location:./home.php");
  exit;
}
else
{
  //header("Location:login.php");
  //exit;
}
if (isset($_POST['sendotp']))
{
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{ 
		$myusername=test_input($_POST['mobile']);
		$email=test_input($_POST['email']);
		$n = 4;  
		//session_start();
		$_SESSION['otp_code']=generateNumericOTP($n);
		$message="Hi, Use OTP Code ".$_SESSION['otp_code']." For LMS.com Registration. Thank You!";
		$mobile_number=$myusername;
		$temp_id="1207161780929754753";
		//$message1= sms_unicode($message);
		sentsms($message, $mobile_number, $temp_id);
		//Email Code
		$subject="OTP for LMS.com Registration verification.";
		$body="Hi, Use OTP Code ".$_SESSION['otp_code']." For LMS.com Registration. Thank You!";
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Host = 'smtp.hostinger.com';
		$mail->Port = 587;
		$mail->SMTPAuth = true;
		$mail->Username = 'contacttemp@zelosit.com';
		$mail->Password = 'Contact@121$';
		$mail->setFrom('contacttemp@zelosit.com', 'LMS');
		$mail->addReplyTo('contacttemp@zelosit.com', 'LMS');
		$mail->addAddress($email, $email);
		$mail->Subject = $subject;
		$mail->msgHTML($body);
		//$mail->msgHTML(file_get_contents('message.html'), __DIR__);
		//$mail->Body = $body;
		if (!$mail->send()) {
			//echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
}
if (isset($_POST['verifyopt']))
{
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{ 
		$myusername=test_input($_POST['mobile']);
		$otp1=test_input($_POST['otp1']);
		$otp2=test_input($_POST['otp2']);
		$otp3=test_input($_POST['otp3']);
		$otp4=test_input($_POST['otp4']);
		$otp="$otp1"."$otp2"."$otp3"."$otp4";
		if($_SESSION['otp_code']==$otp){
			$euid=$_SESSION['last_id'];
					$sql = "UPDATE end_user SET status=1 WHERE euid=$euid";
					if ($conn->query($sql) === TRUE) {
						$sql="SELECT euname, eumob, eupass, email FROM end_user WHERE status=1 AND euid=$euid";
						$result = $conn->query($sql);
						if($result->num_rows>0){
							while($row = $result->fetch_assoc()) {
							$euname = $row["euname"];				
							$myusername = $row["eumob"];				
							$mypassword = $row["eupass"];				
							$email = $row["email"];				
							}
						}
					$message="Hi, ".$euname."! Your Account is Successfully created on LMS.com Your User Name: ".$myusername." and password:".$mypassword." Thank You.";
					$mobile_number=$myusername;
					$message1= sms_unicode($message);
					sentsms($message1, $mobile_number);
					//SMS to Admin
					$message="New Account created by ".$euname." on LMS.com User Name: ".$myusername." and password:".$mypassword." Thank You.";
					$mobile_number="9657020022";
					$message1= sms_unicode($message);
					sentsms($message1, $mobile_number);
					//Email Code
					$subject="Welcome ".$euname." to LMS.com";
					$body="Hi <b>".$euname."</b>, <br/> Your Registration completed successfully to LMS.com <br/>	Your Username:<b>  ".$myusername." </b><br/> Password: <b>".$mypassword." </b><br/>Email: <b>".$email." </b><br/>Thank You.";
					$mail = new PHPMailer;
					$mail->isSMTP();
					$mail->SMTPDebug = 0;
					$mail->Host = 'smtp.hostinger.com';
					$mail->Port = 587;
					$mail->SMTPAuth = true;
					$mail->Username = 'contacttemp@zelosit.com';
					$mail->Password = 'Contact@121$';
					$mail->setFrom('contacttemp@zelosit.com', 'LMS');
					$mail->addReplyTo('contacttemp@zelosit.com', 'LMS');
					$mail->addAddress($email, $euname);
					$mail->Subject = $subject;
					$mail->msgHTML($body);
					//$mail->msgHTML(file_get_contents('message.html'), __DIR__);
					$mail->Body = $body;
					//$mail->addAttachment('test.txt');
					$error="User Account Created successfully! <a href='./login.php'><u>Click here for login! </u></a>";
					$show="display:show;";
					$alert="alert alert-success";
					if (!$mail->send()) {
						echo 'Mailer Error: ' . $mail->ErrorInfo;
					} else {
						$_SESSION['login_euser']=$myusername;
						header("location:./home.php");
						die();
						//header("Location:./register.php?alert=$alert&show=$show&error=$error");
						//header( "Refresh:5; url=./register.php?alert=$alert&show=$show&error=$error", true, 303);
					}
				
				}
				else{
				$error="Your sign-up is invalid";
				$show="display:show;";
				$alert="alert alert-danger";
				header("Location:./register.php?alert=$alert&show=$show&error=$error");
				}
		}
		else{
				$error="You Entered OPT Not Match!";
				$show="display:show;";
				$alert="alert alert-danger";
				//header("Location:./register.php?alert=$alert&show=$show&error=$error");
				}
	}
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
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/otp-confirm.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="JP Wholesale">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#e7eaf5">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>Confirm OTP</title>
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
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.js"></script>
		<script type="text/javascript">
	$(function(){
		$('#otp1,#otp2,#otp3,#otp4').keyup(function(e){
			if($(this).val().length==$(this).attr('maxlength'))
				$(this).next(':input').focus()
		})
	})
	</script>
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
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5">
		  <div class="alert <?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
            <div class="text-left px-4">
              <h5 class="mb-1 text-white">Verify Email Id</h5>
              <p class="mb-4 text-white">Enter the OTP code sent to<strong class="ml-1"><?php echo $myusername; ?></strong></p>
            </div>
            <!-- OTP Verify Form-->
            <div class="otp-verify-form mt-5 px-4">
              <form action="" method="POST">
                <div class="d-flex justify-content-between mb-5">
				<input class="form-control pl-0" name="mobile" id="phone_number" type="hidden" value="<?php echo $myusername;?>" placeholder="Enter phone number">
                  <input class="form-control" id="otp1" name="otp1" type="text" value="" placeholder="-" maxlength="1" autofocus>
                  <input class="form-control" id="otp2" name="otp2" type="text" value="" placeholder="-" maxlength="1">
                  <input class="form-control" id="otp3" name="otp3" type="text" value="" placeholder="-" maxlength="1">
                  <input class="form-control" id="otp4" name="otp4" type="text" value="" placeholder="-" maxlength="1">
                </div>
                <button class="btn btn-warning btn-lg w-100" name="verifyopt" type="submit">Verify &amp; Proceed</button>
              </form>
            </div>
            <!-- Term & Privacy Info-->
            <div class="login-meta-data px-4">
              <p class="mt-3 mb-0">Don't received the OTP?<span class="otp-sec ml-1 text-white" id="resendOTP"></span></p>
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
    <script src="js/default/otp-timer.js"></script>
    <script src="js/default/active.js"></script>
    <script src="js/pwa.js"></script>
  </body>

<!-- Mirrored from designing-world.com/suha-v2.1.0/otp-confirm.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
</html>