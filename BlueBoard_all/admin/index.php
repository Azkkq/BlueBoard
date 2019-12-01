<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
include_once 'inc/is_manage_login.inc.php';

$query="select * from manage where id={$_SESSION['manage']['id']}";
$result_manage=execute($link, $query);
$data_manage=mysqli_fetch_assoc($result_manage);

$query="select count(*) from father_module";
$count_father_module=num($link,$query);

$query="select count(*) from son_module";
$count_son_module=num($link,$query);

$query="select count(*) from content";
$count_content=num($link,$query);

$query="select count(*) from reply";
$count_reply=num($link,$query);

$query="select count(*) from BlueBoard_member";
$count_member=num($link,$query);

$query="select count(*) from manage";
$count_manage=num($link,$query);

if($data_manage['level']=='0'){
	$data_manage['level']='Super Administrator';
}else{
	$data_manage['level']='General Administrator';
}
$template['title']='System Information';
$template['css']=array('style/public.css');
?>

<?php include 'inc/header.inc.php'?>

<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="utf-8" />
<title>Manage Page</title>
<meta name="keywords" content="Manage Page" />
<meta name="description" content="Manage Page" />
<link rel="stylesheet" type="text/css" href="style/public.css" />
</head>
<body>
<div id="main">
	<div class="title">System Information</div>
	<div class="explain">
		<ul>
			<li>|- Hello, <?php echo $data_manage['name']?></li>
			<li>|- Your role: <?php echo $data_manage['level']?> </li>
			<li>|- Created time: <?php echo $data_manage['create_time']?></li>
		</ul>
	</div>
	<div class="explain">
		<ul>
			<li>|- Top Modules(<?php echo $count_father_module?>)</li>
			<li>|- Sub Modules(<?php echo $count_son_module?>)</li>
			<li>|- Total Posts(<?php echo $count_content?>)</li>
			<li>|- Total Replies(<?php echo $count_reply?>)</li>
			<li>|- Total Members(<?php echo $count_member?>)</li>
			<li>|- Total Adminitrators(<?php echo $count_manage?>)</li>
		</ul>
	</div>
	<div class="explain">
		<ul>
			<li>|- Server operating system:<?php echo PHP_OS?> </li>
			<li>|- Server software:<?php echo $_SERVER['SERVER_SOFTWARE']?> </li>
			<li>|- MySQL version:<?php echo  mysqli_get_server_info($link)?></li>
			<li>|- Maximum upload file:<?php echo ini_get('upload_max_filesize')?></li>
			<li>|- Memory limit:<?php echo ini_get('memory_limit')?></li>
			<li>|- <a target="_blank" href="phpinfo.php">PHP configuration information</a></li>
		</ul>
	</div>
</div>
</body>
</html>

<?php include 'inc/footer.inc.php'?>