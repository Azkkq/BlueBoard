<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip('son_module.php','error','Wong ID!');
}
$link=connect();
$query="delete from son_module where id={$_GET['id']}";
execute($link,$query);
if(mysqli_affected_rows($link)==1){
	skip('son_module.php','ok','Delete successfully!');
}else{
	skip('son_module.php','error','Sorry, delete failed! Please try again!');
}
?>