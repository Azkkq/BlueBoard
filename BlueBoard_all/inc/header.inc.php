<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="utf-8" />
<title><?php echo $template['title'] ?></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<?php 
foreach ($template['css'] as $val){
	echo "<link rel='stylesheet' type='text/css' href='{$val}' />";
}
?>
</head>
<body>
	<div class="header_wrap">
		<div id="header" class="auto">
			<div class="logo">BlueBoard</div>
			<div class="nav">
				<a class="hover" href="index.php">Main</a>
			</div>
			<div class="serarch">
				<form action="search.php" method="get">
					<input class="keyword" type="text" name="keyword" value="<?php if(isset($_GET['keyword']))echo $_GET['keyword']?>" placeholder="Search Engine" />
					<input class="submit" type="submit" value="" />
				</form>
			</div>
			<div class="login">
				<?php 
				if(isset($member_id) && $member_id){
$str=<<<A
					<a href="member.php?id={$member_id}" target="_blank">Hello!  {$_COOKIE['sfk']['name']}</a> <span style="color:#fff;">|</span> <a href="logout.php">Logout</a>
A;
					echo $str;		
				}else{
$str=<<<A
					<a href="login.php">Login</a>&nbsp;
					<a href="register.php">Register</a>
A;
					echo $str;
				}
				?>
				
			</div>
		</div>
	</div>
	<div style="margin-top:55px;"></div>
