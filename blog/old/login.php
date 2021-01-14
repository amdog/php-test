<!doctype html>
<html>
<head>
<title>登录</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=480, user-scalable=yes">
       <script type="text/javascript" src="jQuery.js"></script>
       <link rel="stylesheet" type="text/css" href="bootstrap.css">
    </head>
    <?php
    function back ($message){
        	echo $message;
			echo "
                    <script type='text/javascript'>
                    $(window).load(()=>{
                        setTimeout(()=>{
                        window.location.href='/old/index.php'
                        },2000)
                    })
					</script>
			";
    };
            if(array_key_exists('name',$_GET) && array_key_exists('password',$_GET) && strlen($_GET['name'])>0 && strlen($_GET['password'])>0){
                $connect=mysqli_connect("chatjs.top","root","b");
                mysqli_select_db($connect,'dbphp' );
                mysqli_query($connect,"set names utf8");
                $user_pwd=mysqli_fetch_array(mysqli_query($connect,"select userpwd from tbuser where username='{$_GET['name']}'"), MYSQLI_ASSOC);
                if($user_pwd['userpwd'] == $_GET['password']){
                setcookie("who",$_GET['name'],time()+60*60*23,"/");
                back("<div class='col-4 offset-3 alert alert-success'>成功!2s后跳转</div>");                    
                }
                else{
                    back("<div class='col-4 offset-3 alert alert-danger'>账号密码错误!</div>"); 
                }
			}else{
                back("<div class='col-4 offset-3 alert alert-danger'>用户名密码不能为空</div>");
			}
?>	
    <body>
</body></html>