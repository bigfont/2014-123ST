<?php
require_once ('inc/connect.php');
$id = str_replace('edit_','',$_POST['id']);
$val = $_POST['value'];


$sql = "update images set caption = '$val' where id = '$id'";
$result = mysql_query($sql);


echo nl2br($val);
?>