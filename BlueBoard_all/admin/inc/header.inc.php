<?php 

?>
<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="utf-8" />
<title><?php echo $template['title'] ?></title>
<meta name="keywords" content="Manage Page" />
<meta name="description" content="Manage Page" />
<!--?php 
foreach ($template['css'] as $val){
	echo "<link rel='stylesheet' type='text/css' href='{$val}' />";
}
?-->
<link rel="stylesheet" type="text/css" href="style/public.css" />
</head>
<body>
<div id="top">
	<div class="logo">
		BlueBoard_Manage_Center
	</div>
	<div class="login_info">
		<a href="index.php" style="color:#fff;">Main Page</a>&nbsp;|&nbsp;
		Manager:<?php echo $_SESSION['manage']['name']?><a href="logout.php">[Log out]</a>
	</div>
</div>
<div id="sidebar">
	<ul>
		<li>
			<div class="small_title">System</div>
			<ul class="child">
				<li><a <?php if(basename($_SERVER['SCRIPT_NAME'])=='index.php'){echo 'class="current"';}?> href="index.php">System info</a></li>
				<li><a <?php if(basename($_SERVER['SCRIPT_NAME'])=='manage.php'){echo 'class="current"';}?> href="manage.php">Admins</a></li>
				<li><a <?php if(basename($_SERVER['SCRIPT_NAME'])=='manage_add.php'){echo 'class="current"';}?> href="manage_add.php">Add admins</a></li>
				<!-- <li><a <?php if(basename($_SERVER['SCRIPT_NAME'])=='web_set.php'){echo 'class="current"';}?> href="web_set.php">Settings</a></li> -->
			</ul>
		</li>
		<li><!--  class="current" -->
			<div class="small_title">Content Manage</div>
			<ul class="child">
				<li><a <?php if(basename($_SERVER['SCRIPT_NAME'])=='father_module.php'){echo 'class="current"';}?> href="father_module.php">Top Modules List</a></li>
				<li><a <?php if(basename($_SERVER['SCRIPT_NAME'])=='father_module_add.php'){echo 'class="current"';}?> href="father_module_add.php">Add Tops</a></li>
				<?php 
				if(basename($_SERVER['SCRIPT_NAME'])=='father_module_update.php'){
					echo '<li><a class="current">Modify Tops</a></li>';
				}
				?>
				<li><a <?php if(basename($_SERVER['SCRIPT_NAME'])=='son_module.php'){echo 'class="current"';}?> href="son_module.php">Sub Modules List</a></li>
				<li><a <?php if(basename($_SERVER['SCRIPT_NAME'])=='son_module_add.php'){echo 'class="current"';}?> href="son_module_add.php">Add Subs</a></li>
				<?php 
				if(basename($_SERVER['SCRIPT_NAME'])=='son_module_update.php'){
					echo '<li><a class="current">Modify Subs</a></li>';
				}
				?>
				<li><a target="_blank" href="../index.php">Posts</a></li>
			</ul>
		</li>
		<li>
			<div class="small_title">Users Manage</div>
			<ul class="child">
				<li><a href="users_list.php">Users List</a></li>
			</ul>
		</li>
	</ul>
</div>
</body>
</html>