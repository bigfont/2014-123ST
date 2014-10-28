<?php require_once('../inc/inc.php'); 
admin_only();

if (!isset($_REQUEST['artist_id'])) { 
	header("location: images.php");
}

$sql = "select * from artists where id = '$_REQUEST[artist_id]'";
$result = mysql_query($sql);
if (mysql_num_rows($result) < 1) {
	header("location: images.php?nosuch");
} else {
	$artist = mysql_fetch_object($result);
}

if (isset($_GET['delete'])) {
	
	$sql = "select * from slideshow where id = '$_GET[delete]'";
	$result = mysql_query($sql);
	$record = mysql_fetch_object($result);
	
	unlink("../gallery/" . $record->image);
	
	$sql = "delete from slideshow where id = '$_GET[delete]'";
	mysql_query($sql);
	$message = "Image Deleted Successfully";

}

if (isset($_POST['add'])) {
	
	//Check to see if image was uploaded
	if (($_FILES['image']['error']) == 0) {
		//file was uploaded

			$image_filename = $artist->id . "-" . time() . ".jpg";
			$image_file_location = "../gallery/" . $image_filename;
			move_uploaded_file($_FILES['image']['tmp_name'],$image_file_location);
			$view_order = 0 - time();
			$sql = "insert into slideshow set artist_id = '$artist->id', view_order = '$view_order', image = '$image_filename'";
			$result = mysql_query($sql) or die(mysql_error());
			$message = "Image Uploaded Successfully";
			
		} else {
		//file was not uploaded
			$message = "Image not uploaded... please try again";
	}
}

$sql = "select * from slideshow where artist_id = '$_REQUEST[artist_id]' order by view_order ASC";
$result = mysql_query($sql) or die(mysql_error());

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
<script type="text/javascript">
Event.observe(window,'load',init,false);
	  function init() {

	  	<?php if (isset($_POST['add']) || isset($_GET['delete'])) { ?>
			location.replace('manage_images.php?artist_id=<?=$_REQUEST['artist_id']?>');
		<?php } ?>
	  	
	  	
	  	Sortable.create('dispatchlist',{tag:'div',constraint: false, onUpdate:updateList});
			
		}
		function updateList(container) {
			var url = 'ajax_images.php';
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

		<img src="../images/sheep/<?=$artist->tour_number?>.png" style="margin-bottom: -7px;" />&nbsp; <h3 style="display: inline"><?=$artist->name?></h3> <input type="button" name="finished" value="Finished" onclick="location.href='images.php';" style="float: right;">
		<hr noshade size="1">
<br />
		<form name="upload" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="artist_id" value="<?=$_REQUEST['artist_id']?>" />
		<input type="file" name="image" size="25"> &nbsp;&nbsp;&nbsp;<input type="submit" name="add" value="+ Upload Image" /> <br />500px X 375px JPG image ONLY please! 
		</form>
		
			
		<br />
				<hr noshade size="1"  align="center">
		
		<?php if (mysql_num_rows($result) < 1) { ?>
		No images yet. Use the field above to upload your first image.
		<?php } else { ?>
		<div id="dispatchlist">
		<?php 
		while ($record = mysql_fetch_assoc($result)) {
			?>
			<div class="drag_image2" id="item_<?=$record['id'];?>">
			
			
				<img src="../gallery/<?=$record['image'];?>" width="95" height="70" style="border: 1px solid #a00; margin-top: 12px; cursor: pointer;">
				<a href="#" onclick="window.open('../gallery/<?=$record['image'];?>','mywindow','width=520, height=395');">(Preview)</a>
				
				<a style="position: absolute; bottom: 0; left: 0; background-color: #ff9; width: 100%; display: block; border-top: 1px solid #a00;"href="manage_images.php?artist_id=<?=$_REQUEST['artist_id']?>&delete=<?=$record['id'];?>" onclick="return confirm('Are you sure you want to delete that image? THERE IS NO UNDO FOR THIS OPERATION!');"><span class="redText">Delete Image<span></a>
			
			</div>
		<?php } 
		
		?>
		<div style="clear: both;"></div>
		</div>
		<br /><br />
		<hr noshade size="1"  align="center">
		
		
		<?php } ?>
		
		<div style="clear: both;"></div>
		<!--content--></div>
	
	<!--container--></div>

</body>
</html>
