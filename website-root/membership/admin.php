<?php
require_once('inc/connect.php');

if (!isset($_SESSION['admin'])) {
	header("location: .");
}
 
 
if (isset($_POST['submit'])) {

	$studio_name = addslashes($_POST['studio_name']);

	$sql = "insert into profiles (tour_number,studio_name,password) values ('$_POST[studio_number]','$studio_name','$_POST[password]')";
	$result = mysql_query($sql) or die(mysql_error());
	header("location: admin.php");
}


$sql = "select * from profiles order by tour_number";
$result = mysql_query($sql);



$sql = "select * from profiles order by tour_number";
$tour_number = mysql_query($sql);
while ($val = mysql_fetch_assoc($tour_number)) {
		$available[] = $val['tour_number'];
}

?>
<!doctype html>
<html lang="en">
<head>

<meta name="AUTHOR" content="Balazs Bagi" />
<meta charset="utf-8" />
<?php require_once("inc/meta.php"); ?>

<title>Studio Tour Management :: ADMINISTRATION</title>

<link rel="stylesheet" type="text/css" href="css/dimensions.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/styles.css" />


<script src="js/modernizr.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jeditable.js"></script>


<script type="text/javascript">
/* <![CDATA[ */


function checkform() {
	var studio_name = $("#studio_name");
	var password = $("#password");

	if (studio_name.val() == '') {
		studio_name.focus();
		return false;
	}
	
	if (password.val() == '') {
		password.focus();
		return false;
	}

	return true;
}


$(function() {


		$('.editable').editable('save2.php', {
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
		$('a[href=#pane2]').click();

	<?php } ?>



});



/*]]>*/
</script>



</head>
<body id="body_manage">
<div id="container">

	<h2 class="mb0">Salt Spring Studio Tour Membership Administration</h2>


<p>This tool will allow you to manage the Studio Tour membership accounts.  To edit on behalf of a member, click on the "login" button in their row.</p>


<br />
<br />
			


	







<div class="tabbable">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#pane1" data-toggle="tab">Members List</a></li>
    <li><a href="#pane2" data-toggle="tab">Add New Member</a></li>

  </ul>
  <a class="floatRight" style="color: #900; font-weight: bold; position: relative; top: -45px"href="./?logout_admin">Log out</a>
  <div class="cb" style="margin-bottom: -20px"></div>



  <div class="tab-content">
    <div id="pane1" class="tab-pane active">
    
    
    Click on a studio name or password to edit.  Click on the "Login" button to automatically login to that member's profile for editing.<br /><br />
    
    <table class="tiger" width="100%" cellspacing='2' cellpadding='2'> 
    
    	<tr>
			<td width="30">#</td>
			<td width="400">Studio Name</td>
			<td width="350">Password</td>
			<td width="150">Login as User</td>
		</tr>
    
    <?php while ($record = mysql_fetch_assoc($result)) { $record = (object) $record; ?>
    
		<tr>
			<td width="30" class="editable" id="tour_number-<?=$record->id?>"><?=$record->tour_number?></td>
			<td width="400" class="editable" id="studio_name-<?=$record->id?>"><?=$record->studio_name?></td>
			<td width="300" class="editable" id="password-<?=$record->id?>"><?=$record->password?></td>
			<td width="150" valign="middle"><form action="index.php" method="post" target="_blank"><input type="hidden" name="profile" value="<?=$record->id?>"><input type="hidden" name="password" value="<?=$record->password?>"><input type="submit" value="Login" style="position: relative; top: 9px"/></form></td>
		</tr>
    
    <?php } ?>
     
    </table>
<!--pane--></div>






</form>


    <div id="pane2" class="tab-pane">
      <h4>Add New Member</h4>
      <form action="admin.php" method="post" onsubmit="return checkform()">
      <div class="control-group">
      <label class="control-label" for="studio_number">Studio Tour #</label>
      <div class="controls">
      	<select name="studio_number" id="studio_number">
      <?php for ($i = 1; $i< 50; $i++) {
											if (!in_array($i,$available)) { ?>
											
											<option <?php if (@$_REQUEST['tour_number'] == $i) { echo "selected='selected'";} ?> value="<?=$i?>"><?=$i?></option>
											
											<?php } else { ?>
											<option  value="" disabled ='disabled'><?=$i?> (unavailable)</option>
											<?php }
										} ?>

    
      	</select>
      </div>
      </div>
      
      
      
      
      
      
    <div class="control-group">
	<label class="control-label" for="studio_name">Studio Name</label> 
		<div class="controls">
			<input type="text" name="studio_name" id="studio_name" class="w400" value=""/>
	    </div>
    </div>
    
    
     <div class="control-group">
	<label class="control-label" for="password">Password</label> 
		<div class="controls">
			<input type="text" name="password" id="password" class="w400" value=""/>
	    </div>
    </div>

 <div class="control-group">
	<label class="control-label" for="studio_name"></label> 
		<div class="controls">
			<input type="submit" value="Add Member" name="submit" class="btn"/></div>
    </div>

      </form>



	  <!--pane2--></div>


  </div><!-- /.tab-content -->
</div><!-- /.tabbable -->

	

<hr />


	
<br />
<br />
<br />
<br />
<br />
<br />


<!--container--></div>

</body>
</html>