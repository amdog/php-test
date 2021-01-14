<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户界面</title>
</head>
<body>
<table width='100%' height='100%' style='text-align:center;'>
<th>维修人员</th>
<th>报修日期</th>
<th>宿舍号</th>
<th>是否完成</th>
<th>维修设施</th>
<th>操作</th>
<?php
    $conn = mysqli_connect ("localhost","root","123","dbrepair");
?>
    <?php
    //mysqli_query('set names utf8');

    ?>
    <?php
    if(isset($_POST['submit1'])){
        $row=mysqli_query($conn,"select * from tbuser where username='{$_POST['name']}'");
        $r=mysqli_fetch_assoc($row);
        if($row->num_rows == 0){
            echo "<script>alert('你还没有登录!');history.go(-1);</script>";
        }
        else if($r['userpwd'] != $_POST['passwd']){
            echo "<script>alert('密码错误!');history.go(-1);</script>";
        }
        else{
            if($r['userpwd'] == $_POST['passwd']){
                setcookie('who_login_this',$_POST['name'],time()+60*60*24,'/',false,false);
                header('location:./index.php');
            }
        }
    }
    else{
        if(isset($_COOKIE['who_login_this'])){
            echo "{$_COOKIE['who_login_this']}| 你好!<a href=''>";
            $row=mysqli_query($conn,"select * from repair");
            $users=mysqli_query($conn,"select * from tbuser where  username='{$_COOKIE['who_login_this']}'");
            $user_info=mysqli_fetch_assoc($users);
            $action='';
        
            while($r=mysqli_fetch_assoc($row)){
                if($user_info['isadmin'] == 1){
                    $action="<td><a href='./delete.php?id={$r['id_']}'>删除</a> | <a href='./ioru.php?id={$r['id_']}'>修改</a></td>";
                }        
                echo "<tr><td>{$r['repairman']}</td><td>{$r['reportdate']}</td><td>{$r['dornum']}</td><td>{$r['iscomplete']}</td><td>{$r['faulteqiupment']}</td>{$action}</tr>";
            }
        }
        else{
            header('location:/');
        }
        if(isset($_GET['exit'])){
            setcookie('who_login_this','',time()-1000,'/',false,false);
            header('location:/');
        }
    }
    ?>
    <br>
    <br>
    <a href="./index.php?exit=1">退出登录</a>
</table>

<a href="./ioru.php?id=-100">保修</a>
</body>
</html>