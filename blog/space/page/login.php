<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body class="login">
    <div class="left-box">
    </div>
    <div class="right-box">


















<?php
        $connect=mysqli_connect("chatjs.top","root","b");
        mysqli_select_db( $connect, 'public' );
        mysqli_query($connect,"set names utf8");
        if(array_key_exists('create',$_POST)){
            if(array_key_exists('who_login_this',$_COOKIE)){
                $result=mysqli_query($connect,"insert into picture_space(who_upload,title,note) values ('{$_COOKIE['who_login_this']}','{$_POST['title']}','{$_POST['desc']}')");
            if($result== 1){
                echo "<script>window.alert('发布成功');window.location.href='./login.php';</script>";
            }else{
                echo "<script>window.alert('发布失败')</script>";
            }
        }
        }
        if(array_key_exists('exit',$_GET)){
            setcookie("who_login_this",'',-1,"/",false,false);
            echo "<script>window.location.href='./login.php'</script>";
        }

        if(array_key_exists('login',$_POST)){
            $rows=mysqli_query($connect,"select * from user_info where _name='{$_POST['name']}'");
            if($rows->num_rows !== 0){
                $rows=mysqli_fetch_array(mysqli_query($connect,"select passwd from user_info where _name='{$_POST['name']}'"),MYSQLI_ASSOC);
                if($rows['passwd'] == $_POST['passwd']){
                    setcookie("who_login_this",$_POST['name'],time()+60*60*23*7,"/",false,false);
                    header('location:./login.php');
                }
                else{
                    echo "<script>alert('密码错误')</script>";
                }
            } 
        }

        if(array_key_exists('file',$_FILES)){
        $rows=mysqli_query($connect,"select * from picture_space order by id_ desc limit 1");
        $row=mysqli_fetch_array($rows, MYSQLI_ASSOC); 
        $index=$row['id_']+1;
        if($_FILES["file"]["size"] < 204800){
            //递归命名图片文件名
            if($_FILES["file"]["size"] < 204800){
            function queryId(){
                global $index;
                        if(file_exists("./img/${index}")){
                            $index++;
                            queryId();
                        }
                        else{
                            move_uploaded_file($_FILES["file"]["tmp_name"],"./img/${index}");    
                        }
            }
            queryId(); 
            }
        }}

        if(array_key_exists('who_login_this',$_COOKIE)){
                    $who=$_COOKIE['who_login_this'];
                    echo " <form action='./login.php' method='post' id='sign'> 
                holle,{$who}  <a href='./login.php?exit=1'>[退出登录]</a>! 
                <br>
                    <input type='text' name='title' class='title' placeholder='标题'>
                    <textarea name='desc'>
                        为这个照片添加点什么...
                    </textarea>
                    <input id='file' type='file'>
                    <input type='submit' name='create' value='发布'>
                </form>";
                }
                else{
            echo " <form action='./login.php' method='post' id='login'>
                <h1>Sign Jack & mary's pictures</h1>
                <input type='text' name='name' placeholder='mary'>
                <input type='password' name='passwd' placeholder='xxx'>
                <input type='submit' name='login' value='Login'>
                <br>
                <br>
                <a href='./sign.php'>注册账号?</a><a href='./'> | exit</a> 
                </form>";
        }
?>






        
    </div>
    <script>
    $=(ele)=>{
        return document.querySelectorAll(ele)
    }        
    let c =1
    let s=setInterval(() => {
        let img=document.createElement('img')
        img.src=`./img/${c}`
        $('.left-box')[0].appendChild(img)
        if(c==5){
            clearInterval(s)
        }
        c++
    }, 1000);
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

    function upload_(ele){
        var file = ele.files[0];
        var formdata = new FormData();
        formdata.append("file",file);
        var xhr = new XMLHttpRequest();
        xhr.open("post","./login.php");
        xhr.send(formdata);
        xhr.upload.onprogress=(e)=>{
            console.log(e);
        }
        }
    document.getElementById('file').addEventListener("change",function (){
        upload_(document.getElementById('file'))
    });
    </script>
</body>
</html>