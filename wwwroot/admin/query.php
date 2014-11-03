<?php
require('JSON.php');
require('../inc/inc.php');
	// Create aCURL object for later use 
	$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HEADER, 0); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			$url = "http://maps.google.com/maps/geo?output=json&key=" . $api . "&sensor=false&q="; 
			$q = $_REQUEST['address'];
			$q .= " Canada";
			$url .= urlencode($q); 
		
		// Query Google for this store's longitude and latitude 
curl_setopt($ch, CURLOPT_URL, $url); 
$response = curl_exec($ch); 
$googleresult = json_decode($response);
if (@$googleresult->Status->code == "200") {
$longitude = $googleresult->Placemark[0]->Point->coordinates[0];
$latitude = $googleresult->Placemark[0]->Point->coordinates[1];
$accuracy = ($googleresult->Placemark[0]->AddressDetails->Accuracy);
$location =  array();
$location['lat'] = $latitude;
$location['lng'] = $longitude;
$location['accuracy'] = $accuracy;
echo json_encode($location);
} else {
$location['lat'] = '';
$location['lng'] = '';
$location['accuracy'] = '<font color="red">0</font>';
echo json_encode($location);
}
?>