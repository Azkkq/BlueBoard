<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
include_once 'inc/is_manage_login.inc.php';//验证管理员是否登录
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip('manage.php','error','Wrong ID!');
}
$query="delete from manage where id={$_GET['id']}";
execute($link,$query);
if(mysqli_affected_rows($link)==1){
	skip('manage.php','ok','Delete succesfully!');
}else{
	skip('manage.php','error','Sorry delete failed! Please try again!');
}
?>