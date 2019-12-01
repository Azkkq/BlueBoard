<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
if(isset($_POST['submit'])){
	$link=connect();

	$check_flag='add';
	include 'inc/check_father_module.inc.php';
	$query="insert into father_module(module_name,sort) values('{$_POST['module_name']}',{$_POST['sort']})";
	execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		skip('father_module.php','ok','OK! Added succesfully!');
	}else{
		skip('faher_module_add.php','error','Sorry! Added failed, please try again!');
	}
}

$template['title']='Add Top Modules Page';
$template['css']=array('style/public.css','style/father_module_add.css');
?>
<?php include 'inc/header.inc.php'?>
<div id="main">
	<div class="title" style="margin-bottom:20px;">Add Top Modules</div>
	<form method="post">
		<table class="au">
			<tr>
				<td>Module Name</td>
				<td><input name="module_name" type="text" /></td>
				<td>
					Module name can not be NULL or over 66 letters.
				</td>
			</tr>
			<tr>
				<td>Sort</td>
				<td><input name="sort" value="0" type="text" /></td>
				<td>
					1 digit number.
				</td>
			</tr>
		</table>
		<input style="margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="Add" />
	</form>
</div>
<?php include 'inc/footer.inc.php'?>