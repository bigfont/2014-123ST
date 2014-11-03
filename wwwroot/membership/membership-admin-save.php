<?php
require_once ('inc/connect.php');
$d = explode('-',$_POST['id']);
$val = addslashes($_POST['value']);
$what = $d[0];
$id = $d[1];

$sql = "update profiles set $what = '$val' where id = '$id'";
$result = mysql_query($sql);

echo stripslashes($val);
?>