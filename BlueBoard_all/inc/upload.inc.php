<?php 
function upload($save_path,$custom_upload_max_filesize,$key,$type=array('jpg','jpeg','gif','png')){
	$return_data=array();
	
	$phpini=ini_get('upload_max_filesize');
	
	$phpini_unit=strtoupper(substr($phpini,-1));
	
	$phpini_number=substr($phpini,0,-1);
	
	$phpini_multiple=get_multiple($phpini_unit);
	
	$phpini_bytes=$phpini_number*$phpini_multiple;

	$custom_unit=strtoupper(substr($custom_upload_max_filesize,-1));
	$custom_number=substr($custom_upload_max_filesize,0,-1);
	$custom_multiple=get_multiple($custom_unit);
	$custom_bytes=$custom_number*$custom_multiple;

	if($custom_bytes>$phpini_bytes){
		$return_data['error']='The picture $custom_upload_max_filesize is bigger than configuration file in PHP'.$phpini;
		$return_data['return']=false;
		return $return_data;
	}
	$arr_errors=array(
			1=>'The uploaded file exceeds the limit of the upload_max_filesize option in php.in',
			2=>'The size of the uploaded file exceeds the value specified by the MAX_FILE_SIZE option in the HTML form',
			3=>'Only part of the file was uploaded',
			4=>'No files were uploaded',
			6=>'Cannot find temporary folder',
			7=>'File write failed'
	);
	if(!isset($_FILES[$key]['error'])){
		$return_data['error']='The upload failed due to unknown reasons. Please try again!';
		$return_data['return']=false;
		return $return_data;
	}
	if ($_FILES[$key]['error']!=0) {
		$return_data['error']=$arr_errors[$_FILES['error']];
		$return_data['return']=false;
		return $return_data;
	}
	if(!is_uploaded_file($_FILES[$key]['tmp_name'])){
		$return_data['error']='The file you uploaded was not uploaded via HTTP POST!';
		$return_data['return']=false;
		return $return_data;
	}
	if($_FILES[$key]['size']>$custom_bytes){
		$return_data['error']='The size of the uploaded file exceeds the limit:'.$custom_upload_max_filesize;
		$return_data['return']=false;
		return $return_data;
	}
	$arr_filename=pathinfo($_FILES[$key]['name']);
	if(!isset($arr_filename['extension'])){
		$arr_filename['extension']='';
	}
	if(!in_array($arr_filename['extension'],$type)){
		$return_data['error']='The suffix of the uploaded file must be one of '.implode(',',$type);
		$return_data['return']=false;
		return $return_data;
	}
	if(!file_exists($save_path)){
		if(!mkdir($save_path,0777,true)){
			$return_data['error']='Upload file save directory creation failed, please check permissions!';
			$return_data['return']=false;
			return $return_data;
		}
	}
	$new_filename=str_replace('.','',uniqid(mt_rand(100000,999999),true));
	if($arr_filename['extension']!=''){
		$new_filename.=".{$arr_filename['extension']}";
	}
	$save_path=rtrim($save_path,'/').'/';
	if(!move_uploaded_file($_FILES[$key]['tmp_name'],$save_path.$new_filename)){
		$return_data['error']='Temporary file move failed, please check permissions!';
		$return_data['return']=false;
		return $return_data;
	}
	$return_data['save_path']=$save_path.$new_filename;
	$return_data['filename']=$new_filename;
	$return_data['return']=true;
	return $return_data;
}
function get_multiple($unit){
	switch ($unit){
		case 'K':
			$multiple=1024;
			return $multiple;
		case 'M':
			$multiple=1024*1024;
			return $multiple;
		case 'G':
			$multiple=1024*1024*1024;
			return $multiple;
		default:
			return false;
	}
}
?>