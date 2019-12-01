<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
if(!is_manage_login($link)){
	header('Location:login.php');
}
session_unset();//Free all session variables
session_destroy();
setcookie(session_name(),'',time()-3600,'/');
header('Location:login.php');
?>