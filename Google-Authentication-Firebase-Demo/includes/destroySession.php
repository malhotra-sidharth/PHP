<?php 
session_start();

require 'includes/connect.php';



if (isset($_SESSION['email'])){
	$connect = new makeConnection();
	$dbh = $connect -> connectDB();	
	// unset bit in database
	$query = "UPDATE records SET loggedIn = :log WHERE email=:email";
	$stmt = $dbh -> prepare($query);
	$arr = [":email" => $_SESSION['email'],
			":log" => "N"];
	$stmt -> execute($arr);
	unset($_SESSION['email']);
}	
if ($_SESSION['name'])
	unset($_SESSION['name']);
if ($_SESSION['uid'])
	unset($_SESSION['uid']);
if ($_SESSION['verified'])
	unset($_SESSION['verified']);

 ?>