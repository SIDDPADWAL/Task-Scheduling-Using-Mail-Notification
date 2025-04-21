<?php
include('./lock.php');
include ("./zel_admin/conn.php");
?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/settings.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:35 GMT -->
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
    <title> Search Specimen</title>
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
    <div class="page-content-wrapper">
      <!-- Catagory Single Image-->
      <!--<div class="catagory-single-img" style="background-image: url('img/bg-img/4.jpg')"></div>-->
      <!-- Product Catagories-->

      <!-- Top Products-->
           <!-- Top Products-->		   
      <div class="top-products-area clearfix py-3">
        <div class="container">
          <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1">Search Specimen Details</h6>
          </div>
          <div class="row">
			<div class="card coupon-card mb-3">
				<div class="card-body">
				  <div class="apply-coupon">
					<h6 class="mb-0">Search Specimen By Name</h6>
					<div class="coupon-form">
					  <form method="GET" action="./plant_details.php">
						<input class="form-control" type="text" id="specimen_name" name="specimen_name" autocomplete="off" placeholder="Specimen Name" style="padding-right:70px;"> &ensp;
						<button class="btn btn-primary" name="submitbyname" type="submit">Search</button>
					  </form>
					</div>
				  </div>
				</div>
			</div>
          </div>
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
    <script src="js/app.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
  </body>

<!-- Mirrored from designing-world.com/suha-v2.1.0/settings.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:35 GMT -->
</html>
<script>
$(document).ready(function(){
 
 $('#specimen_name').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"searchspecimens.php",
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