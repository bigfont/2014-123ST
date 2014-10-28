<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>eMail Test 4</title>
</head>

eMail Test Document 4
<?php
$to      = 'Studio Tour <saltspringstudiotour@gmail.com>';
$subject = 'the subject4';
$message = 'hello4';
$headers = 'From: Studio Tour <saltspringstudiotour@gmail.com>';
$headers = 'To: Studio Tour <saltspringstudiotour@gmail.com>';
    'Reply-To: Studio Tour <saltspringstudiotour@gmail.com>' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>
<body>
</body>
</html>
