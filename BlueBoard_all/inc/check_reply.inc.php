<?php 
if(mb_strlen($_POST['content'])<3){
	skip($_SERVER['REQUEST_URI'], 'error', 'Reply content should be more than 3 words!');
}
?>s