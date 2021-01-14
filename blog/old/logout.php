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
    setcookie('who','',time()-1,'/');
    back("<div class='col-4 offset-3 alert alert-danger'>注销成功</div>")
?>	
    <body>
</body></html>