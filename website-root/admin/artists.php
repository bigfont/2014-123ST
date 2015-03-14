<?php require_once('../inc/inc.php');
admin_only();

///admin/artists.php //


if (isset($_GET['delete'])) {

	$sql = "select * from artists where id = '$_GET[delete]'";
	$result = mysql_query($sql);
	$record = mysql_fetch_object($result);

	if ($record->grid_thumb != 'unavailable_small.jpg') { unlink("../artists/" . $record->grid_thumb); }
	if ($record->grid_photo != 'unavailable_large.jpg') { unlink("../artists/" . $record->grid_photo); }

	$sql = "delete from artists where id = '$_GET[delete]'";
	mysql_query($sql);
	$message = "Artist Deleted Successfully";

}

if (isset($_POST['add'])) {

	//Check to see if thumbnail was uploaded
	if (($_FILES['grid_thumb']['error']) == 0) {
		//file was uploaded

			$grid_filename = $_POST['tour_number'] . "-" . time() . "_small.jpg";
			$grid_file_location = "../artists/" . $grid_filename;
			move_uploaded_file($_FILES['grid_thumb']['tmp_name'],$grid_file_location);

		} else {
		//file was not uploaded
			$grid_filename = "unavailable_small.jpg";
	}

	//Check to see if photo was uploaded
	if (($_FILES['grid_photo']['error']) == 0) {
		//file was uploaded

			$photo_filename = $_POST['tour_number'] . "-" . time() . ".jpg";
			$photo_file_location = "../artists/" . $photo_filename;
			move_uploaded_file($_FILES['grid_photo']['tmp_name'],$photo_file_location);

		} else {
		//file was not uploaded
			$photo_filename = "unavailable_large.jpg";
	}

	$copy = addslashes(($_POST['copy']));

	$email = '';
	$website = '';


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

	if ($_POST['lat'] == '') { $lat = "48.825235"; }
	if ($_POST['lng'] == '') { $lng = "-123.492165"; }


	$tour_number = $_POST['tour_number'];
	$view_order = $tour_number;


	$sql = "insert into artists (view_order,tour_number,name,artist,craft,address,phone,email,website,opt_visa,opt_mc,opt_debit,opt_bathroom,opt_wheelchair,off_sun,off_mon,off_tue,off_wed,off_thu,off_fri,off_sat,peak_sun,peak_mon,peak_tue,peak_wed,peak_thu,peak_fri,peak_sat,grid_thumb,grid_photo,copy,postal_code,lat,lng) values
			('$view_order',
			 '$tour_number',
			 '$name',
			 '$artist',
			 '$craft'
			 '$address',
			 '$phone',
			 '$email',
			 '$website',
			 '$opt_visa',
			 '$opt_mc',
			 '$opt_debit',
			 '$opt_bathroom',
			 '$opt_wheelchair',
			 '$off_sun',
			 '$off_mon',
			 '$off_tue',
			 '$off_wed',
			 '$off_thu',
			 '$off_fri',
			 '$off_sat',
			 '$peak_sun',
			 '$peak_mon',
			 '$peak_tue',
			 '$peak_wed',
			 '$peak_thu',
			 '$peak_fri',
			 '$peak_sat',
			 '$grid_filename',
			 '$photo_filename',
			 '$copy',
			 '$postal_code',
			 '$lat',
			 '$lng')";
 	mysql_query($sql) or die(mysql_error());
	$message = "New Artist Added Successfully";

}





$sql = "select * from artists order by view_order ASC";
$result = mysql_query($sql) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en" />
<meta name="AUTHOR" content="Balazs Bagi" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<title>Saltspring Studio Tour Administration</title>

<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type='text/javascript' src='js/prototype.js'></script>
<script type='text/javascript' src='js/scriptaculous.js'></script>
<script type="text/javascript">
Event.observe(window,'load',init,false);
	  function init() {
		<?php if (isset($_POST['update']) || isset($_POST['add']) || isset($_GET['delete'])) { ?>
			location.replace('artists.php');
		<?php } ?>
	  	Sortable.create('dispatchlist',{tag:'div',constraint: false, onUpdate:updateList});

		}
		function updateList(container) {
			var url = 'ajax_artists.php';
			var params = Sortable.serialize(container.id);
			var ajax = new Ajax.Request(url,{
				method: 'post',
				parameters: params
			});
		}

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
</script>
</head>
<body>

	<div id="container">
	<div id="loader" style="display: none;">Working...</div>
	<?php require_once('menu.php'); ?>

		<div id="content" >
		<h4 class="message"><?php if (isset($message)) { echo $message; } ?></h4>


		<h3>Studio Tour Artists</h3>
		<a href="add_artist.php">Click here to add artist</a>
		<br />
		<br />
				<hr noshade size="1"  align="center">

		<?php if (mysql_num_rows($result) < 1) { ?>
		No artists yet.
		<?php } else { ?>
		<div id="dispatchlist">
		<?php
		while ($record = mysql_fetch_assoc($result)) {
			?>
			<div class="drag_image" id="item_<?=$record['id'];?>">
			<div class="tour_number"><?=$record['tour_number'];?></div>


				<img src="../artists/<?=$record['grid_thumb'];?>" width="120" height="120" style="border: 1px solid #a00; margin-top: 12px;">
				<br /><a class="edit" href="edit_artist.php?id=<?=$record['id'];?>"><p style="font-size: 10px; display: block; margin-top: 10px;"><?=stripslashes($record['name']);?></span></a>
				<a style="position: absolute; bottom: 0; left: 0; background-color: #ff0; width: 100%; display: block; border-top: 1px solid #a00;"href="artists.php?delete=<?=$record['id'];?>" onclick="return confirm('Are you sure you want to delete that artist? THERE IS NO UNDO FOR THIS OPERATION!');"><span class="redText">Delete Artist<span></a>

			</div>
		<?php }

		?>
		<div style="clear: both;"></div>
		</div>
		<br /><br />
		<hr noshade size="1"  align="center">


		<?php } ?>


		<!--content--></div>

	<!--container--></div>

</body>
</html>

<!-- ABQIAAAAijTB_o7cWtS_p9ChwZLkOhRv-2Rol7HF38vv1CWfBs9JUd4zlRQ6HWIm7GljZO_m71x1qO0QvbHSsQ -->
