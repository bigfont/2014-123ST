<?php

require_once('inc/connect.php');

if (!isset($_SESSION['member']) && !isset($_SESSION['admin'])) {
	header("location: .");
}

$profile = getProfile($_SESSION['member']);
$error = false;

if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	$sql = "select * from images where id = '$id' and profiles_id = '$_SESSION[member]'";
	$result = mysql_query($sql);
	if (mysql_num_rows($result) > 0) {
		$rec = mysql_fetch_object($result);
		@unlink('media/' . $rec->image);
		$sql = "delete from images where id = '$rec->id'";
		mysql_query($sql);
	}
}

if (isset($_POST['image_caption'])) {

	if (isset($_FILES['image_upload']['tmp_name']) && $_FILES['image_upload']['error'] == 0) {
	
	    $imageData = @getimagesize($_FILES["image_upload"]["tmp_name"]);
	    
	    if ($imageData[0] < 1000 && $imageData[1] < 1000) {
		    //Image is too small
		    $error = "toosmall";	 
	    }
	    
	    if ($imageData[2] != 2) {
		    //Wrong type
		    $error = "notjpeg";
	    }
	    
	    if (!$error) {
	    
			$filename = time() . ".jpg";
			move_uploaded_file($_FILES['image_upload']['tmp_name'],'media/'.$filename);
			$caption = addslashes($_POST['image_caption']);
			$sql = "insert into images (profiles_id,image,caption) values ('$_SESSION[member]','$filename','$caption')";
			$result = mysql_query($sql) or die(mysql_error());
			header("location:manage.php?tab=image&success=true");
		}
	}
}

$sql = "select * from images where profiles_id = '$_SESSION[member]'";
$result = mysql_query($sql);

?>

<!doctype html>
<html lang="en">
<head>

	<meta name="AUTHOR" content="Balazs Bagi" />
	<meta charset="utf-8" />
	<?php require_once("inc/meta.php"); ?>
      
	<title>Studio Tour Management :: <?=$profile->studio_name?></title>

	<link rel="stylesheet" type="text/css" href="css/dimensions.css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/styles.css" />

	<script src="js/modernizr.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jeditable.js"></script>

	<script type="text/javascript">
	/* <![CDATA[ */
	var uploadLock = false;

	function checkForm() {
		
		if (uploadLock) { return true; }
		var image_upload = $("#image_upload");
		var image_caption = $("#image_caption");

		if (image_upload.val() == '') {
			alert('Please select a JPG image to upload');
			return false;
		}

		if (image_caption.val() == '') {
			alert('Please enter some instructions to go with this image');
			return false;
		}
		
		$(".loading").show();

		$("#uploadImage").hide();

		uploadLock = true;
		return true;
	}

	$(function() {
			
		$('.editable').editable('membership-manage-save.php', {
			type      : 'textarea',
			cancel    : 'Cancel',
			submit    : 'OK',
			cssclass: 'inplace',
			tooltip   : 'Click to edit...',
			data: function(value, settings) {
				  /* Convert <br> to newline. */
				  var retval = value.replace(/<br\s*\/?>\n?/gi, '\n');
				  return retval;
				}
			});

		$("table.tiger tr:even").addClass("alternate");
		$("table.tiger tr:first td").css({backgroundColor: '#333', color: '#fff', paddingBottom: '10px', paddingTop: '5px', borderBottom: '2px solid red'});

		<?php if (isset($_GET['tab'])) { ?>
			$('a[href=#pane4]').click();
			$('.btn').hide();
		<?php } ?>

		$('.btn').click(function() {

			$('.checkmark').fadeIn(function() {
				setTimeout(function() {
					$(".checkmark").fadeOut();
				}, 2000);
			});
			
			var stream = $('.form').serialize();
			
			$.post('ajax_save.php',{data:stream},function(d) {
				console.log(d);
			});
		});

		$('.nav-tabs a').on('shown', function (e) {
			
			$(".checkmark").hide();
			if (e.target.hash == '#pane4' || e.target.hash == '#pane5') {
				$('.btn').hide();
			} else {
				$('.btn').show();
			}
		});
	});

	/*]]>*/
	</script>

