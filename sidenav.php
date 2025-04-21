<?php 
include('./lock.php');
if($login_session)  
{   
	$status="Welcome ".$login_session; 
	$url="./logout.php";
	$status1="Logout";  
}
else
{ 
	$status="Welcome Guest"; 
	$url="./login.php";
	$status1="Login"; 
 }
  ?>
<div class="sidenav-black-overlay"></div>
    <!-- Side Nav Wrapper-->
    <div class="suha-sidenav-wrapper" id="sidenavWrapper">
      <!-- Sidenav Profile-->
      <div class="sidenav-profile">
        <div class="user-profile1"><img src="img/bg-img/logo.png" alt=""></div>
        <div class="user-info">
          <h6 class="user-name mb-0"><?php echo $status; ?></h6>
          <p class="available-balance"><a style="color:white;"href="<?php echo $url?>"><?php echo $status1; ?></a></p>
        </div>
      </div>
      <!-- Sidenav Nav-->
      <ul class="sidenav-nav pl-0">
        <li><a href="./home.php"><i class="lni lni-home"></i>Home</a></li>              
        <li><a href="./add_task.php"><i class="lni lni-plus"></i>Add task</a></li>  
        <li><a href="./history.php"><i class="lni lni-heart"></i>Task History</a></li> 		  
        <li><a href="./profile.php"><i class="lni lni-user"></i>My Profile</a></li> 		  
        
      </ul>
      <!-- Go Back Button-->
      <div class="go-home-btn" id="goHomeBtn"><i class="lni lni-arrow-left"></i></div>
    </div>