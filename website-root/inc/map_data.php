<?php
require_once('inc.php');
function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 

return $xmlStr; 
} 


$query = "SELECT * FROM artists";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}
header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';



// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
	//Pull image
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'id="' . parseToXML($row['id']) . '" ';
  echo 'name="' . parseToXML(stripslashes($row['name'])) . '" ';
  echo 'tour_number="' . parseToXML($row['tour_number']) . '" ';
  echo 'address="' . parseToXML($row['address']) . '" ';
  echo 'phone="' . parseToXML($row['phone']) . '" ';
  echo 'craft="' . parseToXML($row['craft']) . '" ';
  echo 'grid_thumb="' . parseToXML($row['grid_thumb']) . '" ';
  echo 'grid_photo="' . parseToXML($row['grid_photo']) . '" ';
  echo 'hours_sun="' . parseToXML($row['hours_sun']) . '" ';
  echo 'hours_mon="' . parseToXML($row['hours_mon']) . '" ';
  echo 'hours_tue="' . parseToXML($row['hours_tue']) . '" ';
  echo 'hours_wed="' . parseToXML($row['hours_wed']) . '" ';
  echo 'hours_thu="' . parseToXML($row['hours_thu']) . '" ';
  echo 'hours_fri="' . parseToXML($row['hours_fri']) . '" ';
  echo 'hours_sat="' . parseToXML($row['hours_sat']) . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'email="' . $row['email'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>