<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新建一个套路</title>
</head>    
<style>
    form{
        display: block;
        width: 60vw;
        min-height: 100vh;
        margin: 0 auto;
    }
        input{
            outline: none;
        }
        textarea{
            width: 50vw;
            height: 30vh;
        }
         input[type='file']{
             width: 300px;
             background: none;
             text-align: center;
             height: 26px;
             border: #00a5e2 dotted 2px;
         }
        input[type='text']{
            border: 0;
            border-bottom: 1px #00a5e2 solid;
            outline: none;
            width: 400px;
        }
        input[type='button'] {
            width: 200px;
            height: 30px;
            letter-spacing: 5px;
            background: #00a5e2;
            border-radius: 6px;
            color: #fff;
            box-shadow: 0 0 1px 1px #00a5e2;
            border: 0;
        }
        input[type='button']:hover{
            background: #68c8eb;
        }
        input[type='submit']{
            width: 200px;
            height: 30px;
            letter-spacing: 5px;
            border-radius: 6px;
            color: #fff;
            border: 0;
            background: #f89e35;
            box-shadow: 0 0 1px 1px #f89e35;
        }
        input[type='button']:hover{
            background: #68c8eb;
        }
        input[type='text']:focus{
            border-bottom: 1px #0b5874 solid;
        }
        body{
            margin: 0;
            width: auto;
            min-height: 100vh;
        }
    </style>
<body>
    <form action="./create.php" method="POST">
    <br>
    <?php
    $i=1;
    $content="";
    $connect=mysqli_connect("chatjs.top","root","b");
    mysqli_select_db( $connect, 'public' );
    mysqli_query($connect,"set names utf8");
    function eachFile(){
        global $content,$i,$connect;
        if(array_key_exists("ctitle{$i}",$_POST)){
            $tchild=$_POST["ctitle{$i}"];
            $cchild=$_POST["content{$i}"];
            $rows=mysqli_fetch_array(mysqli_query($connect,"select MAX(_id) from query_lushi where _who='{$_COOKIE['who_login_this']}'"),MYSQLI_ASSOC);
            $d_=$rows['MAX(_id)'];
            if(strlen($rows['MAX(_id)']) == 0){
                $d_=1;
            }
            $filename="./upload/{$_COOKIE['who_login_this']}{$d_}_{$i}.file";
            if(file_exists($filename)){
                $content="{$content}<h2>{$tchild}</h2><p>{$cchild}</p><img src='./upload/{$_COOKIE['who_login_this']}{$d_}_{$i}.file'>";
            }
            else{
                $content="{$content}<h2>{$tchild}</h2><p>{$cchild}</p>";
            }
            $i++;
            eachFile();
        }
        else{
            return $content;
        }
    }

    if(array_key_exists('file',$_FILES)){
        if(array_key_exists('who_login_this',$_COOKIE)){
            $rows=mysqli_fetch_array(mysqli_query($connect,"select MAX(_id) from query_lushi where _who='{$_COOKIE['who_login_this']}'"),MYSQLI_ASSOC);
            $id=$rows['MAX(_id)'];
            if(strlen($rows['MAX(_id)']) == 0){
                $id=1;
            }
            $index=1;
            if($_FILES["file"]["size"] < 204800){
            function queryId(){
                global $id,$index;
                        if(file_exists("./upload/{$_COOKIE['who_login_this']}{$id}_${index}.file")){
                            $index++;
                            queryId();
                        }
                        else{
                            move_uploaded_file($_FILES["file"]["tmp_name"],"./upload/{$_COOKIE['who_login_this']}{$id}_${index}.file");    
                        }
            }
            queryId(); 
            }
        }
    }

    if($_POST && array_key_exists('create',$_POST)){
        if( array_key_exists('who_login_this',$_COOKIE)){
            $name=$_COOKIE['who_login_this'];
            $content="<h1>{$_POST['title']}</h1>";
            if(strlen($_POST['title']) >0){
            eachFile(); 
            $content=addslashes($content);
            if(mysqli_query($connect,"insert into query_lushi(_who,content_html) values ('{$name}','{$content}')") == 1){
                header("location:./body.php");
            }
            }
        }
    }
    ?>
    <br>
    <br><br><br>
    <h2>*给你的套路起一个响亮的名字:<input type="text" name="title" ></h2>
    <div class="edit">
        <br>
        <br>
        <h3>*段落标题: <input type="text" name="ctitle1" > </h3>
        <textarea name="content1"></textarea>
        <br>
        <input type="file"  accept="image/*">
        <br>
        <br>
        <br><br>
    </div>
    <input type="button" value="+新建段落" id="new">
    <input type="submit" name='create' value="发布">
    <script>
        function upload_(ele){
        var file = ele.files[0];
        var formdata = new FormData();
        formdata.append("file",file);
        var xhr = new XMLHttpRequest();
        xhr.open("post","./create.php");
        xhr.send(formdata);
        }
        document.getElementsByTagName('input')[2].addEventListener("change",function () {
        upload_(document.getElementsByTagName('input')[2])
    });
        let i=1
        document.getElementById('new').addEventListener(('click'),(e)=>{
            i++
            let div=document.createElement('div')
            div.setAttribute('class','edit')
            div.innerHTML=`<br><br><h3>*段落标题: <input type="text" name="ctitle${i}" > </h3> <textarea name="content${i}">
            </textarea><br> <input type="file"   accept="image/*"><br><br><br>`
            div.children[5].addEventListener('change',()=>{upload_(div.children[5])})
            document.getElementById('new').parentElement.insertBefore(div,document.getElementById('new'));
        })
    </script>
</form>
</body>
</html>