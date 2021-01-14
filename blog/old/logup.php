<!doctype html>
<html>
<head>
<title>用户注册</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
<body>
	<div class="container">
		<br><br><br><br><br><br><br>
        <?php
			if($_POST["password"] !== $_POST["passwordAgain"]){
				echo "<div class='col-4 offset-3 alert alert-danger'>两次密码输入不一致</div>";
            }
/*             else if(explode(".",$_POST['file'])[1] !== "jpg"){
                echo "<div class='col-4 offset-3 alert alert-danger'>文件名必须为*.jpg</div>";
            } */
            else if($_POST["password"] =="" || $_POST["name"] ==""){
                echo "<div class='col-4 offset-3 alert alert-danger'>账号密码不能为空!</div>";
            }
			else{
                /*注册php*/
                $connect=mysqli_connect("chatjs.top","root","b");
                mysqli_select_db($connect,'dbphp' );
                mysqli_query($connect,"set names utf8");
                $user_in=mysqli_fetch_array(mysqli_query($connect,"select * from tbuser where username='{$_POST['name']}'"), MYSQLI_ASSOC);
                if(count($user_in)==0){
                    $target=mysqli_query($connect,"insert into tbuser(username,userpwd) values ('{$_POST['name']}','{$_POST['password']}')");
                    if($target == '1'){
                            echo "<div class='col-4 offset-3 alert alert-success'>注册成功!</div>";
		            }                    
                }
                else{
                    echo "<div class='col-4 offset-3 alert alert-danger'>sorry,用户名被占用!</div>";
                }
                
            }
            ?>
	</div>
</body>
</html>
