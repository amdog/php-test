<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>   <form action="./signup.php" method="post">
<div class="marsk">
<?php 
if($_POST && array_key_exists('singup',$_POST)){
$connect=mysqli_connect("chatjs.top","root","b");
mysqli_select_db( $connect, 'public' );
mysqli_query($connect,"set names utf8");
if($_POST['passwdagian'] == $_POST['passwd']){
    $rows=mysqli_query($connect,"select * from user_info where _name='{$_POST['name']}'");
    if(strlen($_POST['emaile']) > 3){
        if($rows->num_rows == 0){
            mysqli_query($connect,"insert into user_info(_name,passwd,emaile) values ('{$_POST['name']}','{$_POST['passwd']}','{$_POST['emaile']}')");
            setcookie("who_login_this",$_POST['name'],time()+60*60*23,"/");
            header('location:/view/body.php');
        }
        else{
            echo "<script>alert('用户名被占用!')</script>";
        }
    }
    else{
        echo "<script>alert('请输入你的邮箱!')</script>";
    }
}
else{
    echo "<script>alert('两次输入密码不一致。')</script>";
}
}
?>
    <div class="contaniner">
        <br>
        <br>
        <h1>注册炉啊炉攻略</h1>
        <br>
        <br>
        <br>
        <label for="in1">用户名</label>
        <input name="name" type="text" id="in1" placeholder="xxx">
        <br>
        <br>
        <br>
        <label for="in1">密&nbsp;码</label>
        <input type="password" name="passwd"  id="in2">
        <br>
        <br>
        <br>
        <label for="in3">确认密码</label>
        <input type="password" name="passwdagian"  id="in3">
        <br>
        <br>
        <br>
        <label for="in1">邮箱</label>
        <input type="text" name="emaile"  id="in4" placeholder="xx@xx.com">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <input type="submit" name='singup' value="Singup"><a href="../" class="back">返回</a>
    </div>
</div>    </form>
<style>
    .back:hover{
        text-decoration: underline;
    }
    .back:link{
        text-decoration: none;
        color: #999;
    }
    body{
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
    }
    .marsk{
    background-color:#fff;
    width: 100vw;
    height: 100vh;
    position: fixed;
    top: 0;
    color: #000;
    z-index: 9;
    left: 0;
}
.marsk>.contaniner{
    padding: 10px;
    position:  absolute;
    margin: 0 auto;
    top:50%;
    margin-top: -30vh;
    left: 50%;
    margin-left: -30vw;
    width: 60vw;
    height: 60vh;
    background-color: #fff;
    opacity: 1;
    border-radius: 14px;
}
.contaniner>  input{
    background-color: #fff;
    width: 40vw;
    height: 30px;
    outline: none;
    font-size: 30px;
    border: 0;
    border-bottom: #afafaf solid 1px;
}
.contaniner>  input:last-of-type{
    font-size: 20px;
    color: #fff;
    background-color: #33cccc;
    border-radius: 5px;
    height: 40px;
    box-shadow: 0px 0px 5px #33cccc;
    border: 0 !important;
    width: 30vw !important;
    margin-right: 20px;
}
.contaniner> input:focus{
    border-bottom: #222 solid 1px;
}
.contaniner> .back{
    color: #999;
    font-size: 14px;
}
label{
    display: inline-block;
    text-align: center;
    width: 100px;
    height: 40px;
    line-height: 40px;
}
.contaniner>.tips{
    font-size: 12px;
}
</style></body>
</html>

