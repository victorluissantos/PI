<!DOCTYPE html>
<html>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<head>
		<link rel="icon" type="image/png" href="resources/img/logo-128.png" />
		<title>Lawer-AI</title>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

		<link rel="stylesheet" type="text/css" href="resources/css/style.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

		<script type="text/javascript" src="resources/functions.js"></script>
	</head>
	<body>
	<?php
	if(isset($_GET) && !empty($_GET['debug'])) {
	  error_reporting(E_ALL);
	  ini_set('display_errors', 1);
	}
	include('hcs/Controller.php');
	?>