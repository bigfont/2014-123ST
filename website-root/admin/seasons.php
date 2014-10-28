<?php require_once('../inc/inc.php'); 
admin_only();

if (isset($_POST['submit'])) {

	$sql = "update seasons set default_season = '$_POST[season_default]', off_hours = '$_POST[off_hours_text]', shoulder_hours = '$_POST[shoulder_hours_text]', peak_hours = '$_POST[peak_hours_text]' where id='1'";
	$result = mysql_query($sql) or die(mysql_error());
	$message = "Seasons Successfully Updated"; 
	
	
}




$sql = "select * from seasons";
$result = mysql_query($sql);
$seasons = mysql_fetch_object($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en" />
<meta name="AUTHOR" content="Balazs Bagi" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<title>Saltspring Studio Tour Administration</title>

<link rel="stylesheet" type="text/css" href="css/styles.css" />

</head>
<body>

	<div id="container">
	<div id="loader" style="display: none;">Working...</div>
	<?php require_once('menu.php'); ?>
	
		<div id="content" >
		<h4 class="message"><?php if (isset($message)) { echo $message; } ?></h4>
		
			
		<h3>Seasons</h3>
		<p>Select which season we are currently in by clicking the radio button.  That season will show by default on the artist view page drop downs.<br />The drop-down text is the descriptive text that shows up in the drop down box letting visitors know when each season is in effect, capiche?</p>
		<br />
		<form action="" method="post" >
		<table>
			<tr>
				<td colspan="2" style="border-bottom: 1px solid #999;">Default</td>
				<td style="border-bottom: 1px solid #999;">Drop-down text</td>
			</tr>
			<tr>
				<td><input name="season_default" id="off_hours" value="off_hours" type="radio" <?php if ($seasons->default_season == 'off_hours') echo "checked='checked'"; ?> /></td>
				<td width="200"><strong>Fall / Winter</strong></td>
				<td><input type="text" size="100" name="off_hours_text" value="<?=$seasons->off_hours?>" /></td>
			</tr>
			<!--
			<tr>
				<td><input name="season_default" id="shoulder_hours" value="shoulder_hours" type="radio" <?php if ($seasons->default_season == 'shoulder_hours') echo "checked='checked'"; ?> /></td>
				<td><strong>Shoulder Season</strong></td>
				<td><input type="text" size="100"  name="shoulder_hours_text" value="<?=$seasons->shoulder_hours?>" /></td>
			</tr>
			-->
			
			<tr>
				<td><input name="season_default" id="off_hours" value="peak_hours" type="radio" <?php if ($seasons->default_season == 'peak_hours') echo "checked='checked'"; ?> /></td>
				<td><strong>Spring / Summer</strong></td>
				<td><input type="text" size="100"  name="peak_hours_text" value="<?=$seasons->peak_hours?>" /></td>
			</tr>
			<tr>
				<td colspan="3" style="border-top: 1px solid #999;"><br /><input type="submit" name="submit" value="Update Seasons..." /></td>
			</tr>
		</table>

	</form>
		
		<!--content--></div>
	
	<!--container--></div>

</body>
</html>

<!-- ABQIAAAAijTB_o7cWtS_p9ChwZLkOhRv-2Rol7HF38vv1CWfBs9JUd4zlRQ6HWIm7GljZO_m71x1qO0QvbHSsQ -->