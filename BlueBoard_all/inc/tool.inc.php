<?php 
function skip($url,$pic,$message){
$html=<<<A
<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="utf-8" />
<meta http-equiv="refresh" content="3;URL={$url}" />
<title>Dispatching...</title>
<link rel="stylesheet" type="text/css" href="style/remind.css" />
</head>
<body>
<div class="notice"><span class="pic {$pic}"></span> {$message} <a href="{$url}">Please wait 3 seconds!</a></div>
</body>
</html>
A;
echo $html;
exit();
}
//users login or not
function is_login($link){
	if(isset($_COOKIE['sfk']['name']) && isset($_COOKIE['sfk']['pw'])){
		$query="select * from BlueBoard_member where name='{$_COOKIE['sfk']['name']}' and sha1(pw)='{$_COOKIE['sfk']['pw']}'";
		$result=execute($link,$query);
		if(mysqli_num_rows($result)==1){
			$data=mysqli_fetch_assoc($result);
			return $data['id'];
		}else{
			return false;
		}
	}else{
		return false;
	}
}
function check_user($member_id,$content_member_id,$is_manage_login){
	if($member_id==$content_member_id || $is_manage_login){
		return true;
	}else{
		return false;
	}
}
//manager login or not
function is_manage_login($link){
	if(isset($_SESSION['manage']['name']) && isset($_SESSION['manage']['pw'])){
		$query="select * from manage where name='{$_SESSION['manage']['name']}' and md5(pw)='{$_SESSION['manage']['pw']}'";
		$result=execute($link,$query);
		if(mysqli_num_rows($result)==1){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}
?>