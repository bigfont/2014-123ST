<?php require_once("inc/inc.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="width: 100%; height=100%;">
<head>
<meta http-equiv="Content-Language" content="en" />
<meta name="AUTHOR" content="Balazs Bagi" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php require_once("inc/meta.php"); ?>

<title>Salt Spring Studio Tour Map</title>

<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;sensor=false&amp;key=<?=$api?>" type="text/javascript"></script>
<script src="js/map.js" type="text/javascript"></script>

<script type="text/javascript">

$(function() {
 startMap();
 map2.setZoom(12);
});

</script>
</head>
<body style="background: none;">
		<div id="map" style="width: 100%;height: 100%; border: none;position: relative; top:0; left: 0; margin: 0; padding: 0; float: none;"></div>
		
		


<?php require_once("inc/analytics.php"); ?>
</body>
</html>