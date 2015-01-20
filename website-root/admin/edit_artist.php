<?php require_once('../inc/inc.php');

//admin/edit_artists.php //
admin_only();

if (!isset($_REQUEST['id'])) {
	header("location: artists.php");
}

$sql = "select * from artists where id = '$_REQUEST[id]'";
$result = mysql_query($sql);
if (mysql_num_rows($result) < 1) {
	header("location: artists.php?nosuch");
}

if (isset($_POST['update'])) {

	//Check to see if thumbnail was uploaded
	if (($_FILES['grid_thumb']['error']) == 0) {
		//file was uploaded

		/* REMEMBER TO DELETE THE OLD IMAGE IF UPDATING THE IMAGE AND IT'S NOT THE UNAVAILABLE PHOTO */

			$grid_filename = $_POST['tour_number'] . "-" . time() . "_small.jpg";
			$grid_file_location = "../artists/" . $grid_filename;
			move_uploaded_file($_FILES['grid_thumb']['tmp_name'],$grid_file_location);

		} else {
		//file was not uploaded
			$sql = "select grid_thumb from artists where id = '$_POST[id]'";
			$result = mysql_query($sql);
			$grid_filename = mysql_fetch_object($result);
			$grid_filename = $grid_filename->grid_thumb;
	}

	//Check to see if photo was uploaded
	if (($_FILES['grid_photo']['error']) == 0) {
		//file was uploaded


				/* REMEMBER TO DELETE THE OLD IMAGE IF UPDATING THE IMAGE AND IT'S NOT THE UNAVAILABLE PHOTO */

			$photo_filename = $_POST['tour_number'] . "-" . time() . ".jpg";
			$photo_file_location = "../artists/" . $photo_filename;
			move_uploaded_file($_FILES['grid_photo']['tmp_name'],$photo_file_location);

		} else {
		//file was not uploaded
			$sql = "select grid_photo from artists where id = '$_POST[id]'";
			$result = mysql_query($sql);
			$photo_filename = mysql_fetch_object($result);
			$photo_filename = $photo_filename->grid_photo;
	}


	$opt_visa = @$_POST['visa'];
	$opt_mc = @$_POST['mc'];
	$opt_debit = @$_POST['debit'];
	$opt_bathroom = @$_POST['bathroom'];
	$opt_wheelchair = @$_POST['wheelchair'];

	if ($opt_visa == 'on') { $opt_visa ='y'; } else { $opt_visa = 'n'; }
	if ($opt_mc == 'on') { $opt_mc ='y'; } else { $opt_mc = 'n'; }
	if ($opt_debit == 'on') { $opt_debit ='y'; } else { $opt_debit = 'n'; }
	if ($opt_bathroom == 'on') { $opt_bathroom ='y'; } else { $opt_bathroom = 'n'; }
	if ($opt_wheelchair == 'on') { $opt_wheelchair ='y'; } else { $opt_wheelchair = 'n'; }




	$copy = addslashes(($_POST['copy']));

	$email = '';
	$website = '';

		$postal_code = $_POST['postal_code'];

	$name = addslashes(htmlentities($_POST['name']));
	$artist = addslashes(htmlentities($_POST['artist']));
	$craft = addslashes(htmlentities($_POST['craft']));
		$address = htmlentities($_POST['address']);
		$address = addslashes($address);
	$phone = htmlentities($_POST['phone']);
	$email = htmlentities(@$_POST['email']);
	$website = htmlentities(@$_POST['website']);


	$off_sun = htmlentities($_POST['off_sun']);
	$off_mon = htmlentities($_POST['off_mon']);
	$off_tue = htmlentities($_POST['off_tue']);
	$off_wed = htmlentities($_POST['off_wed']);
	$off_thu = htmlentities($_POST['off_thu']);
	$off_fri = htmlentities($_POST['off_fri']);
	$off_sat = htmlentities($_POST['off_sat']);



	$peak_sun = htmlentities($_POST['peak_sun']);
	$peak_mon = htmlentities($_POST['peak_mon']);
	$peak_tue = htmlentities($_POST['peak_tue']);
	$peak_wed = htmlentities($_POST['peak_wed']);
	$peak_thu = htmlentities($_POST['peak_thu']);
	$peak_fri = htmlentities($_POST['peak_fri']);
	$peak_sat = htmlentities($_POST['peak_sat']);

	$lat = $_POST['lat'];
	$lng = $_POST['lng'];

	$tour_number = $_POST['tour_number'];


	$sql = "update artists set grid_thumb = '$grid_filename', grid_photo = '$photo_filename', name = '$name', artist = '$artist', craft = '$craft', address = '$address', phone = '$phone', email = '$email', website = '$website', opt_visa = '$opt_visa', opt_mc = '$opt_mc', opt_debit = '$opt_debit', opt_bathroom = '$opt_bathroom', opt_wheelchair = '$opt_wheelchair', off_sun = '$off_sun', off_mon = '$off_mon', off_tue = '$off_tue', off_wed = '$off_wed', off_thu = '$off_thu', off_fri = '$off_fri', off_sat = '$off_sat', peak_sun = '$peak_sun', peak_mon = '$peak_mon', peak_tue = '$peak_tue', peak_wed = '$peak_wed', peak_thu = '$peak_thu', peak_fri = '$peak_fri', peak_sat = '$peak_sat', lat = '$lat', lng = '$lng', tour_number = '$tour_number', copy = '$copy', postal_code = '$postal_code' where id = '$_POST[id]'";

	$result = mysql_query($sql) or die(mysql_error());

	$message = "Updated Artist Successfully - <a href='artists.php'>(go back)</a>";
}

