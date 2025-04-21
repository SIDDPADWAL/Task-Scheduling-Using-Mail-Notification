<?php
include('./lock.php');
include('./zel_admin/conn.php');
$vdate=date("Y-m-d");
$ip=$_SERVER['REMOTE_ADDR'];
$sql1="SELECT ip FROM visitors WHERE ip='$ip'"; 
$result = $conn->query($sql1);
if ($result->num_rows == 0){
	$sql = "INSERT INTO visitors (ip, vdate)VALUES ('$ip', '$vdate')";          
	$conn->query($sql);
}
$sql="SELECT ip FROM visitors"; 
$result = $conn->query($sql);
$counter=$result->num_rows;
//echo$counter;
?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/home.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:33:53 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="AAC Flora & Fauna">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#e7eaf5">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>Task Scheduler System</title>
    <!-- Favicon-->
    <link rel="icon" href="img/icons/logo.png">
    <!-- Apple Touch Icon-->
    <link rel="apple-touch-icon" href="img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icons/icon-180x180.png">
    <!-- Stylesheet-->
    <link rel="stylesheet" href="style.css">
    <!-- Web App Manifest-->
    <link rel="manifest" href="manifest.json">
	<script src="./sss.js"></script>
		<style>
		.blink{
		//width:100%;
		height: 50px;
	    background-color: #ffc220;
		padding: 15px;	
		text-align: center;
		line-height: 50px;
		animation: blink 2s linear infinite;
	}
	//span{
		//font-size: 25px;
		//font-family: cursive;
		//color: white;
		//animation: blink 1s linear infinite;
	//}
@keyframes blink{
0%{opacity: 0;}
50%{opacity: .5;}
100%{opacity: 1;}
}
</style>	
  </head>
  <body>
    <!-- Preloader-->
    <!--<div class="preloader" id="preloader">
      <div class="spinner-grow text-secondary" role="status">
        <div class="sr-only">Loading...</div>
      </div>
    </div>-->
    <!-- Header Area-->
    <div class="header-area" id="headerArea">
      <div class="container h-100 d-flex align-items-center justify-content-between">
        <!-- Logo Wrapper-->
        <div class="logo-wrapper"><a href="home.php"><img src="img/core-img/logo-small.png" alt=""></a></div>
        <!-- Search Form-->
        <!-- Navbar Toggler-->
        <div class="suha-navbar-toggler d-flex flex-wrap" id="suhaNavbarToggler"><span></span><span></span><span></span></div>
      </div>
    </div>
    <!-- Sidenav Black Overlay-->
    <?php
	include('sidenav.php');
	?>
    <div class="page-content-wrapper" style="margin-top:27px;">
<br/>
      <!-- Product Catagories-->
	   <!-- Top Products-->
      <div  class="top-products-area clearfix py-3">
        <div class="container-fluid">
          <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1">Recent Added Task</h6>
          </div>
          <div class="row g-3">
            <!-- Single Top Product Card-->
			<?php
				  include('./zel_admin/conn.php');
				  error_reporting(E_ALL);	
				  $sql = "SELECT * FROM task t, end_user eu WHERE  eu.euid=t.euid AND t.euid=$user_id AND t.task_status=1 ORDER BY t.task_id DESC";
				  $result = $conn->query($sql);
				  if ($result->num_rows > 0) {
					  $count=0;
					  while($row = $result->fetch_assoc()) {						  
						echo"<div class='col-12 col-md-4 col-lg-3'>
						  <div class='card top-product-card'>
							<div class='card-body'>
							<span class='badge badge-success'>Task</span>
							<a class='wishlist-btn' href='#'><i class='lni lni-heart1'></i></a>
							<hr/>
							<a class='product-title d-block' href='#'>".substr($row['task_title'], 0, 100)."</a>							
							<p class=''> Schedule On: ".date('d-m-Y', strtotime($row['task_date']))."<br/>			
							Schedule At: ".date('h:i:sa', strtotime($row['task_time']))."<br/></p>";					
							echo"<a class='btn btn-danger btn-sm add2cart-notify' onclick='delete_task(".$row['task_id'].")' href='#'><i class='lni lni-trash'></i> Delete</a>
							</div>
						  </div>
						</div>";
					 }
				  }
				  else{
				   echo "No Data Available at that time!";
				  }
				?>

          </div>
        </div>
      </div>
      <!-- Discount Coupon Card-->
      <!-- Featured Products Wrapper-->

      <!-- Night Mode View Card-->

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
    <script src="js/app.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
	
  </body>

<!-- Mirrored from designing-world.com/suha-v2.1.0/home.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:19 GMT -->
</html>
<script>
$(document).ready(function(){
 
 $('#sc_name').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"searchsubcat.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
 });
 
});
</script>