<?php require_once('inc/inc.php');
if (!isset($_GET['artist'])) {
	header("location: artists.php");
}


$artist_id = $_GET['artist'];
if (!is_numeric($artist_id)) {
	header("location: artists.php?notint");
}

$sql = "select * from artists where id = '$artist_id'";
$result = mysql_query($sql);

if (mysql_num_rows($result) < 1) {
	header("location: artists.php?notexist");
} else {
	$artist = mysql_fetch_object($result);
}

$sql = "select * from slideshow where artist_id = '$artist_id' order by view_order ASC limit 1";
$result = mysql_query($sql);
$poster = mysql_fetch_object($result);
$poster = $poster->image;

$sql = "select * from slideshow where artist_id = '$artist_id' order by view_order ASC";
$gallery = mysql_query($sql);

$sql = "select id from artists order by view_order ASC";
$result = mysql_query($sql);
$total_artists = mysql_num_rows($result);
while ($id = mysql_fetch_assoc($result)) {
	$artists[] = $id['id'];
}

$current_spot = array_search($artist_id,$artists);
if ($current_spot+1 < $total_artists) {
	$next = $artists[$current_spot + 1];
} else {
	$next = $artists[0];
}

if ($current_spot > 0) {
	$prev = $artists[$current_spot - 1];
} else {
	$prev = $artists[$total_artists-1];
}
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
<link rel="stylesheet" type="text/css" href="css/tipTip.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.tipTip.js"></script>
<script type="text/javascript">
	var Image = 1;
	var stripPos = 1;
	var stripCnt = 0;
	var stripScreens = 0;
	var w = 0;
	var h = 0;
	
$(function() {
	
		getScreenDimensions();
	
		$(".option_graphic").tipTip({
	
				delay: 00,
				fadeIn: 200,
				fadeOut: 200
		
		});		
		
		$("#artist_nav a").tipTip({
	
				delay: 00,
				fadeIn: 200,
				fadeOut: 200
		
		});	
	
		stripCnt = $('#filmstrip').children().size();
		stripScreens = Math.ceil(stripCnt / 4);
		
		
			$('.thumb').fadeTo(0,1).click(function() {
			$(".thumb").removeClass("glow").fadeTo(100,1);
			$(this).addClass("glow").fadeTo(100,1);
		});
		
		
		if (stripScreens < 2) {
			$("#right_arrow").hide();
		}
		$("#left_arrow").hide();
		
		$("#left_arrow").click( function() { slider("left");});
		$("#right_arrow").click( function() { slider("right");});		
	
		$("#filmstrip img:nth-child(1)").addClass("glow").fadeTo(100,1);
		
		//This is the functionality to make the portfolio navigatable with just the keyboard keys (left and right arrow keys)
		$(document).keyup(function(event){
			if (event.keyCode == 37) {
				goPrev();
    			}
    
		    if (event.keyCode == 39) {
		    	goNext()
    			}
		});
		
		
		
	
});

function poster(img) {
	newImage = "gallery/" + img;
	document.getElementById('posterImage').src = newImage;
}

function getScreenDimensions() {
	
	w = $(window).width();
	h = $(window).height();
		
}

function goNext() {
	showLoad();
	location.href='view.php?artist=<?=$next?>';
}

function goPrev() {
	showLoad();
	location.href="view.php?artist=<?=$prev?>";
}

