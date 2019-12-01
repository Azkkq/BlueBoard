<?php 
if(empty($_POST['module_id']) || !is_numeric($_POST['module_id'])){
	skip('publish.php', 'error', 'Wrong module id!');
}
$query="select * from son_module where id={$_POST['module_id']}";
$result=execute($link, $query);
if(mysqli_num_rows($result)!=1){
	skip('publish.php', 'error', 'This module does not exist!');
}
if(empty($_POST['title'])){
	skip('publish.php', 'error', 'Title can not be NULL!');
}
if(mb_strlen($_POST['title'])>255){
	skip('publish.php', 'error', 'Title can not over 255 letters!');
}
?>