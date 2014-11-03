<?php require_once("inc/inc.php");?>
<?php $sql = "select * from artists order by tour_number ASC";
$options = mysql_query($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Language" content="en" />
<meta name="AUTHOR" content="Balazs Bagi" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php require_once("inc/meta.php"); ?>

<title>Salt Spring Studio Tour</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="css/fancybox.css" />
<link rel="stylesheet" type="text/css" href="css/dd.css" />
<link rel="stylesheet" type="text/css" href="css/prettyPhoto.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;sensor=false&amp;key=<?=$api?>" type="text/javascript"></script>
<script src="js/map.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.dd.js"></script>
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
<script type="text/javascript">


function myclick(k) {
	
      			map2.setZoom(12);
      	      	map2.panTo(ext_markers[k].getLatLng());
        		GEvent.trigger(ext_markers[k], "click");
      }

$(function() {
 startMap();
 	$("#artist_list_submit").hide();
 	$("#artist_list").msDropDown();
 	
 				$("a[rel^='prettyPhoto']").prettyPhoto();
});


function goToUrl(id) {
		if (id == 'false') { return false } else {
		var loc = "view.php?artist=" + id;
		location.href = loc;
		}
}



</script>

</head>
<body>
<div id="wrap">
	<div id="container" class="clearfix">
		<div id="header">
			<div id="menu">
			<?php require_once("inc/menu.php"); ?>
			<!--menu--></div>
		<!--header--></div>
	
	
		
		<div id="content">
		
		<div id="map_detail">
		
			<img src="images/mapbook4.jpg" alt="Map Book" id="mapbook" />
			<a href="pdf/StudioTour2014.pdf" target="_blank">Download Map PDF (2.4MB)</a>
			<br />
			<br />
			<p>FREE Studio Tour Maps are available at:</p>
			<ul class="map_ul">
				<li>BC Ferries</li>
				<li>Info Centres</li>
				<li>Salt Spring Hotels</li>
				<li>Salt Spring Motels</li>
				<li>Salt Spring Marinas</li>
				<li>Bed & Breakfasts</li>
				<li>and many other convenient locations</li>
			</ul>
				
		<!--map_detail--></div>
		<div id="dropdown">
		<form name="gotoArtist" method="get" action="view.php">
		<select name="artist" id="artist_list" style="width: 100%" onchange="myclick(this.value);">
			<option value="false">Click on a sheep below or select a studio from this list...</option>
			<?php while ($r = mysql_fetch_assoc($options)) { ?>
			<option title="images/sheep/<?=$r['tour_number']?>.png" value="<?=$r['tour_number']?>"> &nbsp;&nbsp;&nbsp;<?=stripslashes($r['name'])?> &mdash; <?=stripslashes($r['blurb']); ?></option>
			<?php } ?>
		</select><input type="submit" id="artist_list_submit" name="submit" value="Meet the Artist" style="display: inline;" />
	</form>
	</div>
		<div id="mapwrap">
			<div id="map"></div>
				<div style="margin-top: 5px">
				<a href="largemap.php?iframe=true&width=100%&height=100%" rel="prettyPhoto" target="_blank"><img src="images/zoom.gif" id="zoom_icon" alt="Larger Map" /></a><a href="largemap.php?iframe=true&width=100%&height=100%" rel="prettyPhoto" target="_blank">Larger Map</a>
				</div>
		</div>
		
		
		
		<!--content--></div>
		
	
	<!--container--></div>
<!--wrap--></div>

<div id="footer_wrap">
	<div id="footer">
		<?php require_once("inc/footer.php"); ?>
	<!--footer --></div>
<!--footer_wrap--></div>

<?php require_once("inc/analytics.php"); ?>
</body>
</html>