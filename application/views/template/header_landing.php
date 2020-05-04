<!DOCTYPE html>
<html lang="en">
  	<head>
	   <title><?= $judul; ?></title>
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	   <link href="<?= base_url('assets/img/logo/logo.PNG'); ?>" rel='shortcut icon'>
	    
		<!-- font -->
	   <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">
	    	
	   <!-- MY CSS -->
	   <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">

	   <!-- CSS Bootstrap -->
	   <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-template.css'); ?>">
	   <link rel="stylesheet" href="<?= base_url('assets/css/all.css'); ?>">

		<!-- Template CSS -->
	   <link rel="stylesheet" href="<?= base_url('assets/css/open-iconic-bootstrap.min.css'); ?>">
	   <link rel="stylesheet" href="<?= base_url('assets/css/animate.css'); ?>">
	   <link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.min.css'); ?>">
	   <link rel="stylesheet" href="<?= base_url('assets/css/owl.theme.default.min.css'); ?>">
	   <link rel="stylesheet" href="<?= base_url('assets/css/magnific-popup.css'); ?>">
	   <link rel="stylesheet" href="<?= base_url('assets/css/aos.css'); ?>">
	   <link rel="stylesheet" href="<?= base_url('assets/css/ionicons.min.css'); ?>">
	   <link rel="stylesheet" href="<?= base_url('assets/css/flaticon.css'); ?>">
	   <link rel="stylesheet" href="<?= base_url('assets/css/icomoon.css'); ?>">
  	</head>
  	<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
	    	<div class="container">
	      	<a class="navbar-brand page-scroll" href="#">SIP<span class="text-lowercase">etani</span></a>
	      	<button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        	<span class="oi oi-menu"></span> Menu
	      	</button>
	      	<div class="collapse navbar-collapse" id="ftco-nav">
	        	<ul class="navbar-nav nav ml-auto">
		          	<li class="nav-item">
		          		<a href="#home" class="nav-link page-scroll"><span>Home</span></a>
		          	</li>
		          	<li class="nav-item">
		          		<a href="#layanan" class="nav-link page-scroll color"><span>Layanan</span></a>
		          	</li>
		          	<li class="nav-item">
		          		<a href="#sarana" class="nav-link page-scroll color"><span>Sarana</span></a>
		          	</li>
		          	<li class="nav-item">
		          		<a href="#tentang" class="nav-link page-scroll color"><span>Tentang</span></a>
		          	</li>
		          	<li class="nav-item">
		          		<a href="#pemesanan" class="nav-link page-scroll color"><span>Pemesanan</span></a>
		          	</li>
	          		<?php if (session()): ?>
		          		<li class="nav-item">
		          			<a href="<?= base_url('tiket'); ?>" class="nav-link page-scroll color"><span>Tiket</span></a>
		          		</li>
		          		<li class="nav-item dropdown no-arrow">
			              <a class="nav-link dropdown-toggle color" href="#" data-toggle="dropdown">
			                <span>Profil</span>
			              </a>
			              <!-- Dropdown - User Information -->
			              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in mr-2 mt-0" aria-labelledby="userDropdown">
			                <span class="d-block text-center"><small><?= $user['nama']; ?></small></span>
			                <div class="dropdown-divider"></div>
			                <a class="dropdown-item" href="<?= base_url('editprofile'); ?>">
			                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
			                  Profil Saya
			                </a>
			                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
			                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
			                  Logout
			                </a>
			              </div>
			            </li>
		          	<?php else: ?>
	          		<li class="nav-item">
	          			<a href="<?= base_url('login'); ?>" class="nav-link color"><span>Login</span></a>
	          		</li>
	          		<?php endif ?>
	        	</ul>
	      	</div>
	    	</div>
		</nav>