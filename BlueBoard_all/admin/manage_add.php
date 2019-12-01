<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
include_once 'inc/is_manage_login.inc.php';
if(isset($_POST['submit'])){
	include 'inc/check_manage.inc.php';
	$query="insert into manage(name,pw,create_time,level) values('{$_POST['name']}',md5({$_POST['pw']}),now(),{$_POST['level']})";
	execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		skip('manage.php','ok','Add successfully!');
	}else{
		skip('manage.php','error','Sorry, add failed! Please try again!');
	}
}
$template['title']='Add Managers Page';
$template['css']=array('style/public.css');
?>
<?php include 'inc/header.inc.php'?>
<div id="main">
	<div class="title" style="margin-bottom:20px;">Add Managers</div>
	<form method="post">
		<table class="au">
			<tr>
				<td>Admin name</td>
				<td><input name="name" type="text" /></td>
				<td>
					Name cannot be empty or exceed 32 characters.
				</td>
			</tr>
			<tr>
				<td>Passwords</td>
				<td><input name="pw" type="text" /></td>
				<td>
					Passwords should be longer than 6 characters.
				</td>
			</tr>
			<tr>
				<td>Level</td>
				<td>
					<select name="level">
						<option value="1">General Administrator</option>
						<option value="0">Super Administrator</option>
					</select>
				</td>
				<td>
					Default is general administrator.
				</td>
			</tr>
		</table>
		<input style="margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="Add"/>
	</form>
</div>
<?php include 'inc/footer.inc.php'?>