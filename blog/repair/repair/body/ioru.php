<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>报修</title>
</head>
<body>
    <form action='./ioru.php' method='post'>
<!--      -->
    

    <?php
    $conn = mysqli_connect ("localhost","root","123","dbrepair");//r,
    if(isset($_POST['sub'])){
        if(isset($_COOKIE['who_login_this'])){
            $target=mysqli_query($conn,"insert into repair(dornum,faulteqiupment,who) values 
            (
                '{$_POST['v1']}','{$_POST['v2']}','{$_COOKIE['who_login_this']}'
            )
            ");
            if($target == 1){
                header('location:./index.php');
            }
        }
        else{
            header('location:/');
        }
    }


    if(isset($_POST['subadmin'])){
        if(isset($_COOKIE['who_login_this'])){
            $row=mysqli_query($conn,"select * from tbuser where  username='{$_COOKIE['who_login_this']}'");
            $r=mysqli_fetch_assoc($row);
            if($r['isadmin'] == 1){
                mysqli_query($conn,"update  repair set iscomplete='{$_POST['v1']}',repairman='{$_POST['v2']}'
                where id_={$_POST['v3']}
                ");
                header('location:./index.php');
            }
        }
    }


    if(isset($_COOKIE['who_login_this'])){
        $row=mysqli_query($conn,"select * from tbuser where  username='{$_COOKIE['who_login_this']}'");
        $r=mysqli_fetch_assoc($row);
        if($r['isadmin'] == 1){
            $row=mysqli_query($conn,"select * from repair where id_='{$_GET['id']}'");
            $r=mysqli_fetch_assoc($row);
            echo "
            是否完成：<input type='text' value='{$r['iscomplete']}' name='v1'><br><br>
            维修人员：<input type='text' value='{$r['repairman']}' name='v2'><br><br>
            订单i d：<input type='text' value='{$_GET['id']}' name='v3'><br><br>
            <input type='submit' name='subadmin'  value='提交'>";
        }else{
        echo "宿舍号码：<input type='text' name='v1'><br><br>
        维修设施：<input type='text' name='v2'><br><br>
        <input type='submit' name='sub' value='提交'>";
    }
    }
 
    ?>    </form>
</body>
</html>