<?php require_once('../inc/inc.php'); 
admin_only();
$sql = "select * from artists order by tour_number ASC";
$result = mysql_query($sql);

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

</head>
<body>

	<div id="container">
	
	<?php require_once('menu.php'); ?>
	
		<div id="content" >
		
		
		<?php while ($record = mysql_fetch_assoc($result)) { 
			
			$sql = "select count(*) as total_images from slideshow where artist_id = '$record[id]'";
			$total = mysql_query($sql) or die(mysql_error());
			$total = mysql_fetch_object($total);
			$total = $total->total_images;
			
			?>
	
			
				<div class="slideshow_item_wrap">
				
					<div class="slideshow_item_left"><img src="../images/sheep/<?=$record['tour_number']?>.png" height="20" style="margin-bottom: -5px;"/> <a href="manage_images.php?artist_id=<?=$record['id']?>"><?=$record['name']?></a> </div>
				
					<div class="slideshow_item_right"><strong><?=$total?></strong> images</div>
				
				<!--slideshow_item_wrap--></div>
				
				
				
		<?php } ?>
		
		<div style="clear: both;"></div>
		<!--content--></div>
	
	<!--container--></div>

</body>
</html>
