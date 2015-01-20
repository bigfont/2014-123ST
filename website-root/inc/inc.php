<?php

require_once ($_SERVER["DOCUMENT_ROOT"] . '/passwords.php');


	session_start();

  $db = $DATABASE_NAME; 
$host = $DATABASE_HOST;
$user = $DATABASE_USER;
$pass = $DATABASE_PASSWORD;

	$api = "ABQIAAAARF2-rsGK-9SnmPUa4Z9BVhSw_XUxS-1rSleO7ioMqdxOoBDP5RTZ04X1cFPYx3B3Ro84BuO_6yjmRA"; //192.168.1.104
	$api = "ABQIAAAARF2-rsGK-9SnmPUa4Z9BVhSeE3pgkb2db23TzgDkBn5OBFKbYBSEcQUhAlg7ibm5Bjf02PXhf4qRdg"; //Webmechanic
	$api = "ABQIAAAARF2-rsGK-9SnmPUa4Z9BVhTyPkaBe4qi3DVZ-qQx_QRDwHTmvhSsJRkOVln4HXeGNZboUU0fCnxvhw"; //Host Gator Temp
	$api = "ABQIAAAARF2-rsGK-9SnmPUa4Z9BVhRGkzzA6C0Hd933s8y5YXSuhnqpQRTk2CXx4VdhTTi8_OixjEV1tPy3Cw"; //StudioTour.com
	$conn = mysql_connect($host,$user,$pass) or die(mysql_error());
	$d = mysql_select_db($db); // or die(mysql_error());

function admin_logged_in() {

	if (isset($_SESSION['admin_id'])) {
		return TRUE;
	} else {
		return FALSE;
	}

}

function admin_only() {

	if (!admin_logged_in()) {
		header("location: index.php");
	}

}


function br2p($copy) {
	return str_replace("<br>","</p><p>",$copy);
}

function artistCount() {
	$sql = "select count(id) as total_artists from artists";
	$result = mysql_query($sql);
	$record = mysql_fetch_object($result);
	return $record->total_artists;
}

function ShortenText($text, $len) {
		if (strlen($text) > $len) {
			$ending = '...';
		} else {
			$ending = '';
		}
        $chars = $len;
        $text = $text." ";
        $text = substr($text,0,$chars);
        $text = $text.$ending;
        return $text;
    }
?>
