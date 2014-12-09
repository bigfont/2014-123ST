<?php

require_once('../inc/inc.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/passwords.php');

if (admin_logged_in()) {
    header('location: artists.php');
}

if (isset($_GET['do'])) {
    if ($_GET['do'] == 'logout') {
        unset($_SESSION['admin_id']);
    }
}

if (isset($_POST['login'])) {
    if ($_POST['username'] == 'ST_Admin' && $_POST['pass'] == $PASSWORD_ST_ADMIN) {
        $_SESSION['admin_id'] = 'admin';
        header("location: artists.php");
        exit();
    } else {
        $message = "Incorrect Login, please try again";
    }
}

?>

<!DOCTYPE html>
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
	
<?php
$login_page = TRUE;
require_once('menu.php');
?>
	
		<div id="content">
			<h3>Please Login:</h3>
			<h4 class="messageRed">
			
<?php
if (isset($message)) {
    echo $message;
}
?>

			</h4>

			<hr noshade size=1>
			<form name="login" action="" method="POST">
				<table cellpadding="5" cellspacing="0">
					<tr>
						<td>User Id:</td><td><input type="text" name="username" value="<?= @$_POST['username']; ?>" /></td>
					</tr>
					<tr>
						<td>Password:</td><td><input type="password" name="pass" /></td>
					</tr>
					<tr>
						<td colspan="2" align="right"><input type="submit" name="login" value="Login" /></td>
					</tr>
				</table>
			</form>

		<!--content-->
		</div>	
	
	<!--container-->
	</div>

</body>
</html>