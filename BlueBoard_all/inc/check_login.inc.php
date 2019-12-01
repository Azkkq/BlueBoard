<?php 
if(empty($_POST['name'])){
	skip('login.php', 'error', 'User name can not be NULL!');
}
if(mb_strlen($_POST['name'])>32){
	skip('login.php', 'error', 'User name can not be over 32 letters!');
}
if(empty($_POST['pw'])){
	skip('login.php', 'error', 'Password can not be NULL!');
}
if(strtolower($_POST['vcode'])!=strtolower($_SESSION['vcode'])){
	skip('login.php', 'error','Wrong verification code!');
}
if(empty($_POST['time']) || is_numeric($_POST['time']) || $_POST['time']>2592000){
	$_POST['time']=2592000;
}
?>