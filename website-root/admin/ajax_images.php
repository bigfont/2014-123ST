<?php 
require_once("../inc/inc.php");
function updateDispatch($orderArray) {
		$orderid = 0;
		foreach($orderArray as $catid) {
			$catid = (int) $catid;
			$sql = "UPDATE slideshow SET view_order={$orderid} WHERE id={$catid}";
			$recordSet = mysql_query($sql);
			$orderid++;
			 
		}
	}
updateDispatch($_REQUEST['dispatchlist']);
?>