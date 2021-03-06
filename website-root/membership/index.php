<?php

require_once('inc/connect.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/passwords.php');

$adminVal = -1;

if (isset($_GET['logout'])) {
	unset($_SESSION['profile']);
	if (!isset($_SESSION['admin'])) {
		session_destroy();
		}
}

if (isset($_GET['logout_admin'])) {
	unset($_SESSION['profile']);
	unset($_SESSION['admin']);
	session_destroy();
}

if (isset($_POST['profile'])) {
	
	$profile = $_POST['profile'];
	$password = $_POST['password'];
	
	if ($profile == $adminVal && $password == $PASSWORD_ADMIN) {
		$_SESSION['admin'] = true;
		header('location: admin.php');
	}	

	$sql = "select * from profiles where id = '$profile' && password = '$password'";
	$result = mysql_query($sql);
	if (mysql_num_rows($result) > 0) {
		//we've found the user, log them in.
		$_SESSION['member'] = $profile;
		header("location: manage.php");
	}
}

$profiles = getProfiles();

?>
<!doctype html>
<html lang="en">
  <head>

    <meta name="AUTHOR" content="Balazs Bagi" />
    <meta charset="utf-8" />
    <?php require_once("inc/meta.php"); ?>

    <title>Studio Tour Sign Up</title>

    <link rel="stylesheet" type="text/css" href="css/dimensions.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />

    <script src="js/modernizr.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </head>
  <body>
    <div id="container">
                             
      <h2 class="mb0">Salt Spring Studio Tour Registration</h2>			  
      <p>We're in the process of making changes to the website.</p>            
      <p>We're also just learning where the previous website programmer put everything; please be patient!</p>
      <p>
        Please log in below to manage your Studio Tour listing.
      </p>
      <p>
        If you have lost your login credentials, or your studio is not listed, please contact <a href="mailto:saltspringstudiotour@gmail.com">saltspringstudiotour@gmail.com</a>
      </p>

      <form class="form-horizontal" method="post" action="index.php">

        <div class="control-group">
          <label class="control-label" for="profile">Studio Member</label>

          <div class="controls">
            <select name="profile" id="profile" class="w400">
              <?php foreach($profiles as $val) { $val = (object) $val; ?>

              <option value='<?=$val->id?>'>
				<span>#</span>
				<span><?=$val->tour_number?><span>
				<span><?=$val->studio_name?></span>
              </option>

              <?php } ?>
			  
              <option value='<?= $adminVal ?>'>Administration</option>
            
			</select>
            <!--controls-->
          </div>
          <!--control-group-->
        </div>

        <div class="control-group">
          <label class="control-label" for="inputPassword">Password</label>
          <div class="controls">
            <input type="password" id="inputPassword" name="password"> </div>
        </div>

        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn">Sign in</button>
          </div>
        </div>

      </form>

      <!--container-->
    </div>

  </body>
</html>