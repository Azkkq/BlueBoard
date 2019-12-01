<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip('father_module.php','error','id wrong！');
}
$link=connect();
$query="select * from son_module where father_module_id={$_GET['id']}";
$result=execute($link,$query);
if(mysqli_num_rows($result)){
	skip('father_module.php','error','There already exist this sub module, please delete it first!');
}
$query="delete from father_module where id={$_GET['id']}";
execute($link,$query);
if(mysqli_affected_rows($link)==1){
	skip('father_module.php','ok','OK! Successfully delete!');
}else{
	skip('father_module.php','error','Sorry! Delete failed, please try again!');
}
?>