<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta name="description" content="">
  	<meta name="author" content="">
		<title><?= $heading; ?></title>
	<link href="http://localhost/sipetani/assets/img/logo/logo.png" rel='shortcut icon'>
	<link rel="stylesheet" href="http://localhost/sipetani/assets/css/all.css; ?>">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link rel="stylesheet" href="http://localhost/sipetani/assets/css/sb-admin-2.min.css">
	<style>
		@media (max-width: 575.98px) {
			.bg-404{
				height: 200px !important;
				width: 300px !important;
			}	
		}
		.color{
			color: #31de79;
		}
		.color:hover{
			text-decoration: none;
		}
		.top{
			margin-top: 150px;
		}
		.bg-404{
			background-image: url('http://localhost/sipetani/assets/img/svg/404.svg');
			background-size: contain;
			background-repeat: no-repeat;
			height: 300px;
			width: 550px;
		}
	</style>
</head>
<body>
	<div id="container" class="top">
		 <!-- 404 Error Text -->
          <div class="text-center">
            <div class="bg-404 mx-auto"></div>
            <p class="lead text-gray-800 mb-5 "><h1><?= $heading; ?></h1></p>
            <p class="text-gray-500 mb-0"><?= $message; ?></p>
            <a href="http://localhost/sipetani/landing_home" class="color">&larr; Back to Home</a>
          </div>	
	</div>
	<!-- Bootstrap core JavaScript-->
  	<script src="http://localhost/sipetani/assets/js/jquery-3.4.1.min.js"></script>
  	<script src="http://localhost/sipetani/assets/js/bootstrap.bundle.min.js"></script>

  	<!-- Core plugin JavaScript-->
  	<script src="http://localhost/sipetani/assets/js/jquery.easing.min.js"></script>

  	<!-- Custom scripts for all pages-->
  	<script src="http://localhost/sipetani/assets/js/sb-admin-2.min.js"></script>
</body>
</html>