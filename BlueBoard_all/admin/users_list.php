<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
include 'inc/header.inc.php';
$link=connect();
$template['title']="Users List";
?>

<?php
$delete['success'] = null;
if (isset($_GET['id'])){
    $query = "delete from BlueBoard_member where id={$_GET['id']}";
    $result = execute($link,$query);
    if (mysqli_affected_rows($link)==1){
        $delete['success'] ='yes';
    }
    else{
        $delete['success'] = 'no';
    }
}
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="utf-8" />
<title>Manage Page</title>
<meta name="keywords" content="Manage Page" />
<meta name="description" content="Manage Page" />
<link rel="stylesheet" type="text/css" href="style/public.css" />
</head>
<body>
<div id="main">
    <div class="title">Users List</div>
    <form action="" method="post">
        <table class="list">
            <tr>
                <th>User Name</th>
                <th>md5 Password</th>
                <th>Register Time</th>
                <th>Picture</th>
                <th>Operation</th>
            </tr>
            <?php
            $query = "select * from BlueBoard_member";
            $result = execute($link,$query);
            while ($data = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><a href="../member.php?id=<?php echo $data['id']?>"><?php echo $data['name']?></a></td>
                <td><?php echo $data['pw']?></td>
                <td><?php echo $data['register_time']?></td>
                <td><img width="30" height="30" src="<?php echo "../{$data['photo']}"?>"></td>
                <td>&nbsp;&nbsp;<a href="users_list.php?id=<?php echo $data['id']?>">[delete]</a></td>
            </tr>
            <?php }?>
        </table>
        <p><?php
            if (isset($delete['success'])){
                if ($delete['success']=='yes'){
                    echo "Delete successfully!";
                }
                else{
                    echo "Delete failed! Please try again!";
                }
            }
            ?></p>
    </form>
</div>
</body>
</html>

<?php include 'inc/footer.inc.php'?>