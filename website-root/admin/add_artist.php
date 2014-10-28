<?php require_once('../inc/inc.php'); 
admin_only();


$sql = "select tour_number from artists";
$tour_number = mysql_query($sql);
while ($val = mysql_fetch_assoc($tour_number)) {
		$available[] = $val['tour_number'];
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
      map.setCenter(new GLatLng(48.825235,-123.492165), 11);
      map.enableContinuousZoom();
      map.enableScrollWheelZoom();
            map.addControl(new GMenuMapTypeControl());
      map2 = map;
    	var marker = createMarker(new GLatLng(48.825235,-123.492165),'');
		    	 GEvent.addListener(marker, "dragend", function() {
						var point = marker.getLatLng();
						var latA = point.y.toFixed(8);
						var lonA = point.x.toFixed(8);
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
	$('add_artist_button').removeAttribute('disabled');
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
		if ($F('name') == '') { alert("Please enter the studio name"); $('name').focus(); return(false) }
		if ($F('artist') == '') { alert("Please enter the artist's name"); $('artist').focus(); return(false) }
		if ($F('craft') == '') { alert("Please enter the artist's craft"); $('craft').focus(); return(false) }
		if ($F('blurb') == '') { alert("Please enter the artist's short blurb"); $('blurb').focus(); return(false) }
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
		<h3>Add new Artist</h3>
		<form action="artists.php" method="post" onsubmit="return (validate());" enctype="multipart/form-data">
		<table>
			<tr>
			<td width="420" valign="top">
			<table>
			<tr>
					<td>Tour #:</td><td><select name="tour_number">
										<?php for ($i = 1; $i< 41; $i++) {
											if (!in_array($i,$available)) { ?>
											
											<option <?php if (@$_REQUEST['tour_number'] == $i) { echo "selected='selected'";} ?> value="<?=$i?>"><?=$i?></option>
											
											<?php } else { ?>
											<option  value="" disabled ='disabled'><?=$i?> (unavailable)</option>
											<?php }
										} ?>
					</td>
				</tr>
				<tr>
					<td>Name:</td><td><input type="text" id="name" name="name" size="40" value="<?=@$_POST['name']?>" /></td>
				</tr>
				<tr>
					<td>Artist:</td><td><input type="text" id="artist" name="artist" size="40" value="<?=@$_POST['artist']?>" /></td>
				</tr>
				<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr>
					<td>Craft:</td><td><input type="text" id="craft" name="craft" size="40" value="<?=@$_POST['craft']?>" /></td>
				</tr>
				<tr>
					<td>Blurb:</td><td><input type="text" id="blurb" name="blurb" size="40" value="<?=@$_POST['blurb']?>" /></td>
				</tr>
				<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr> 
					<td>Address:</td><td><input type="text" id="address" name="address" size="30" /> <input type="submit" name="search" value="Search..." onclick="javascript: geoCode(); return false " style="padding: 2px; "/></td>
				</tr>
				<tr>
					<td>&nbsp;</td><td><input type="text" id="lat" name="lat"  style="background-color: #eee; border: none; text-align: center; padding: 3px; width: 100px;" value="48.78520350" />&nbsp;<input type="text" name="lng" id="lng" value="-123.46688150"  style="background-color: #eee; border: none; text-align: center; padding: 3px; width: 96px; margin-left: 0px;" /></td>
				</tr>
				<tr><td>Post Code:</td><td><input type="text" id="postal_code" name="postal_code" size="10" value="<?=@$record['postal_code'];?>" /></td></tr>
								<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr>
					<td>Phone:</td><td><input type="text" id="phone" name="phone" size="30" value="<?=@$_POST['phone']?>" /></td>
				</tr>
				<tr>
					<td>Email:</td><td><input type="text" id="email" name="email" size="30" value="<?=@$_POST['email']?>" /></td>
				</tr>
				<tr>
					<td>Website:</td><td>http://<input type="text" id="website" name="website" size="24" value="<?=@$_POST['website']?>" /></td>
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
							<td align="center"><input type="checkbox" name="debit" id="debit"></td>
							<td align="center"><input type="checkbox" name="visa" id="visa"></td>
							<td align="center"><input type="checkbox" name="mc" id="mc"></td>
							<td align="center"><input type="checkbox" name="wheelchair" id="wheelchair"></td>
							<td align="center"><input type="checkbox" name="bathroom" id="bathroom"></td>
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
					<td style="padding-top: 5px;">Sun:</td><td style="padding-top: 5px;"><input type="text" id="off_sun" name="off_sun" size="14" value="<?=@$_POST['off_sun']?>" ?></td><td style="padding-top: 5px;"><input type="text" id="peak_sun" name="peak_sun" size="14" value="<?=@$_POST['peak_sun']?>" /></td>
				</tr>
				
				<tr>
				<td >Mon:</td><td ><input type="text" id="off_mon" name="off_mon" size="14" value="<?=@$_POST['off_mon']?>" ?></td><td ><input type="text" id="peak_mon" name="peak_mon" size="14" value="<?=@$_POST['peak_mon']?>" /></td>
				</tr>
				
				<tr>
				<td >Tue:</td><td ><input type="text" id="off_tue" name="off_tue" size="14" value="<?=@$_POST['off_tue']?>" ?></td><td ><input type="text" id="peak_tue" name="peak_tue" size="14" value="<?=@$_POST['peak_tue']?>" /></td>
				</tr>
				
				<tr>
				<td >Wed:</td><td ><input type="text" id="off_wed" name="off_wed" size="14" value="<?=@$_POST['off_wed']?>" ?></td><td ><input type="text" id="peak_wed" name="peak_wed" size="14" value="<?=@$_POST['peak_wed']?>" /></td>
				</tr>
				
				<tr>
				<td >Thu:</td><td ><input type="text" id="off_thu" name="off_thu" size="14" value="<?=@$_POST['off_thu']?>" ?></td><td ><input type="text" id="peak_thu" name="peak_thu" size="14" value="<?=@$_POST['peak_thu']?>" /></td>
				</tr>
				
				<tr>
				<td >Fri:</td><td ><input type="text" id="off_fri" name="off_fri" size="14" value="<?=@$_POST['off_fri']?>" ?></td><td ><input type="text" id="peak_fri" name="peak_fri" size="14" value="<?=@$_POST['peak_fri']?>" /></td>
				</tr>
				
				<tr>
				<td >Sat:</td><td ><input type="text" id="off_sat" name="off_sat" size="14" value="<?=@$_POST['off_sat']?>" ?></td><td ><input type="text" id="peak_sat" name="peak_sat" size="14" value="<?=@$_POST['peak_sat']?>" /></td>
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
			<textarea style="width: 510px; height: 275px; font-family: 'Trebuchet MS';" name="copy" ></textarea>
			
			</td>
				
			</tr>
			<tr>
				<td colspan="2" align="center"><hr noshade size="1"><input type="submit" id="add_artist_button" name="add" value="+ Add Artist" disabled="disabled"/></td>
			</tr>
		</table>
		
				</form>
		
		
		
		
		
		<!--content--></div>
	
	<!--container--></div>

</body>
</html>
