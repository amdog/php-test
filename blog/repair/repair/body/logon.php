<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>logon</title>
</head>
<body>
    <form action="./logon.php" method="post" style='display:blok;margin:0 auto;width:500px;height:500px;'>
    **用户名 <input type="text" name="name"><br><br>
    你的密码 <input name='passwd' type="password"><br><br>
    确认密码 <input name='passwdagain' type="password"><br><br>
    <input type="submit" name='logon' value="注册"> <a href="../">返回</a>
</form>
<?php
if(isset($_POST['logon'])){
    $conn = mysqli_connect ("localhost","root","123","dbrepair");
    $row=mysqli_query($conn,"select * from tbuser where username='{$_POST['name']}'");
    $r=mysqli_fetch_assoc($row);
    if($_POST['passwd'] == $_POST['passwdagain']){
        if($row->num_rows == 0){
            $target=mysqli_query($conn,"insert into tbuser(username,userpwd,isadmin) values ('{$_POST['name']}','{$_POST['passwd']}',0)");
            if($target == 1){
                header('location:/');
            }
        }
        else{
            echo "<script>alert('用户已经存在!');history.go(-1);</script>";
        }
    }
    else{
        echo "<script>alert('两次密码不一致!');history.go(-1);</script>";
    }
}
?>
</body>
</html>