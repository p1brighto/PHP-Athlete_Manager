<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title><?php echo $title; ?></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	
	<!-- Font Awesome CSS for table sorting -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	
	<!-- Google captche -->
	<script src='https://www.google.com/recaptcha/api.js'></script>
	
	</head>
	
	<body>
	<!--facbook api-->
	<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		
		<nav class="nav navbar-default">
			<a class="navbar-brand" href="#">COMP1006 IN-Class App</a>
			<?php
			//if the user is authenticated,show the navigation links
			session_start();
			if(!empty($_SESSION['user_id'])){
			?>
			<ul class="nav navbar-nav">
				<li><a href="athletes.php">List atheletes</a></li>
				<li><a href="athlete.php">New athelete</a></li>
				<li><a href="gallery.php">Image Gallery</a></li>
				<li><a href="logout.php">Log Out</a></li>
			<?php
			}
			else{
			?>
			<ul class="nav navbar-nav">
				<li><a href="index.php">Log In</a></li>
				<li><a href="register.php">Register</a></li>
				<li><a href="feedback.php">Feedback</a></li>
			<?php

			}
			?>
			</ul>
		</nav>
	
	