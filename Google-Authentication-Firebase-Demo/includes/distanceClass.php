<?php 
class getGeoDistance{

private $api_key= "AIzaSyARs8DnGcg-M61lV-D4nX_1Kp5jYhgOxuc";


// This function takes latitude, longitude and
// city of the user and outputs all the logged in
//  users near him in the same city.
function getNearUsers($lat, $long, $city, $dbh, $email){
		// get all the logged in users
		// within the same city
		//echo "$lat $long $city";
		$key = $this -> api_key;

		$query = "SELECT name, latitude, longitude FROM records WHERE city=:city AND loggedIn=:log AND email != :email";
		$stmt = $dbh -> prepare($query);
		$arr = [":city" => $city,
				":log" => "Y",
				":email" => $email];
		$stmt -> execute($arr);
		$sameCityUsers = $stmt -> fetchAll();

		for ($i = 0; $i < count($sameCityUsers); $i++){
			// calculate distance using google distance matrix API
			// and latitude and longitude of the user
			$destLat = $sameCityUsers[$i] -> latitude;
			$destLong = $sameCityUsers[$i] -> longitude;
			$name = $sameCityUsers[$i] -> name;

			$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat.",".$long."&destinations=".$destLat.",".$destLong."&units=metric&key=".$key;
			$data["$name"] = json_decode(file_get_contents($url));	

		}		


		return $data;

	}
}	
 ?>