<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body class="page1">













<div>
    <?php
        $connect=mysqli_connect("chatjs.top","root","b");
        mysqli_select_db( $connect, 'public' );
        mysqli_query($connect,"set names utf8");
        $result=mysqli_query($connect,"select * from picture_space where id_={$_GET['id']}");
        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
                echo "<img src='./img/{$row['id_']}'></div><div><h1>{$row['title']}</h1><span>{$row['note']}</span></div>";
            } 
    ?>












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