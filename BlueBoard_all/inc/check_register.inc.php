<?php 
if(empty($_POST['name'])){
	skip('register.php', 'error', 'User name can not be NULL!');
}
if(mb_strlen($_POST['name'])>32){
	skip('register.php', 'error', 'User name can not be over 32 letters!');
}
if(mb_strlen($_POST['pw'])<6){
	skip('register.php', 'error','Password should be longer than 6 letters!');
}
if($_POST['pw']!=$_POST['confirm_pw']){
	skip('register.php', 'error','Please keep the two password consistent!');
}
if(strtolower($_POST['vcode'])!=strtolower($_SESSION['vcode'])){
	skip('register.php', 'error','Wrong verification code!');
}
$_POST=escape($link,$_POST);
$query="select * from BlueBoard_member where name='{$_POST['name']}'";
$result=execute($link, $query);
if(mysqli_num_rows($result)){
	skip('register.php', 'error', 'This User name has been used please put in a new one!');
}
?>