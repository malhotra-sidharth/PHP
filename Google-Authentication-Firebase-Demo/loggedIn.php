<?php
session_start();

	$_SESSION['email'] = $_POST['email'];
	$_SESSION['name'] = $_POST['name'];
	$_SESSION['uid'] = $_POST['uid'];
	$_SESSION['verified'] = $_POST['verified'];

	echo "Success";
?>