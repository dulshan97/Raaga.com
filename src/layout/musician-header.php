<?php

session_start();

// force musician user to update settings at first login
if (isset($_SESSION) && $_SESSION['is_first_login'] != 0) {
	$url = explode('/', $_SERVER['REQUEST_URI']);
	if ($url[count($url)-1] != 'setting.php') {
		header('Location: /src/musician/setting.php');
	}
}

function isLogedIn() {
	if (!isset($_SESSION['user_id'])) {
		return false;
	}
	return true;
}

function isFirstLogin() {
	return $_SESSION['is_first_login'];
}

function currentUserId() {
	return $_SESSION['user_id'];
}

?>

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
    	<?php if (isLogedIn()) { ?>
			<li class="nav-item active">
				<a class="nav-link" href="/logout.php">Logout</a>
			</li>
		<?php } else {?>
			<li class="nav-item active">
				<a class="nav-link" href="/signin.php">Login</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="/user-regester.php">Regester</a>
			</li>
		<?php } ?>
	</ul>
	</div>
</nav>