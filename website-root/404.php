<?php  
$location = "index.php";
header ('HTTP/1.1 301 Moved Permanently');
header ('Location: '.$location);
?>