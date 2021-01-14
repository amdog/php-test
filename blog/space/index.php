<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jack&mary</title>
    <link rel="stylesheet" href="./sty.css">
</head>
<body>
    <div class="body">
        <div id="main">
            <iframe class="page" src="./page/login.php"       marginwidth="0" marginheight="0" frameborder='0' scrolling='no' sendbox='' seamless></iframe>
            <iframe class="page" src="./page/page.php?id=1"  marginwidth="0" marginheight="0" frameborder='0' scrolling='no' sendbox='' seamless></iframe>
            <iframe class="page" src="./page/page.php?id=2"  marginwidth="0" marginheight="0" frameborder='0' scrolling='no' sendbox='' seamless></iframe>
            <iframe class="page" src="./page/page.php?id=3"  marginwidth="0" marginheight="0" frameborder='0' scrolling='no' sendbox='' seamless></iframe>
            <iframe class="page" src="./page/page.php?id=4"  marginwidth="0" marginheight="0" frameborder='0' scrolling='no' sendbox='' seamless></iframe>
            <iframe class="page" src="./page/page.php?id=5"  marginwidth="0" marginheight="0" frameborder='0' scrolling='no' sendbox='' seamless></iframe>
        </div>
    </div>
</body>
<script>



    <?php
            $connect=mysqli_connect("chatjs.top","root","b");
            mysqli_select_db( $connect, 'public' );
            mysqli_query($connect,"set names utf8");
            $rows=mysqli_query($connect,"select * from picture_space order by id_ desc limit 1");
            $max=mysqli_fetch_array($rows, MYSQLI_ASSOC);
            $rows=mysqli_query($connect,"select * from picture_space order by id_ asc limit 1");
            $min=mysqli_fetch_array($rows, MYSQLI_ASSOC);
            echo "var target=-{$max['id_']};
            var scroll=-{$min['id_']};
            ";
    ?>



    
    var startTime = new Date().getTime() 
    var endTime = 0;
    var endscroll=target+2;
    var tmp=scroll;
    $=(ele)=>{
        return document.querySelectorAll(ele)
    }
    function scrollNext(dir){
    dir>0? scroll--:scroll++;
    console.log(scroll,tmp,target); 
    scroll >= tmp? scroll=-1:null;  
    if(scroll <= tmp && scroll >= target){
            $('#main')[0].style.top=`${(scroll) * window.document.documentElement.clientHeight}px`; 
            scroll == target? scroll=target+1:null       
            if( scroll == endscroll){
                endscroll--
                 var ele=$('iframe')[1]
                ele=ele.cloneNode(false)
                ele.src=`./page/page.php?id=${-(endscroll)}`
                $('#main')[0].appendChild(ele)
            } 
        }endTime=new Date().getTime() 
    }
</script>
</html>