$sql = "select * from artists where id = '$_REQUEST[id]'";
$result = mysql_query($sql);
$record = mysql_fetch_assoc($result);
$sql = "select tour_number from artists";
$tour_number = mysql_query($sql);
while ($val = mysql_fetch_assoc($tour_number)) {
		if ($record['tour_number'] != $val['tour_number']) {
		$available[] = $val['tour_number'];
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en" />
<meta name="AUTHOR" content="Balazs Bagi" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<title>Salt Spring Studio Tour Administration</title>

<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type='text/javascript' src='js/prototype.js'></script>
<script type='text/javascript' src='js/scriptaculous.js'></script>
<script type="text/javascript" src="js/tiny_mce.js"></script>


<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;sensor=false&amp;key=<?=$api?>" type="text/javascript"></script>
<script type="text/javascript">
var map2;
function startMap() {
//<![CDATA[
if (GBrowserIsCompatible()) {






      // Display the map, with some controls and set the initial location
      var map = new GMap2(document.getElementById("map"));

      map.addControl(new GLargeMapControl3D());
      map.setCenter(new GLatLng(<?=$record['lat']?>,<?=$record['lng']?>), 15);
      map.enableContinuousZoom();
      map.enableScrollWheelZoom();
            map.addControl(new GMenuMapTypeControl());
      map2 = map;
    	var marker = createMarker(new GLatLng(<?=$record['lat']?>,<?=$record['lng']?>),'');
		    	 GEvent.addListener(marker, "dragend", function() {
						var point = marker.getLatLng();
						var latA = point.y.toFixed(6);
						var lonA = point.x.toFixed(6);
						document.getElementById('lng').value = lonA;
						document.getElementById('lat').value = latA;
					});
    	map2.clearOverlays();

     	 map2.addOverlay(marker);







     // map.addControl(new GLargeMapControl3D());





    // display a warning if the browser was not compatible
} else {
      alert("Sorry, the Google Maps API is not compatible with this browser");
    }
}

  //]]>



//END LOAD

Ajax.Responders.register({
onCreate : showLoader,
onComplete : hideLoader
});


function showLoader() {
		$('loader').style.backgroundColor = '#b00';
		$('loader').innerHTML = 'Working...';
		$('loader').show();
}

		function fadeOut() {
			new Effect.Fade('loader')
		}

		function done() {
					$('loader').style.backgroundColor = '#0b0';
		$('loader').innerHTML = 'Done!';
		}

function hideLoader() {


		setTimeout('done()',200);
		setTimeout('fadeOut()',1000);
}

function fetchProperties(address) {

	new Ajax.Request('query.php',
		{
			method: 'post',
			parameters:
				{
					address: address,
				},
			onSuccess: function(transport) {
				UpdateProperties(transport);
			},
			onFailure: function() {

			}
		}
	);
}

function UpdateProperties(json_data) {
	var properties = json_data.responseText.evalJSON();
	$('lat').value = properties.lat.toFixed(8);
	$('lng').value = properties.lng.toFixed(8);
	$('accuracy').innerHTML = 'Geocode Accuracy (1 - 8): <strong>' + properties.accuracy + '</strong>'
	if (properties.accuracy < 10) {
		updateMap();
	}
}

function geoCode() {
	var address = $F('address');
	var query = address + "Capital F";
	fetchProperties(query);
}

function createMarker(point,html) {

	var iconSheep = new GIcon();
iconSheep.image = '../images/SheepMarker/image.png';
iconSheep.printImage = '../images/SheepMarker/printImage.gif';
iconSheep.mozPrintImage = '../images/SheepMarker/mozPrintImage.gif';
iconSheep.iconSize = new GSize(32,26);
iconSheep.shadow = '../images/SheepMarker/shadow.png';
iconSheep.transparent = '../images/SheepMarker/transparent.png';
iconSheep.shadowSize = new GSize(45,26);
iconSheep.printShadow = '../images/SheepMarker/printShadow.gif';
iconSheep.iconAnchor = new GPoint(12,22);
iconSheep.infoWindowAnchor = new GPoint(16,0);
iconSheep.imageMap = [27,0,26,1,28,2,29,3,30,4,30,5,31,6,31,7,31,8,26,9,26,10,26,11,26,12,26,13,25,14,25,15,25,16,24,17,23,18,22,19,22,20,22,21,22,22,22,23,22,24,22,25,2,25,2,24,2,23,2,22,2,21,2,20,2,19,2,18,2,17,3,16,2,15,0,14,0,13,0,12,0,11,0,10,0,9,1,8,2,7,2,6,5,5,6,4,20,3,21,2,23,1,25,0];




        var marker = new GMarker(point, {draggable: true, icon:iconSheep});
        return marker;
      }


function updateMap() {
		var junklat = $F('lat');
		var junklng = $F('lng');
		map2.setCenter(new GLatLng(junklat,junklng), 15);
		var point = new GLatLng(junklat,junklng);
    	var marker = createMarker(point,'');
		    	 GEvent.addListener(marker, "dragend", function() {
						var point = marker.getLatLng();
						var latA = point.y.toFixed(8);
						var lonA = point.x.toFixed(8);
						document.getElementById('lng').value = lonA;
						document.getElementById('lat').value = latA;
					});
    	map2.clearOverlays();

     	 map2.addOverlay(marker);



}

function validate() {
		if ($F('name') == '') { alert ($F('name')); alert("Please enter the studio name"); $('name').focus(); return(false) }
		if ($F('artist') == '') { alert("Please enter the artist's name"); $('artist').focus(); return(false) }
		if ($F('craft') == '') { alert("Please enter the artist's craft"); $('craft').focus(); return(false) }
		if ($F('address') == '') { alert("Please enter the artist's Address"); $('address').focus(); return(false) }
		if ($F('postal_code') == '') { alert("Please enter the artist's Postal Code"); $('postal_code').focus(); return(false) }
		if ($F('phone') == '') { alert("Please enter the artist's Phone number"); $('phone').focus(); return(false) }
		if ($F('off_sun') == '') { alert("Please enter Off Season Sunday Hours"); $('off_sun').focus(); return(false) }
		if ($F('off_mon') == '') { alert("Please enter Off Season Monday Hours"); $('off_mon').focus(); return(false) }
		if ($F('off_tue') == '') { alert("Please enter Off Season Tuesday Hours"); $('off_tue').focus(); return(false) }
		if ($F('off_wed') == '') { alert("Please enter Off Season Wednesday Hours"); $('off_wed').focus(); return(false) }
		if ($F('off_thu') == '') { alert("Please enter Off Season Thursday Hours"); $('off_thu').focus(); return(false) }
		if ($F('off_fri') == '') { alert("Please enter Off Season Friday Hours"); $('off_fri').focus(); return(false) }
		if ($F('off_sat') == '') { alert("Please enter Off Season Saturday Hours"); $('off_sat').focus(); return(false) }



		if ($F('peak_sun') == '') { alert("Please enter Peak Season Sunday Hours"); $('peak_sun').focus(); return(false) }
		if ($F('peak_mon') == '') { alert("Please enter Peak Season Monday Hours"); $('peak_mon').focus(); return(false) }
		if ($F('peak_tue') == '') { alert("Please enter Peak Season Tuesday Hours"); $('peak_tue').focus(); return(false) }
		if ($F('peak_wed') == '') { alert("Please enter Peak Season Wednesday Hours"); $('peak_wed').focus(); return(false) }
		if ($F('peak_thu') == '') { alert("Please enter Peak Season Thursday Hours"); $('peak_thu').focus(); return(false) }
		if ($F('peak_fri') == '') { alert("Please enter Peak Season Friday Hours"); $('peak_fri').focus(); return(false) }
		if ($F('peak_sat') == '') { alert("Please enter Peak Season Saturday Hours"); $('peak_sat').focus(); return(false) }

}

</script>
</head>
<body onload="startMap();">

	<div id="container">

		<div id="loader" style="display: none;">Working...</div>

	<?php require_once('menu.php'); ?>

		<div id="content" >
		<h4 class="message"><?php if (isset($message)) { echo $message; } ?></h4>
		<h3>Update Artist #<?=$record['tour_number']?> &mdash; <?=stripslashes($record['name'])?></h3>
		<form action="edit_artist.php" method="post" onsubmit="return (validate());" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
		<table >
			<tr>
			<td width="410" valign="top">
			<table>
			<tr>
					<td>Tour #:</td><td><select name="tour_number">
										<?php echo $record['tour_number']; for ($i = 1; $i< 41; $i++) {
											if (!in_array($i,$available)) { ?>

											<option <?php if (@$record['tour_number'] == $i) { echo "selected='selected'";} ?> value="<?=$i?>"><?=$i?> <?php if (@$record['tour_number'] == $i) { echo "(current)";} ?></option>

											<?php } else  { ?>
											<option  value="" disabled ='disabled'><?=$i?> (unavailable)</option>
											<?php }
										} ?>
					</td>
				</tr>
				<tr>
					<td>Name:</td><td><input type="text" id="name" name="name" size="40" value="<?=stripslashes(@$record['name'])?>" /></td>
				</tr>
				<tr>
					<td>Artist:</td><td><input type="text" id="artist" name="artist" size="40" value="<?=stripslashes(@$record['artist'])?>" /></td>
				</tr>
				<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr>
					<td>Craft:</td><td><input type="text" id="craft" name="craft" size="40" value="<?=stripslashes(@$record['craft'])?>" /></td>
				</tr>
				<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr>
					<td>Address:</td><td><input type="text" id="address" name="address" value="<?=stripslashes(@$record['address'])?>"  size="30" /> <input type="submit" name="search" value="Search..." onclick="javascript: geoCode(); return false " style="padding: 2px; "/></td>
				</tr>
				<tr>
					<td>&nbsp;</td><td><input type="text" id="lat" name="lat"  value="<?=@$record['lat']?>" style="background-color: #eee; border: none; text-align: center; padding: 3px; width: 100px;" />&nbsp;<input type="text" name="lng" id="lng" value="<?=@$record['lng']?>"   style="background-color: #eee; border: none; text-align: center; padding: 3px; width: 96px; margin-left: 0px;" /></td>
				</tr>

				<tr><td>Post Code:</td><td><input type="text" id="postal_code" name="postal_code" size="10" value="<?=@$record['postal_code'];?>" /></td></tr>

								<tr><td>&nbsp;</td><td>&nbsp;</td></tr>

				<tr>
					<td>Phone:</td><td><input type="text" id="phone" name="phone" size="30" value="<?=@$record['phone']?>" /></td>
				</tr>
				<tr>
					<td>Email:</td><td><input type="text" id="email" name="email" size="30" value="<?=@$record['email']?>" /></td>
				</tr>
				<tr>
					<td>Website:</td><td>http://<input type="text" id="website" name="website" size="24" value="<?=@$record['website']?>" /></td>
				</tr>

								<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr>
					<td colspan="2">
					<table width="100%" class="artist_opts">
						<tr >
							<td align="center"><label for="debit"><img src="../images/debit.gif"></label></td>
							<td align="center"><label for="visa"><img src="../images/visa.gif"></label></td>
							<td align="center"><label for="mc"><img src="../images/mastercard.gif"></label></td>
							<td align="center"><label for="wheelchair"><img src="../images/wheelchair.gif"></label></td>
							<td align="center"><label for="bathroom"><img src="../images/bathroom.gif"></label></td>
						</tr>
						<tr>
							<td align="center"><input type="checkbox" name="debit" id="debit" <?php if (@$record['opt_debit'] == 'y') echo "checked='checked'"; ?>></td>
							<td align="center"><input type="checkbox" name="visa" id="visa" <?php if (@$record['opt_visa'] == 'y') echo "checked='checked'"; ?>></td>
							<td align="center"><input type="checkbox" name="mc" id="mc" <?php if (@$record['opt_mc'] == 'y') echo "checked='checked'"; ?>></td>
							<td align="center"><input type="checkbox" name="wheelchair" id="wheelchair" <?php if (@$record['opt_wheelchair'] == 'y') echo "checked='checked'"; ?>></td>
							<td align="center"><input type="checkbox" name="bathroom" id="bathroom" <?php if (@$record['opt_bathroom'] == 'y') echo "checked='checked'"; ?>></td>
						</tr>
					</table>
					</td>
				</tr>

				<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			</table>
			<table border="0" width="370">

				<tr>
					<td valign="top" colspan="1" style="border-bottom: 1px solid #ddd; ">Hours:</td><td style="border-bottom: 1px solid #ddd; ">Winter/Fall</td><td style="border-bottom: 1px solid #ddd; ">Spring/Summer</td>
				</tr>
				<tr>
					<td style="padding-top: 5px;">Sun:</td><td style="padding-top: 5px;"><input type="text" id="off_sun" name="off_sun" size="14" value="<?=@$record['off_sun']?>" ?></td><td style="padding-top: 5px;"><input type="text" id="peak_sun" name="peak_sun" size="14" value="<?=@$record['peak_sun']?>" /></td>
				</tr>

				<tr>
				<td >Mon:</td><td ><input type="text" id="off_mon" name="off_mon" size="14" value="<?=@$record['off_mon']?>" ?></td><td ><input type="text" id="peak_mon" name="peak_mon" size="14" value="<?=@$record['peak_mon']?>" /></td>
				</tr>

				<tr>
				<td >Tue:</td><td ><input type="text" id="off_tue" name="off_tue" size="14" value="<?=@$record['off_tue']?>" ?></td><td ><input type="text" id="peak_tue" name="peak_tue" size="14" value="<?=@$record['peak_tue']?>" /></td>
				</tr>

				<tr>
				<td >Wed:</td><td ><input type="text" id="off_wed" name="off_wed" size="14" value="<?=@$record['off_wed']?>" ?></td><td ><input type="text" id="peak_wed" name="peak_wed" size="14" value="<?=@$record['peak_wed']?>" /></td>
				</tr>

				<tr>
				<td >Thu:</td><td ><input type="text" id="off_thu" name="off_thu" size="14" value="<?=@$record['off_thu']?>" ?></td><td ><input type="text" id="peak_thu" name="peak_thu" size="14" value="<?=@$record['peak_thu']?>" /></td>
				</tr>

				<tr>
				<td >Fri:</td><td ><input type="text" id="off_fri" name="off_fri" size="14" value="<?=@$record['off_fri']?>" ?></td><td ><input type="text" id="peak_fri" name="peak_fri" size="14" value="<?=@$record['peak_fri']?>" /></td>
				</tr>

				<tr>
				<td >Sat:</td><td ><input type="text" id="off_sat" name="off_sat" size="14" value="<?=@$record['off_sat']?>" ?></td><td ><input type="text" id="peak_sat" name="peak_sat" size="14" value="<?=@$record['peak_sat']?>" /></td>
				</tr>
				</table>
				<table width="370">

								<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr>
					<td>Thumb:</td><td><input type="file" name="grid_thumb" id="grid_thumb" size="13"/> (120px X 120px)</td>
				</tr>
				<tr>
					<td>Photo:</td><td><input type="file" name="grid_photo" id="grid_photo" size="13" /> (600px X 400px)</td>
				</tr>

			</table>


			</td>
		 	<div id="latlong"></div>
			<div id='accuracy'>Geocode Accuracy (1 - 8): </div>
			<td valign="top">
				<div id="map" style="width: 510px; height: 490px; border: 1px solid black;"></div>
			<br />
			<textarea style="width: 510px; height: 275px; font-family: 'Trebuchet MS';" name="copy" ><?=stripslashes($record['copy']);?></textarea>

			</td>

			</tr>
			<tr>
				<td colspan="2" align="center"><hr noshade size="1"><input type="button" onclick="location.href='artists.php'" value="<< Go back"></button> &nbsp;&nbsp;<input type="submit" name="update" value="Update Artist..." /></td>
			</tr>
		</table>

				</form>





		<!--content--></div>

	<!--container--></div>

</body>
</html>

<!-- ABQIAAAAijTB_o7cWtS_p9ChwZLkOhRv-2Rol7HF38vv1CWfBs9JUd4zlRQ6HWIm7GljZO_m71x1qO0QvbHSsQ -->
