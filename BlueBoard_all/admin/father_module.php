<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
if(isset($_POST['submit'])){
	foreach ($_POST['sort'] as $key=>$val){
		if(!is_numeric($val) || !is_numeric($key)){
			skip('father_module.php','error','Sorted parameter is wrong!');
		}
		$query[]="update father_module set sort={$val} where id={$key}";
	}
	if(execute_multi($link,$query,$error)){
		skip('father_module.php','ok','Successfully modified!');
	}else{
		skip('father_module.php','error',$error);
	}
}
$template['title']='Top Modules list';
$template['css']=array('style/public.css');
?>
<?php include 'inc/header.inc.php'?>
<div id="main">
	<div class="title">Top Modules list</div>
	<form method="post">
	<table class="list">
		<tr>
			<th>Sort</th>	 	 	
			<th>Module Name</th>
			<th>Operation</th>
		</tr>
		<?php 
		$query="select * from father_module";
		$result=execute($link,$query);
		while ($data=mysqli_fetch_assoc($result)){
			$url=urlencode("father_module_delete.php?id={$data['id']}");
			$return_url=urlencode($_SERVER['REQUEST_URI']);
			$message="Are you sure delete module {$data['module_name']}?";
			$delete_url="confirm.php?url={$url}&return_url={$return_url}&message={$message}";
$html=<<<A
			<tr>
				<td><input class="sort" type="text" name="sort[{$data['id']}]" value="{$data['sort']}" /></td>
				<td>{$data['module_name']}[id:{$data['id']}]</td>
				<td><a href="#">[visit]</a>&nbsp;&nbsp;<a href="father_module_update.php?id={$data['id']}">[modify]</a>&nbsp;&nbsp;<a href="$delete_url">[delete]</a></td>
			</tr>
A;
			echo $html;
		}
		?>
	</table>
	<input style="margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="Sort" />
	</form>
</div>
<?php include 'inc/footer.inc.php'?>