<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title']='Modify Top Modules';
$template['css']=array('style/public.css');
$link=connect();
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip('father_module.php','error','id is wrong！');
}
$query="select * from father_module where id={$_GET['id']}";
$result=execute($link,$query);
if(!mysqli_num_rows($result)){
	skip('father_module.php','error','Sorry, there is no such module!');
}
if(isset($_POST['submit'])){
	
	$check_flag='update';
	include 'inc/check_father_module.inc.php';
	$query="update father_module set module_name='{$_POST['module_name']}',sort={$_POST['sort']} where id={$_GET['id']}";
	execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		skip('father_module.php','ok','OK! Successfully Modified!');
	}else{
		skip('father_module.php','error','Sorry! Modified failed, pleas try again!');
	}
}
$data=mysqli_fetch_assoc($result);
?>
<?php include 'inc/header.inc.php'?>
<div id="main">
	<div class="title" style="margin-bottom:20px;">Modify Top Modules - <?php echo $data['module_name']?></div>
	<form method="post">
		<table class="au">
			<tr>
				<td>Module Name</td>
				<td><input name="module_name" value="<?php echo $data['module_name']?>" type="text" /></td>
				<td>
					Module name can not be NULL or over 66 letters.
				</td>
			</tr>
			<tr>
				<td>Sort</td>
				<td><input name="sort" value="<?php echo $data['sort']?>" type="text" /></td>
				<td>
					1 digit number.
				</td>
			</tr>
		</table>
		<input style="margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="Modify" />
	</form>
</div>
<?php include 'inc/footer.inc.php'?>