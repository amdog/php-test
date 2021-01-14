<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body class="sign">
    <br>
    <form action="./sign.php" method="post">





















    <?php
        if($_POST && array_key_exists('sign',$_POST)){
            $connect=mysqli_connect("chatjs.top","root","b");
            mysqli_select_db( $connect, 'public' );
            mysqli_query($connect,"set names utf8");
            if($_POST['passwdagain'] == $_POST['passwd']){
                $rows=mysqli_query($connect,"select * from user_info where _name='{$_POST['name']}'");
                if(strlen($_POST['emaile']) > 3){
                    if($rows->num_rows == 0){
                        mysqli_query($connect,"insert into user_info(_name,passwd,emaile) values ('{$_POST['name']}','{$_POST['passwd']}','{$_POST['emaile']}')");
                        setcookie("who_login_this",$_POST['name'],time()+60*60*23*7,"/");
                        header('location:./login.php');
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




















    <br><br>
    <label for="name">用户名</label>    <br>
    <input type="text" name="name" placeholder="xxx">
    <br><br>
    <label for="passwd">密码</label><br>
    <input type="password" name="passwd" placeholder="123">
    <br><br>
    <label for="passwdagain">确认密码</label><br>
    <input type="password" name="passwdagain" placeholder="123">
    <br><br>
    <label for="emaile">邮箱</label>
    <br>
    <input type="text" id="emaile" name="emaile" placeholder="xxx@123.com">
    <br>
    <br>
    <br>
    <input type="submit" name='sign' value="Sinup">
    <input type="button" value="back">
    </form>

    <script>
        document.getElementsByTagName('input')[5].addEventListener('click',()=>{
            window.location.href='./login.php'
        })
    </script>

        <script>
    $=(ele)=>{
        return document.querySelectorAll(ele)
    }
            function scrollFun(e) {
                    var event = e || window.event;
                    var dir = event.detail || -event.wheelDelta;
                    parent.window.startTime=new Date().getTime() 
                    if (parent.window.startTime - parent.window.endTime > 500) {
                        parent.window.scrollNext(dir)
                    } 
                    event.preventDefault();
                }
                if (navigator.userAgent.toLowerCase().indexOf("firefox") != -1) {
                    document.addEventListener("DOMMouseScroll", scrollFun,{ passive: false });
                } else if (document.addEventListener) {
                    document.addEventListener("mousewheel", scrollFun, false);
                } else if (document.attachEvent) {
                    document.attachEvent("onmousewheel", scrollFun,{ passive: false });
                } else {
                    document.onmousewheel = scrollFun;
                } 
                $=(ele)=>{
                return document.querySelectorAll(ele)
            }
            $('body')[0].addEventListener('click',(e)=>{
                let ele=document.createElement('div')
                ele.className='clickBox'
                $('body')[0].appendChild(ele)
                setTimeout(()=>{
                    ele.parentNode.removeChild(ele)
                },500)
                ele.style.top=`${e.clientY-15}px`
                ele.style.left=`${e.clientX-15}px`
            })
            </script>
</body>
</html>