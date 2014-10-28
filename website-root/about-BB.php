<?php require_once("inc/inc.php");

$sql = "SELECT * FROM artists ORDER BY RAND() limit 1";
$result = mysql_query($sql) or die(mysql_error());
$artist = mysql_fetch_object($result);

$sql = "SELECT * FROM artists where id != $artist->id ORDER BY RAND() limit 1";
$result = mysql_query($sql) or die(mysql_error());
$artist2 = mysql_fetch_object($result);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Language" content="en" />
<meta name="AUTHOR" content="Balazs Bagi" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php require_once("inc/meta.php"); ?>

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
	
	
		
		<div id="content_780">
		<br />
<p>
<a href="view.php?artist=<?=$artist->id?>"><img src="artists/<?=$artist->grid_photo?>" alt="Sunset" class="about_left border" width="250"/></a>If you want to taste all Salt Spring has to offer, nothing compares to the mix of art and creativity you can enjoy on the island's famous Studio Tour.
</p><p>
On our tour you can watch an artist paint, attend a wine tasting, try on some jewellery and still have time to pick up a one of a kind sculpture on your way home. With <?=artistCount()?> studios to discover on the year-round self-guided tour, all that you require is a current studio tour map and a bit of spare time to enjoy the studios of your choice. Some of the studios offer a unique experience such as a workshop tour or a demonstration on creating a work of art. Our Studio Tour's diverse selection also includes baked goods, wine and cheese shops that will keep the foodies nibbling the day away.
</p><p>
<a href="view.php?artist=<?=$artist2->id?>"><img src="artists/<?=$artist2->grid_photo?>" alt="Sunset" class="about_right border" width="250"/></a>Artists may be present to answer questions about their work and help you understand the creative process and the Salt Spring way of life. 
</p><p> 
Our colourful map outlines what each artist creates and the location of their studio. Our free maps are available at B.C tourism information centers, on ferries serving the island, in marinas, hotels and B&amp;Bs.
</p><p> 
The map can also be <a href="pdf/StudioTour2014.pdf" target="_blank">downloaded here (2.4MB PDF)</a>.
</p><p>
<img src="images/sheepsign.jpg" alt="Sheep Sign" class="about_left"/>How do you know if you are at one of our studios?<br />Look for our trademark black sheep sign pointing the way to a unique experience.
 </p><p style="clear: both;">
<img src="images/artbook.jpg" alt="Artisan Book" class="about_right" height="225" width="150" />As a result of the overwhelming success of our first book of Artisan Profiles published and launched in April of 2009, we have created a new updated version for <?=date('Y')?>. Our book provides you with further information on the artists, accompanied by many beautiful new images that capture the studio tour experience. 
 </p><p>
Please contact us at  <a href="mailto:saltspringstudiotour@gmail.com">saltspringstudiotour@gmail.com</a>  for more information on the book.
</p><p>
Welcome to our island.
</p><p>

   -  The Studio Tour Group of Saltspring Island
		</p>
			
	<p style="width:500px; margin-top:50px"><img src="images/guidedtour.jpg" alt="Guided Tour" class="about_left" /><br/> "No Car? No problem! See all of the highlights with a local guide.  Western Splendor Tour Company offers driving tours to all studios and the best Salt Spring Island attractions. <a href="http://www.toursaltspring.com/" target="_blank">www.toursaltspring.com</a>"</p><p style="clear:both"></p>

		
		
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