function showLoad() {
	getScreenDimensions();
	
	offset_w = (w / 2) - 50;
	offset_h = (h / 2) - 30;
	$("#content").fadeTo(50,.2);
	$("#loader").css('left',offset_w + 'px').css('top',offset_h + 'px').show();
}


 function slider(where) {
	

	
	if(where == 'left') {  
               	 	 var left_indent = parseInt($('#filmstrip').css('left')) + 428;  
	             } else {  
                	 var left_indent = parseInt($('#filmstrip').css('left')) - 428;  
             }  
	
		$('#filmstrip:not(:animated)').animate({'left' : left_indent},300, 'swing',function() {
			
			if (where == 'right') {
				stripPos = stripPos + 1;
				if (stripPos > 0) {
					$("#left_arrow").show();
				}
				if (stripPos >= stripScreens) {
					//alert(stripPos+ " " + stripScreens);
					$("#right_arrow").hide();
				}
			} else {
				stripPos = stripPos - 1;
				if (stripPos < 2) {
					$("#left_arrow").hide();
				}
				if (stripPos < stripScreens) {
					$("#right_arrow").show();
				}
			}
			
			
		});
	
	
	
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
	
	
		<div id="content" style="width: 880px;  margin: 0 auto;">
			<div id="artist_nav">
						<a style="float: right; margin-left: 35px;" href="view.php?artist=<?=$next?>" onclick="return goNext();" title="Click to see next artist<br />or use right keyboard arrow key">Next >></a>
			<a style="float: right;" href="view.php?artist=<?=$prev?>"  onclick="return goNext();" title="Click to see previous artist<br />or use left keyboard arrow key"><< Prev</a>

			<div style="float: left;"><img src="images/sheep/<?=$artist->tour_number?>.png" alt="<?=$artist->tour_number?>" style="margin-bottom: -4px; margin-right: 10px;"/><h2 style="display: inline;"><?=stripslashes($artist->name)?></h2>
			
			
			
			</div>
			<!--artist_nav--></div>
			
		
			<div id="slideshow_wrap">
			
						<img src="gallery/<?=$poster?>" width="500" height="375" alt="" id="posterImage" />	
						
						<div id="filmstripContainer">
							<div id="filmstripWrap">
								<div id="filmstrip">
								<?php while ($record = mysql_fetch_assoc($gallery)) { ?>
									
									<img src="gallery/<?=$record['image']?>" class="thumb" width="95" onclick="poster('<?=$record['image']?>');"/>
								<?php } ?>
								<!--filmstrip--></div>
				<!--filmstripWrap--></div>
				<img src="images/rightarrow.jpg" id="right_arrow" />
				<img src="images/leftarrow.jpg" id="left_arrow" />
			<!--filmstripContainer--></div>
								
			
			<!--slideshow_wrap--></div>
			
			<div id="artist_details">
				
				 
				<img src="artists/<?=$artist->grid_thumb?>" style="float: right; margin: 0 0 5px 15px;" alt="<?=stripslashes($artist->name)?>" />			
				
				 <h3><?=stripslashes($artist->artist);?></h3> <?=br2p(stripslashes($artist->copy))?>
				 <div style="clear: both"></div>
				 <div class="contact_details">
				 
				 <table width="100%" class="contact_info">
				 	<tr><td width="100" valign="top"><strong>Address:</strong></td><td><a href="http://maps.google.com/?q=<?=$artist->lat?>,<?=$artist->lng?>" target="_blank"> <?=stripslashes($artist->address);?></a> <img src="images/ext_link_red.png" alt="Open Google Maps in a new window" /><br />Salt Spring Island, B.C. <?=$artist->postal_code?></td></tr>
				 	<tr><td><strong>Telephone:</strong></td><td><?=$artist->phone?></td></tr>
				 	
				 	<?php if ($artist->website != '') { ?>
					 	<tr><td><strong>Website:</strong></td><td><a href="http://<?=$artist->website?>" target="_blank" onclick="javascript: pageTracker._trackPageview('<?=str_replace("'","",$artist->name)?>');"><?=ShortenText($artist->website,30)?></a> <img src="images/ext_link_red.png" alt="Open website in a new window" /></td></tr>
				 	<?php } ?>
				 	
				 	<?php if ($artist->email != '') { ?>
					 	<tr><td><strong>Email:</strong></td><td><a href="mailto:<?=$artist->email?>"><?=ShortenText($artist->email,32)?></a></td></tr>
				 	<?php } ?>
				 	
				 	<tr><td valign="top"><strong>Hours:</strong></td><td>
								<table width="100%" cellpadding="0" cellspacing="0" id="hours">
								<tr <?php if (date('D',time()) == "Sun") echo "class='today'"; ?>><td>Sunday:</td><td align="right"> <?=$artist->hours_sun?></td></tr>
								<tr <?php if (date('D',time()) == "Mon") echo "class='today'"; ?>><td>Monday:</td><td align="right"> <?=$artist->hours_mon?></td></tr>
								<tr <?php if (date('D',time()) == "Tue") echo "class='today'"; ?>><td>Tuesday:</td><td align="right"> <?=$artist->hours_tue?></td></tr>
								<tr <?php if (date('D',time()) == "Wed") echo "class='today'"; ?>><td>Wednesday:</td><td align="right"> <?=$artist->hours_wed?></td></tr>
								<tr <?php if (date('D',time()) == "Thu") echo "class='today'"; ?>><td>Thursday:</td><td align="right"> <?=$artist->hours_thu?></td></tr>
								<tr <?php if (date('D',time()) == "Fri") echo "class='today'"; ?>><td>Friday:</td><td align="right"> <?=$artist->hours_fri?></td></tr>
								<tr <?php if (date('D',time()) == "Sat") echo "class='today'"; ?>><td>Saturday:</td><td align="right"> <?=$artist->hours_sat?></td></tr>
								</table>
							</td>
				 	</tr>
				 													
				 		
				 
				 </table>	
				 
				 
				 <!--contact_details--></div>
				 <div class="options">
				 <?php if ($artist->opt_debit == 'y') { ?><img src="images/debit.gif" class="option_graphic" alt="We Accept Debit Cards" title="We Accept Debit Cards" /><?php } ?>
			<?php if ($artist->opt_visa == 'y') { ?><img src="images/visa.gif" class="option_graphic" alt="We Accept VISA" title="We Accept VISA" /><?php } ?>
			<?php if ($artist->opt_mc == 'y') { ?><img src="images/mastercard.gif" class="option_graphic" alt="We Accept Mastercard" title="We Accept Mastercard" /><?php } ?>
			<?php if ($artist->opt_wheelchair == 'y') { ?><img src="images/wheelchair.gif" id="wheelchair" class="option_graphic" alt="Wheelchair Accessible" title="Wheelchair Accessible" /><?php } ?>
			<?php if ($artist->opt_bathroom == 'y') { ?><img src="images/bathroom.gif" class="option_graphic" alt="Restroom Available" title="Restroom Available" /><?php } ?>
			
				 
				 <!--options--></div>
		
			<!--artist_details--></div>
			
		<div style="clear: both;"?></div>
		<!--content--></div>
		
	
	<!--container--></div>
<!--wrap--></div>

<div id="footer_wrap">
	<div id="footer">
		<?php require_once("inc/footer.php"); ?>
	<!--footer --></div>
<!--footer_wrap--></div>

<?php require_once("inc/analytics.php"); ?>

<div id="loader">

<br /><h2>Loading...</h2>
<!--loader--></div>
</body>
</html>