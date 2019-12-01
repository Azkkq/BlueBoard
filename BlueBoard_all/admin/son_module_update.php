<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title']='子版块修改页';
$template['css']=array('style/public.css');
$link=connect();
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip('son_module.php','error','id is wrong！');
}
$query="select * from son_module where id={$_GET['id']}";
$result=execute($link,$query);
if(!mysqli_num_rows($result)){
	skip('son_module.php','error','Sorry, there is no such module!！');
}
$data=mysqli_fetch_assoc($result);
if(isset($_POST['submit'])){
	//验证
	$check_flag='update';
	include 'inc/check_son_module.inc.php';
	$query="update son_module set father_module_id={$_POST['father_module_id']},module_name='{$_POST['module_name']}',info='{$_POST['info']}',member_id={$_POST['member_id']},sort={$_POST['sort']} where id={$_GET['id']}";
	execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		skip('son_module.php','ok','OK! Successfully Modified!');
	}else{
		skip('son_module.php','error','Sorry! Modified failed, pleas try again!');
	}
}
?>
<?php include 'inc/header.inc.php'?>
<div id="main">
	<div class="title" style="margin-bottom:20px;">Modify Sub Modules - <?php echo $data['module_name']?></div>
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
							if($data['father_module_id']==$data_father['id']){
								echo "<option selected='selected' value='{$data_father['id']}'>{$data_father['module_name']}</option>";
							}else{
								echo "<option value='{$data_father['id']}'>{$data_father['module_name']}</option>";
							}
						}
						?>
					</select>
				</td>
				<td>
					必Please choose a top module.
				</td>
			</tr>
			<tr>
				<td>Module Name</td>
				<td><input name="module_name" value="<?php echo $data['module_name']?>" type="text" /></td>
				<td>
					Module name can not be NULL or over 66 letters.
				</td>
			</tr>
			<tr>
				<td>Module Introduction<</td>
				<td>
					<textarea name="info"><?php echo $data['info']?></textarea>
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
				<td><input name="sort"  value="<?php echo $data['sort']?>" type="text" /></td>
				<td>
					1 digit number.
				</td>
			</tr>
		</table>
		<input style="margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="Modify" />
	</form>
</div>
<?php include 'inc/footer.inc.php'?>