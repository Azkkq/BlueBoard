<?php 
include_once '../inc/config.inc.php';
if(!isset($_GET['message']) || !isset($_GET['url']) || !isset($_GET['return_url'])){
	exit();
}
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="utf-8" />
<title>Confirmation page</title>
<meta name="keywords" content="Confirm page" />
<meta name="description" content="Confirm page" />
<link rel="stylesheet" type="text/css" href="style/remind.css" />
</head>
<body>
<div class="notice"><span class="pic ask"></span> <?php echo $_GET['message']?> <a style="color:red;" href="<?php echo $_GET['url']?>">Yes, I am sure.</a> | <a style="color:#666;" href="<?php echo $_GET['return_url']?>">No, I want to cancel it.</a></div>
</body>
</html>