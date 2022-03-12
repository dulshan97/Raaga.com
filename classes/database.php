<?php
function dbConnect() {
	$host = 'localhost';
	$user = 'root';
	$pass = 'root';
	$db = 'raaga';

	$conn = new mysqli($host, $user, $pass, $db) or die('Connection faild: ' . $conn->error);

	return $conn;
}