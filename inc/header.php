<?php 

if(session_status() == PHP_SESSION_NONE)
{
	session_start();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>QR CODE INFO</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="asset/img/favicon.png" rel="icon">
  <link href="asset/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="asset/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="asset/lib/bootstrap/css/bootstrap-datepicker.min.css" rel="stylesheet">


  <!-- Libraries CSS Files -->
  <link href="asset/lib/mdb/css/mdb.min.css" rel="stylesheet">
  <link href="asset/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="asset/lib/animate/animate.min.css" rel="stylesheet">
  <link href="asset/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="asset/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="asset/lib/lightbox/css/lightbox.min.css" rel="stylesheet">


  <!-- Main Stylesheet File -->
  <link href="asset/css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: NewBiz
    Theme URL: https://bootstrapmade.com/newbiz-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>


  <!--==========================
  Header
  ============================-->
   <header id="header">
    <div class="container">

      <div class="logo float-left">
      <!--  Uncomment below if you prefer to use an image logo  -->
        <!--  <h1 class="text-light"><a href="#header"><span>NewBiz</span></a></h1>  -->
        <a href="index.php" class="scrollto"><img src="asset/img/logo.png" alt="" class="img-fluid"></a>
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
        	<li class="active"><a href="index.php">Home</a></li>
        	<?php if(isset($_SESSION["auth"])): ?>
				<li><a href="logout.php">Log out</a></li>
        	<?php  else: ?>          
          <li><a href="register.php">Register</a></li>
          <li><a href="login.php">Login</a></li>
          <?php endif; ?>
          <!-- <li><a href="#team">Team</a></li>
          <li class="drop-down"><a href="">Drop Down</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="drop-down"><a href="#">Drop Down 2</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
              <li><a href="#">Drop Down 5</a></li>
            </ul>
          </li> -->
          <li><a href="#contact">Contact Us</a></li>
        </ul>
      </nav>
      
    </div>
  </header>