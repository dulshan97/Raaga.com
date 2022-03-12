<!DOCTYPE html>
<html>
<head>
	<title>RaaGa</title>
	<link rel="stylesheet" type="text/css" href="/public/bootstrap-4.4.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/public/fontawesome-free-5.12.0-web/css/all.css">
	<link rel="stylesheet" type="text/css" href="/public/css/app.css">

	<?php
		if (isset($css)) {
			foreach ($css as $file) {
				echo '<link rel="stylesheet" type="text/css" href="/public/css/' . $file . '">';
			}
		}
	?>

	<script type="text/javascript" src="/public/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="/public/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>

	<?php
		if (isset($js)) {
			foreach ($js as $jsfile) {
				echo '<script type="text/javascript" src="/public/js/'. $jsfile . '"></script>';
			}
		}
	?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="/">RaaGa</a>
	<div class="collapse navbar-collapse">
		
    <ul class="navbar-nav mr-auto">
    	<li class="nav-item active">
        	<a class="nav-link" href="/signin.php">Login</a>
    	</li>
    	<li class="nav-item active">
        	<a class="nav-link" href="/user-regester.php">Regester</a>
    	</li>
	</ul>
	</div>
</nav>