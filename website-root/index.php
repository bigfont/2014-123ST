<?php require_once("inc/inc.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Language" content="en" />
<meta name="AUTHOR" content="Balazs Bagi" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php require_once("inc/meta.php"); ?>
<meta name="google-site-verification" content="3xZoAeZNg-KDwwwvkbR8hDdD_B-xrJduEVhH6CwbbUU" />
<title>Salt Spring Studio Tour</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">

$(function() {

	$(".shomegrid_image").fadeTo(0,0.8)
						.hover(function() {
							$(this).fadeTo(200,1);
						},
						function() {
							$(this).fadeTo(200,0.8);
						}
	);


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
		
			<div id="homegrid">
				<div id="grid">
					<img src="images/home/2014/1.jpg" class="homegrid_image right10" alt="" />
					<img src="images/home/2014/2.jpg" class="homegrid_image left10 right10" alt="" />
					<img src="images/home/2014/3.jpg" class="homegrid_image left10 right10" alt="" />
					<img src="images/home/2014/4.jpg" class="homegrid_image left10" alt="" />
					
					<img src="images/home/2014/5.jpg" class="homegrid_image right10" alt="" />
					<img src="images/home/2014/6.jpg" class="homegrid_image left10 right10" alt="" />
					<img src="images/home/2014/7.jpg" class="homegrid_image left10 right10" alt="" />
					<img src="images/home/2014/8.jpg" class="homegrid_image left10" alt="" />
					
					<img src="images/home/2014/9.jpg" class="homegrid_image left10" alt="" />
					<img src="images/home/2014/10.jpg" class="homegrid_image left10 right10" alt="" />
					<img src="images/home/2014/11.jpg" class="homegrid_image left10 right10" alt="" />
					<img src="images/home/2014/12.jpg" class="homegrid_image left10" alt="" />
					
					<div class="clear"></div>
					
					<center>The Salt Spring Studio Tour invites  you to <br />"Meet the Artists and Experience the Creativity" of our <?=artistCount()?> working studios.</center>
				<!--grid--></div>
			<!--homegrid--></div>
		
		
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