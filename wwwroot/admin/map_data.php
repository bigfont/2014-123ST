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


$query = "SELECT * FROM installations";
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
	$imagesql = "select * from installation_gallery where install_id = '$row[id]' limit 0,1";
	$imageobject = mysql_fetch_object(mysql_query($imagesql));
	if (@$imageobject->filename) { $img = 'gallery/' . $imageobject->filename; } else { $img = 'false'; }
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'id="' . parseToXML($row['id']) . '" ';
  echo 'name="' . parseToXML($row['name']) . '" ';
  echo 'address="' . parseToXML($row['address']) . '" ';
  echo 'city="' . parseToXML($row['city']) . '" ';
  echo 'province="' . $row['province'] . '" ';
  echo 'phone="' . $row['phone'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'link="' . $row['link'] . '" ';
  echo 'shortlink="' . ShortenText($row['link'],30) . '" ';
  echo 'img="' . $img . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>