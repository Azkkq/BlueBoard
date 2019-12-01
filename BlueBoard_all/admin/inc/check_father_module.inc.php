<?php 
if(empty($_POST['module_name'])){
	skip('father_module_add.php','error','Module name can not be NULL!');
}
if(mb_strlen($_POST['module_name'])>66){
	skip('father_module_add.php','error','Module name can not over 66 letters!');
}
if(!is_numeric($_POST['sort'])){
	skip('father_module_add.php','error','Sort input can only be numbers!');
}
$_POST=escape($link,$_POST);
switch ($check_flag){
	case 'add':
		$query="select * from father_module where module_name='{$_POST['module_name']}'";
		break;
	case 'update':
		$query="select * from father_module where module_name='{$_POST['module_name']}' and id!={$_GET['id']}";
		break;
	default:
		skip('father_module_add.php','error','$check_flag Wrong！');
}
$result=execute($link,$query);
if(mysqli_num_rows($result)){
	skip('father_module_add.php','error','Already exists this module!');
}
?>