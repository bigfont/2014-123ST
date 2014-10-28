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
<a href="view.php?artist=<?=$artist->id?>"><img src="artists/<?=$artist->grid_photo?>" alt="Sunset" class="about_left border" width="250"/></a>If you'd like to taste the very best of what Salt Spring has to offer, nothing compares to the mix of creativity, hand-made art and world-class craftsmanship that you can enjoy on the island's famous <strong>Studio Tour</strong>.
</p>
<p>
The year-round <strong>Studio Tour</strong> makes it possible for you to watch artists while they work, following their passion. You can try on some unique jewellery, attend a wine tasting, or watch art come to life! You can watch an artisan hand-weave a functional placemat or a beautiful scarf..., and even try weaving yourself!</p>

<p> Depending on your schedule, enjoy as many unique artisans as you choose, and you can <em>still </em>have enough time before the ferry to pick up a one-of-a-kind piece for yourself! Many studios produce perfect gifts for weddings, anniversaries, birthdays, or..., that perfect piece for the very special people in your life! </p>

<p>Speaking of anniversaries, 2015 marks the <em><strong>25th Anniversary </strong></em>of the Salt Spring Studo Tour! Some of the studios are celebrating the occassion with unique editions and special pricing.

<p>With over 30 studios to discover on the year-round Tour, all you require to enjoy the studios of your choice is a current <strong>Studio Tour Map</strong> and a bit of spare time. Some  studios offer a one-of-a-kind experience, such as a workshop tour or a hands-on demonstration on creating a work of art. </p>

<p>Our Studio Tour's diverse selection also includes freshly-baked goods, sumptuous wines and perfectly-aged cheeses that you can enjoy while you see how they're made.
</p>
<p>
<a href="view.php?artist=<?=$artist2->id?>"><img src="artists/<?=$artist2->grid_photo?>" alt="Sunset" class="about_right border" width="250"/></a>Artists are usually present to answer questions about their work and to help you understand the creative process and the Salt Spring way of life. 
</p>
<p> 
Our colourful map outlines what each artist creates as well as the location of their studio. Our free maps are available at B.C tourism information centers,  in marinas, hotels and B&amp;Bs, on all three ferries serving the island.
</p><p> 
The map can also be <a href="pdf/StudioTour2014.pdf" target="_blank">downloaded here (2.4MB PDF)</a>.
</p>
<p>
<img src="images/sheepsign.jpg" img size="150%" alt="Sheep Sign" class="about_left"/>How do you know if you are at one of our studios? Just look for our trademark black sheep sign pointing the way to a unique experience.
 Numbers on the signs, map and in the Tour Book allow you find the studios that match your interests.</p>
<p style="clear: both;">
<img src="images/artbook.jpg" alt="Artisan Book" class="about_right" height="225" width="150" />As a result of the overwhelming success of our book of Artisan Profiles - first published in April of 2009 - we have created a new updated version each year. The book provides detailed information on each artist, with many beautiful new images that capture the Studio Tour experience. 
 </p>
<p>
Please contact us at  <a href="mailto:saltspringstudiotour@gmail.com">saltspringstudiotour@gmail.com</a>  for more information on the book &amp; map.
</p>
<p>
Thank you, and welcome to our island!</p><p>

   -  The Studio Tour Group of Saltspring Island		<img src="images/guidedtour.jpg" alt="Guided Tour" class="about_left" /><br/> "</p>
<p>No Car? No problem! See all of the highlights with a local guide.  Western Splendor Tour Company offers driving tours to all studios and the best Salt Spring Island attractions. <a href="http://www.toursaltspring.com/" target="_blank">www.toursaltspring.com</a>"</p>
<p style="clear:both"></p>

		
		
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