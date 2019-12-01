<?php 
if(empty($_POST['name'])){
	skip('login.php','error','Name cannot be empty!');
}
if(mb_strlen($_POST['name'])>32){
	skip('login.php','error','Name cannot exceed 32 characters!');
}
if(mb_strlen($_POST['pw'])<6){
	skip('login.php','error','Passwords should be longer than 6 characters!');
}
if(strtolower($_POST['vcode'])!=strtolower($_SESSION['vcode'])){
	skip('login.php', 'error','Wrong verification code!');
}
?>