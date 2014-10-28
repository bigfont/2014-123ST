<?php require_once ('inc/inc.php');
$sql = "select * from artists order by view_order ASC";
$result = mysql_query($sql) or die(mysql_error());

$sql = "select * from artists order by tour_number ASC";
$options = mysql_query($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Language" content="en" />
<meta name="AUTHOR" content="Balazs Bagi" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php require_once("inc/meta.php"); ?>

<title>Salt Spring Studio Tour - The Artists</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="css/dd.css" />
<link rel="stylesheet" type="text/css" href="css/fancybox.css" />
<link rel="stylesheet" type="text/css" href="css/tipTip.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/fancybox.js"></script>
<script type="text/javascript" src="js/jquery.easing.js"></script>
<script type="text/javascript" src="js/jquery.dd.u.js"></script>
<script type="text/javascript" src="js/jquery.tipTip.js"></script>
<script type="text/javascript">

$(function() {
	//$("body").append("<div id='page_loading' style='width: 100%; height:100%; z-index: 99999;position: fixed; background-color: #fff;'><h1 style='margin-top: 300px; visibility: hidden;'>Loading... please wait</h1></div>");
	//$("#page_loading").fadeTo(0,0.8);
$("#artist_list").msDropDown();

	$(".homegrid_image").fadeTo(0,0.7)
						.hover(function() {
							$(this).fadeTo(200,1);
						},
						function() {
							$(this).fadeTo(200,0.7);
						}
	).tipTip({
	
				delay: 00,
				fadeIn: 200,
				fadeOut: 200
		
		});	
	$(".zoom").fancybox({
				titlePosition			: 'outside',
				padding					: 10,
				'transitionIn'			: 'elastic',
				'transitionOut'			: 'elastic',
				'hideOnContentClick'	: true,
				opacity		            : false,
				centerOnScroll          : true,
				overlayShow				: true,
				overlayOpacity			: .5,
				overlayColor			: "#000",
				hideOnContentClick		: false,
				changeSpeed				:300,	
				changeFade 				:0,
				autoScale				: false
				
			});


	$("#artist_list_submit").hide();

});

function goToUrl(id) {
		if (id == 'false') { return false } else {
		var loc = "view.php?artist=" + id;
		location.href = loc;
		}
}
$(window).load(function () {
  //$("#page_loading").fadeTo(100,0).remove();
});
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
<div id="artist_center_dropdown">
<div id="artist_center_dropdown_inner">
	<form name="gotoArtist" method="get" action="view.php">
		<select name="artist" id="artist_list" style="width: 800px;" onchange="goToUrl(this.value);">
			<option value="false">Click on an artist's picture below, or select a studio from this list...</option>
			<?php while ($r = mysql_fetch_assoc($options)) { ?>
			<option title="images/sheep/<?=$r['tour_number']?>.png" value="<?=$r['id']?>"> &nbsp;&nbsp;&nbsp;<?=stripslashes($r['name'])?> &mdash; <?=stripslashes($r['blurb']); ?></option>
			<?php } ?>
		</select><input type="submit" id="artist_list_submit" name="submit" value="Meet the Artist" style="display: inline;" />
						<div style="clear: both;"></div>
	</form>
</div>
</div>


		
			<div id="homegrid">
				<div id="grid">
				<?php 
				 while ($record = mysql_fetch_assoc($result)) {
				?>
				<a class="zoom" href="#data_<?=$record['id'];?>" rel="gal" ><img src="artists/<?=$record['grid_thumb']?>" title="<?=$record['name']?>" class="homegrid_image pgrid"  width="120" height="120" alt="" /></a>
				<?php } ?>
					<div class="clear"></div>
				<!--grid--></div>
			<!--homegrid--></div>
		
		
		<!--content--></div>
		
		<div style="display: none;">
		<?php 
		mysql_data_seek($result,0);
		while ($record = mysql_fetch_assoc($result)) { ?>
			<div class="artist_zoomBox" id="data_<?=$record['id'];?>">

				<img src="artists/<?=$record['grid_photo'];?>" class="gridphoto" alt="Artist Photo" />
			<img src='images/sheep/<?=$record['tour_number']?>.png' class='floatLeft' /><div class='floatLeft'><div class='zoomTitle'><?=stripslashes($record['name'])?></div><div class='zoom_craft'><?=stripslashes($record['craft'])?></div></div><a href='view.php?artist=<?=$record['id'];?>'><img src='images/meetsmall.jpg' alt='Click for more...' class='floatRight' style="z-index: 31000;"/></a><div style="clear: both;"></div>
			<!--data_<?=$record['id'];?>--></div>
			
			
			<?php } ?>
		
		</div>
		
	
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