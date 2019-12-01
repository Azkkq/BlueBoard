<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title']='Add Sub Modules Page';
$template['css']=array('style/public.css');
$link=connect();
if(isset($_POST['submit'])){
	
	$check_flag='add';
	include 'inc/check_son_module.inc.php';
	$query="insert into son_module(father_module_id,module_name,info,member_id,sort) values({$_POST['father_module_id']},'{$_POST['module_name']}','{$_POST['info']}',{$_POST['member_id']},{$_POST['sort']})";
	execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		skip('son_module.php','ok','OK! Added succesfully!');
	}else{
		skip('son_module_add.php','error','Sorry! Added failed, please try again!');
	}
}
?>
<?php include 'inc/header.inc.php'?>
<div id="main">
	<div class="title" style="margin-bottom:20px;">Add Sub Modules</div>
	<form method="post">
		<table class="au">
			<tr>
				<td>Corresponding Top Module</td>
				<td>
					<select name="father_module_id">
						<option value="0">======Please choose a top module of it======</option>
						<?php 
						$query="select * from father_module";
						$result_father=execute($link,$query);
						while ($data_father=mysqli_fetch_assoc($result_father)){
							echo "<option value='{$data_father['id']}'>{$data_father['module_name']}</option>";
						}
						?>
					</select>
				</td>
				<td>
					Please choose a top module.
				</td>
			</tr>
			<tr>
				<td>Module Name</td>
				<td><input name="module_name" type="text" /></td>
				<td>
					Module name can not be NULL or over 66 letters.
				</td>
			</tr>
			<tr>
				<td>Module Introduction</td>
				<td>
					<textarea name="info"></textarea>
				</td>
				<td>
					Introduction can not over 255 letters.
				</td>
			</tr>
			<tr>
				<td>Module Moderator</td>
				<td>
					<select name="member_id">
						<option value="0">======Please choose a BlueBoard Member======</option>
						
					</select>
				</td>
				<td>
					You can choose a BlueBoard Member as a moderator who can manage posts in this sub module.
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