</head>
<body id="body_manage">
	<div id="container">

		<h2 class="mb0">Salt Spring Studio Tour Registration</h2>
		<p>Registration is open until <strong>October 30th, 2014</strong>.  You are free to make changes to your profile as many times as you like until then, at no extra cost.  You will be given an opportunity to review your profile before it is printed, but after <strong>October 30th, 2014</strong>, any changes will incur an additional fee.</p>
		
		<div class="tabbable">
		
			<ul class="nav nav-tabs">
				<li class="active"><a href="#pane1" data-toggle="tab">Map Details</a></li>
				<li><a href="#pane2" data-toggle="tab">Book Details</a></li>
				<li><a href="#pane3" data-toggle="tab">Categories</a></li>
				<li><a href="#pane4" data-toggle="tab">Images</a></li>
				<li><a href="#pane5" data-toggle="tab">Documents</a></li>
			</ul>
		
			<a class="floatRight" style="color: #900; font-weight: bold; position: relative; top: -45px"href="./?logout">Log out</a>
			
			<div class="cb" style="margin-bottom: -20px"></div>	
			
			<div class="tab-content">				
		
				<form id="pane1" class="tab-pane active form">
				
					<h4><u>Choosing the Templates and entering text for your Studio Tour Map</u></h4>
					<p>These are the details required for the Studio Map, on both the Information side, and on the Map side.<br />An example of the map and info sides are shown below: </p><br />
					<img src="images/infosample.jpg" width="50%" height="50%"/>
					<img src="images/mapsample.jpg" />
					<p>Note that space is extremely limited on the Tour Map. Be concise.</p>
					<hr />
			
		<!-- Update the Profile START -->    
					<div class="control-group">
						<div class="controls"> 
							<button type="button" class="btn">Update My Profile</button> <img src="images/checkmark.gif" class="checkmark" />
						</div>
					</div>
		<!-- Update My Profile END -->

					<h3><?=$profile->tour_number?> - <?=$profile->studio_name?></h3>

					<div class="control-group">
						<label class="control-label" for="contact_name">Contact Name</label> 
						<div class="controls">
							<input type="text" name="contact_name" id="contact_name" class="w300" value="<?=$profile->contact_name?>"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="studio_address">Studio Address</label> 
						<div class="controls">
							<input type="text" name="studio_address" id="studio_address" class="w400" value="<?=$profile->studio_address?>"/>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="website">Website</label> 
						<div class="controls">
							<input type="text" name="website" id="website" class="w400" maxlength="100" value="<?=$profile->website?>"/> 
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="email">Email</label> 
						<div class="controls">
							<input type="text" name="email" id="email" class="w300" maxlength="100" value="<?=$profile->email?>"/> 
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="phone">Telephone</label> 		
						<div class="controls">
							<input type="text" name="phone" id="phone" class="w160" maxlength="100" value="<?=$profile->phone?>"/> 
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="info_description">Info Side Description (100 Characters MAX)<small><strong>This is the description that will show up on the information side of the map.</strong></small></label> 
						<div class="controls">
							<input type="text" name="info_description"  id="info_description" class="w610" maxlength="100" value="<?=$profile->info_description?>"/> 
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="map_description">Map Side Description (54 Characters MAX)<small><strong>This is the description that will show up on the map side of the map.</strong></small></label> 
						<div class="controls">
							<input type="text" name="map_description" id="map_description" class="w400" maxlength="54" value="<?=$profile->map_description?>"/> 
						</div>
					</div>
			   
					<div class="control-group">
						<label class="control-label" for="summer_hours">MAIN SEASON (May 1st - Sept 30th) <small><strong>Enter your Days &amp; Hours - ie: Mon-Fri: 10-5 &amp; Sun: 11-4</strong></small></label> 
						<div class="controls">
							<input type="text" id="summer_hours" name="summer_hours" class="w400" maxlength="54" value="<?=$profile->summer_hours?>"/> 
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="winter_hours">OFF SEASON (Oct 1st - Apr 30th) <small><strong>Enter your Days &amp; Hours - ie: Thu, Fri, Sun: 10-4 &amp;, or By Appointment</strong></small></label> 
						<div class="controls">
							<input type="text" id="winter_hours" name="winter_hours" class="w400" maxlength="54" value="<?=$profile->winter_hours?>"/> 
						</div>
					</div>

			<!-- New Comment field -->
					<div class="control-group">
						<label class="control-label" for="season_comment">Special Open Days - <em><font size="-1">(Note: We can't promise that there will be enough room on the Map, but we will make every effort to promote your extra days in the Studio Tour Book and Website.)</font><br>
						<font size="-2"> In addition to the above Dates and Times, enter any Special dates and times that you wish to open your Studio (:ie: "<strong>Mon, Tue &amp; Wed before Christmas"</strong>, or "<strong>Thanksgiving - all day</strong>", or "<strong> Thur &amp; Fri before Hallowe'en</strong>".) </br></font></em></label> 
						<div class="controls">
							<input type="text" id="season_comment" name="season_comment" class="w400" maxlength="54" value="<?=$profile->season_comment?>"/>	 
						</div>
					</div>

			<!-- New Anniversary Comment field -->
					<div class="control-group">
						<label class="control-label" for="C">I plan to promote the Studio Tour's 25th Anniversary with the following:
							<small><strong>(ie: "Special Edition(s), Anniversary Pricing, etc.) </strong></small>
						</label> 
						<div class="controls">
							<input type="text" id="anniversary_comment" name="anniversary_comment" class="w400" maxlength="54" value="<?=$profile->anniversary_comment?>"/> 
						</div>
					</div>                   

			<!-- New BATAH Comment field -->
					<div class="control-group">
						<label class="control-label" for="C">I plan to the following items to the "Be A Tourist At Home" prgram, to entice local residents to visit my studio::
							<small><strong>(ie: "<strong>$25 Gift Certificate</strong>", "<strong>One (1) Table Runner</strong>", "<strong>Five Cedar Cutting Boards</strong>", "<strong>One (1) piece of unique Jewelry</strong>", etc.) </strong></small>
						</label> 
						<div class="controls">
							<input type="text" id="batah_comment" name="batah_comment" class="w400" maxlength="54" value="<?=$profile->batah_comment?>"/> 
						</div>
					</div>  

					<hr />
					
					<div class="control-group">
						<h4>Options:</h4>
						<div class="controls">
							<input id="saturday_market" name="saturday_market" class="css-checkbox" type="checkbox" <?php if ($profile->saturday_market == 'y') { ?> checked='checked' <?php } ?>/>
							<label for="saturday_market" name="demo_lbl_1" class="css-label" >I participate in the Saturday Market</label>
							<br />
							<input id="wheelchair" name="wheelchair" class="css-checkbox" type="checkbox" <?php if ($profile->wheelchair == 'y') { ?> checked='checked' <?php } ?>/>
							<label for="wheelchair" name="demo_lbl_1" class="css-label" >My studio is wheelchair accessible</label>
							<br>
							<input id="check_demo" name="check_demo" class="css-checkbox" type="checkbox" <?php if ($profile->check_demo == 'y') { ?> checked='checked' <?php } ?>/>
							<label for="check_demo" name="demo_lbl_1" class="css-label" >I give Studio visitors short demonstrations of my technique.</label>
							<br>
							<input id="check_try" name="check_try" class="css-checkbox" type="checkbox" <?php if ($profile->check_try == 'y') { ?> checked='checked' <?php } ?>/>
							<label for="check_try" name="demo_lbl_1" class="css-label" >I let Studio visitors try their hand at at my craft (ie: weaving, painting, etc.)</label>
							<br />
							<br />                
							<input id="visa" name="visa" class="css-checkbox" type="checkbox" <?php if ($profile->visa == 'y') { ?> checked='checked' <?php } ?>/>
							<label for="visa" name="demo_lbl_1" class="css-label" >I accept VISA</label>		
							<br />
							<input id="mastercard" name="mastercard" class="css-checkbox" type="checkbox" <?php if ($profile->mastercard == 'y') { ?> checked='checked' <?php } ?>/>
							<label for="mastercard" name="demo_lbl_1" class="css-label" >I accept Mastercard</label>
							<br />
							<input id="amex" name="amex" class="css-checkbox" type="checkbox" <?php if ($profile->amex == 'y') { ?> checked='checked' <?php } ?>/>
							<label for="amex" name="demo_lbl_1" class="css-label" >I accept American Express</label>
							<br />
							<input id="interac" name="interac" class="css-checkbox" type="checkbox" <?php if ($profile->interac == 'y') { ?> checked='checked' <?php } ?>/>
							<label for="interac" name="demo_lbl_1" class="css-label" >I accept INTERAC (Debit)</label>           	
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="suggestion">The Steering Committe welcomes suggestions from the Members - let us know your how <em>you</em> think that the Map, the Book, or the Website can be improved. Thanks!<br>Please enter your suggestions for improved media.</br></label> 
						<div class="controls">
							<textarea id="suggestion" name="suggestion" class="w500 h100"><?=($profile->suggestion)?></textarea>
						</div>
					</div>

				</form>

				<form id="pane2" class="tab-pane form">
		 
					<h4><u>Entering text for your Studio Tour Book pages</u></h4>
					<p>TEMPLATES</p>
				
					<p><a href="files/BookRightTemplate.pdf" target="_blank">Book - Right Page Template (PDF)</a></p>
					<p><a href="files/BookLeftPageWholeTemplate.pdf" target="_blank">Book - Left Page (whole page) Template (PDF)</a></p>
					<p><a href="files/BookLeftPageBottomHalfTemplate.pdf" target="_blank">Book - Left Page (bottom half) Template (PDF)</a></p>
					<p><strong>NOTE: Depending on your internet speed, Templates may take a while to load. </strong></p>
					<p>Returning Members: If you'd prefer to leave the Template fields emprty, we'll just use the templates from your pages in last year's Book.</p>
					<br>
					<p>Please select the correct template (ie: "1", "5", etc.), for both left and right pages of your book entry, then enter the text for each page in the appropriate fields. Images can be uploaded in the "Images" tab (above.)</p>
					<hr />
				
					<!-- Update the Profile START -->    
					<div class="control-group">
						<div class="controls"> 
							<button type="button" class="btn">Update My Profile</button> <img src="images/checkmark.gif" class="checkmark" />
						</div>
					</div>
					<br>
					<!-- Update My Profile END -->

					<div class="control-group">
						<h4>Book (Left Page)</h4>
						<label class="control-label" for="bookleft_template">Left Page Template Number <small><strong>Please enter which template number you'd like for the left page of your book entry.</strong></small></label> 
						<div class="controls">
							<input type="text" name="bookleft_template" id="bookleft_template" class="w40" maxlength="1" value="<?=$profile->bookleft_template?>"/> 
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="bookleft_1">Left Page Copy<small><strong>This is the copy for the left page of your book entry.</strong></small></label> 
						<div class="controls">
							<textarea id="bookleft_1" name="bookleft_1" class="w500 h100"><?=($profile->bookleft_1)?></textarea>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="bookleft_2">Left Page <strong><em>Optional</em></strong> Copy<small><strong>This is optional copy for the left page of your book entry, if your chosen template requires it.</strong></small></label> 
						<div class="controls">
							<textarea id="bookleft_2" name="bookleft_2" class="w500 h100"><?=($profile->bookleft_2)?></textarea>
						</div>
					</div>
				
					<hr />

					<div class="control-group"><h4>Book (Right Page)</h4>
						<label class="control-label" for="bookright_template">Right Page Template Number <small><strong>Please enter which template number you'd like for the right page of your book entry.</strong></small></label> 
						<div class="controls">
							<input type="text" name="bookright_template" id="bookright_template" class="w40" maxlength="1" value="<?=$profile->bookright_template?>"/> 
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="bookright_1">Right Page Copy<small><strong>This is the copy for the right page of your book entry.</strong></small></label> 
						<div class="controls">
							<textarea id="bookright_1" name="bookright_1" class="w500 h100"><?=($profile->bookright_1)?></textarea>
						</div>
					</div>
				
					<div class="control-group">
						<label class="control-label" for="bookright_2">Right Page <strong><em>Optional</em></strong> Copy<small><strong>This is optional copy for the right page of your book entry, if your chosen template requires it.</strong></small></label> 
						<div class="controls">
							<textarea id="bookright_2" name="bookright_2" class="w500 h100"><?=($profile->bookright_2)?></textarea>
						</div>
					</div>
				
				<!--pane-->
				</form>

				<form id="pane3" class="tab-pane form">
			
					<!-- Update the Profile START -->    
					<div class="control-group">
						<div class="controls"> 
							<button type="button" class="btn">Update My Profile</button> <img src="images/checkmark.gif" class="checkmark" />
						</div>
					</div>
					<br>
					<!-- Update My Profile END -->

					<h4><u>Choosing the Categories that relate to your Studio</u></h4>
					<p>Please indicate the the categories which most closely apply to your products or studio:</p>

					<div class="control-group">
						<div class="controls">
							<table width="800" cellpadding="10">
								<tr>
									<td>
										<input id="cat_basketry" name="cat_basketry" class="css-checkbox" type="checkbox" <?php if ($profile->cat_basketry == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_basketry" name="" class="css-label" >Basketry</label>
									</td>					
									<td>
										<input id="cat_fibre" name="cat_fibre" class="css-checkbox" type="checkbox" <?php if ($profile->cat_fibre == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_fibre" name="" class="css-label" >Fiber / Wool</label>
									</td>
									<td>
										<input id="cat_glass" name="cat_glass" class="css-checkbox" type="checkbox" <?php if ($profile->cat_glass == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_glass" name="" class="css-label" >Glass</label>
									</td>
									<td>
										<input id="cat_pottery" name="cat_pottery" class="css-checkbox" type="checkbox" <?php if ($profile->cat_pottery == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_pottery" name="" class="css-label" >Pottery</label>
									</td>
								</tr>	
								<tr>	
									<td>
										<input id="cat_sculpture" name="cat_sculpture" class="css-checkbox" type="checkbox" <?php if ($profile->cat_sculpture == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_sculpture" name="" class="css-label" >Sculpture</label>
									</td>
									<td>
										<input id="cat_candles" name="cat_candles" class="css-checkbox" type="checkbox" <?php if ($profile->cat_candles == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_candles" name="" class="css-label" >Candles</label>
									</td>
									<td>
										<input id="cat_food" name="cat_food" class="css-checkbox" type="checkbox" <?php if ($profile->cat_food == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_food" name="" class="css-label" >Food</label>
									</td>
									<td>
										<input id="cat_herbalfloral" name="cat_herbalfloral" class="css-checkbox" type="checkbox" <?php if ($profile->cat_herbalfloral == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_herbalfloral" name="" class="css-label" >Herbal / Floral</label>
									</td>
								</tr>
								<tr>
									<td>
										<input id="cat_photography" name="cat_photography" class="css-checkbox" type="checkbox" <?php if ($profile->cat_photography == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_photography" name="" class="css-label" >Photography</label>
									</td>
									<td>
										<input id="cat_textiles" name="cat_textiles" class="css-checkbox" type="checkbox" <?php if ($profile->cat_textiles == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_textiles" name="" class="css-label" >Textiles</label>
									</td>
									<td>
										<input id="cat_clothing" name="cat_clothing" class="css-checkbox" type="checkbox" <?php if ($profile->cat_clothing == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_clothing" name="" class="css-label" >Clothing</label>
									</td>
									<td>
										<input id="cat_jewellery" name="cat_jewellery" class="css-checkbox" type="checkbox" <?php if ($profile->cat_jewellery == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_jewellery" name="" class="css-label" >Jewellery</label>
									</td>
								</tr>
								<tr>
									<td>
										<input id="cat_quilts" name="cat_quilts" class="css-checkbox" type="checkbox" <?php if ($profile->cat_quilts == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_quilts" name="" class="css-label" >Quilts</label>
									</td>
									<td>
										<input id="cat_weaving" name="cat_weaving" class="css-checkbox" type="checkbox" <?php if ($profile->cat_weaving == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_weaving"  name="" class="css-label" >Weaving</label>
									</td>
									
									<td>
										<input id="cat_beerwine" name="cat_beerwine" class="css-checkbox" type="checkbox" <?php if ($profile->cat_beerwine == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_beerwine"  name="" class="css-label" >Beer / Wine</label>
									</td>
									
									<td>
										<input id="cat_furniture" name="cat_furniture" class="css-checkbox" type="checkbox" <?php if ($profile->cat_furniture == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_furniture"  name="" class="css-label" >Furniture</label>
									</td>
								</tr>
								<tr>	
									<td>
										<input id="cat_paintingprint" name="cat_paintingprint" class="css-checkbox" type="checkbox" <?php if ($profile->cat_paintingprint == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_paintingprint"  name="" class="css-label" >Paintings / Prints</label>
									</td>
									<td>
										<input id="cat_toys" name="cat_toys" class="css-checkbox" type="checkbox" <?php if ($profile->cat_toys == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_toys"  name="" class="css-label" >Toys</label>
									</td>
									<td>
										<input id="cat_wood" name="cat_wood" class="css-checkbox" type="checkbox" <?php if ($profile->cat_wood == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_wood"  name="" class="css-label" >Wood</label>
									</td>
									<td>
										<input id="cat_metal" name="cat_metal" class="css-checkbox" type="checkbox" <?php if ($profile->cat_metal == 'y') { ?> checked='checked' <?php } ?>/>
										<label for="cat_metal"  name="" class="css-label" >Metal</label>
									</td>
								</tr>
							</table>								
							
							<br />
							<br />
							<br />
							 
							<div class="control-group">
								<label class="control-label" for="road_signs">How many studio signs are needed?</label> 
								<div class="controls">
									<input type="text" id="road_signs" name="road_signs" class="w40" maxlength="2" value="<?=$profile->road_signs?>"/> 
								</div>
							</div>

						</div>   	 
					</div>
				</form>
				
				<form id="pane4" class="tab-pane" action="manage.php?tab=image" method="post" enctype="multipart/form-data" id="imageupload" onsubmit='return checkForm();'>				

					<h4>Images</h4>
					<p>Here you can upload various images to be used in your book and map listing.  All images must be JPG format and must be a minimum of 1000 pixels on the shortest side.  Maximum file size is 4MB</p>
					<p>For more information, click on the Documents tab and review the Book layout sample and the 2014 Book Instructions PDF.</p>
					
					<?php if (isset($_GET['success'])) { ?>
						<div class="success">Image successfully uploaded</div>
					<?php } ?>
					
					<?php if ($error == 'toosmall') { ?>
						<div class="error">The image you uploaded was too small.<br />Please try again with a JPG image that is at least 1000px wide and tall.</div>
					<?php } ?>
					
					<?php if ($error == 'notjpeg') { ?>
						<div class="error">The file you uploaded was not a valid JPG image.  Please try again with a JPG image.</div>
					<?php } ?>
			  	
					
						<table cellpadding=5>
							<tr>
								<td>Please select a JPG image to upload <small>Please upload a JPG image.  Minimum dimension is 1000 pixels on the shortest side.</small></td>
								<td><input type="file" name="image_upload" id="image_upload" /></td>
							</tr>
							
							<tr>
								<td>Image Instructions<small>Please let us know what this image is to be used for (artist image, book image, etc...)</small></td>
								<td><input type="text" name="image_caption" id="image_caption" value="<?=@$_POST['image_caption']?>"/></td>
							</tr>
							
							<tr>
								<td>&nbsp;</td>
								<td>
									<input type="submit" name="submit" id="uploadImage" value="Upload Image" />&nbsp;&nbsp;
									<img src="images/loading.gif" class="loading" />
								</td>
							</tr>
						</table>
						<hr />

						<?php if (mysql_num_rows($result) > 0) { ?>
							<table cellpading="5" cellspacing="10" class='tiger' width="100%">
								<tr>
									<td width="200"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Image</strong></td>
									<td width="450"><strong>Instructions</strong> <span style="color: #f55">(click on an instruction below to edit)</span></td>
									<td>&nbsp;</td>
								</tr>
								
								<?php while ($record = mysql_fetch_assoc($result)) { $record = (object) $record; ?>
									<tr>
										<td><a href="media/<?=$record->image?>" target="_blank"><img src="media/_tim_thumb.php?src=<?=$record->image?>&amp;w=150&zc=1" alt="" style="border: 1px solid #333;"/></a></td>
										<td valign="top" align="left" class="editable" id="edit_<?=$record->id?>"><?=nl2br($record->caption)?></td>
										<td valign="top"><a href="?delete=<?=$record->id?>&tab=image" class="redLink" onClick="return confirm('Are you sure you want to delete this image?');">Delete Image</a></td>
									</tr>
								<?php } ?>
							</table>
						<?php } ?>

				</form>

				<div id="pane5" class="tab-pane">
				  
				  <h4>Documents</h4>
				  <hr />
				  <br />
				  <p><a href="files/2014-StudioTour-Agreement.pdf" target="_blank">2014 Studio Tour Agreement (PDF)</a></p>
				  <p><a href="files/BookInstructions2014.pdf" target="_blank">2014 Book Instructions (PDF)</a></p>
				  <p><a href="files/BookRightTemplate.pdf" target="_blank">Book - Right Page Template (PDF)</a></p>
				  <p><a href="files/BookLeftPageWholeTemplate.pdf" target="_blank">Book - Left Page (whole page) Template (PDF)</a></p>
				  <p><a href="files/BookLeftPageBottomHalfTemplate.pdf" target="_blank">Book - Left Page (bottom half) Template (PDF)</a></p>
				  <hr />
				  <p><a href="files/JuryingGuidelines.doc" target="_blank">Jurying Guidelines (WORD DOC)</a></p>
				  <p><a href="files/JuryingProcedures.doc" target="_blank">Jurying Procedures (WORD DOC)</a></p>
				  <p><a href="files/StudioTourPolicy.doc" target="_blank">Studio Tour Policy (WORD DOC)</a></p>
				
				</div>
			
			</div><!-- /.tab-content -->
		</div><!-- /.tabbable -->

		<div class="control-group">
			<div class="controls"> 
				<button type="button" class="btn">Update My Profile</button> <img src="images/checkmark.gif" class="checkmark" />
			</div>
		</div>			

	<!--container-->
	</div>

</body>
</html>