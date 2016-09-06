<?php
session_start();

//include header
include 'includes/header.php';	

 require 'includes/connect.php';	
 require 'includes/geoplugin.class.php';
 require 'includes/distanceClass.php';

if ($_SESSION['verified']){
	// make connection to DB
	$connect = new makeConnection();
	$dbh = $connect -> connectDB();

	// instantiate geoplugin
	$geo = new geoPlugin();
	$geo->locate();
	$city = $geo -> city;
	$latitude = $geo -> latitude;
	$longitude = $geo -> longitude;

	// update database with current user attributes
	// add in DB if new user else update records
	$query = "SELECT id FROM records WHERE email = :email";
	$stmt = $dbh -> prepare($query);
	$stmt -> bindParam(":email", $_SESSION['email']);
	$stmt -> execute();
	$userExits = $stmt -> fetch();

	// array for execute statement
	$arr = [":email" => $_SESSION['email'],
			":name" => $_SESSION['name'],
			":lat" => $latitude,
			":long" => $longitude,
			":city" => $city,
		    ":log" => "Y"];

	if ($userExits == 0){
		// New User
		// Insert in the DB
		$query = "INSERT INTO records(email, name, latitude, longitude, city, loggedIn)VALUES(:email, :name, :lat, :long, :city, :log)";
		$stmt = $dbh -> prepare($query);
		$stmt -> execute($arr);

	}else{
		// User already Exists
		// Update records with new latitude and longitude
		$query = "UPDATE records SET name=:name, latitude = :lat, longitude=:long, loggedIn=:log, city=:city WHERE email=:email";
		$stmt = $dbh -> prepare($query);
		$stmt -> execute($arr);
	}

	
	// instantiate distanceClass
	$distance = new getGeoDistance();
	$nearUsers = $distance -> getNearUsers($latitude, $longitude, $city, $dbh, $_SESSION['email']);

	// Sort users according to the distance between them
	foreach ($nearUsers as $key => $value){
		$dist["$key"] = $nearUsers["$key"] -> rows[0] -> elements[0] -> distance -> text;
		
		// convert m to km and to int
		$distArray = explode(" ", $dist["$key"]);
		if ($distArray[1] == 'm'){
			$distArray[0] = (int)($distArray[0])/1000;
		}

		$dist["$key"] = $distArray[0];
	}

	// sort the array in ascending order
	asort($dist);

	// display output
	echo "<div class='container'>
			<div class='row'>
			<div class='col-md-offset-4 col-md-4' style='margin-top:10%'>
			<h3 style='text-align:center;'>Nearby users who are online.</h3><ul>";

			foreach ($dist as $key => $value){
				echo "<li>".$key." (".$value." km)</li>";
			}

	echo "<br/><br/><button onclick='LogOut()' class='btn btn-primary'>Log Out</button></ul></div>
			<p>** Aayush and Pradeep are demo users. They will be always shown online.<br/>
			**Login with different users simultaneously and you will see them in the list of nearby users if they belong to the same city you belong to.</p>
			</div>
		  </div>";

	
	

}
else
	echo "<h3>Please Verify your email first!!</h3>";


// include footer
	include 'includes/footer.php';
?>