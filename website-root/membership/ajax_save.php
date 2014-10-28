<?php
require_once ('inc/connect.php');
$id = $_SESSION['member'];
parse_str($_POST['data'], $data);

foreach ($data as $key => $val) {
	if ($val == 'on') {
		$data[$key] = 'y';
	}
}

$sql = "update profiles set

			visa = 'n',
			mastercard = 'n',
			amex = 'n',
			interac = 'n',
			wheelchair = 'n',
			saturday_market = 'n',
			cat_basketry = 'n',
			cat_fibre = 'n',
			cat_glass = 'n',
			cat_pottery = 'n',
			cat_sculpture = 'n',
			cat_candles = 'n',
			cat_food = 'n',
			cat_herbalfloral = 'n',
			cat_photography = 'n',
			cat_textiles = 'n',
			cat_clothing = 'n',
			cat_jewellery = 'n',
			cat_quilts = 'n',
			cat_weaving = 'n',
			cat_beerwine = 'n',
			cat_furniture = 'n',
			cat_paintingprint = 'n',
			cat_toys = 'n',
			cat_wood = 'n'
		
		where id = '$id'";

$result = mysql_query($sql) or die(mysql_error());

foreach ($data as $key => $val) {
	$val = addslashes($val);
	$sql = "update profiles set $key = '$val' where id = '$id'";
	//echo $sql;
	$result = mysql_query($sql) or die(mysql_error());
}



?>