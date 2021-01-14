<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>db</title>
</head>
<body>
<?php
$connect=mysqli_connect("chatjs.top","root","b");
mysqli_select_db( $connect, 'blog' );
mysqli_query($connect,"set names utf8");

function isLogin(){
/*     function get_data($url){
        $headers = array("authorization: token {$_COOKIE['access_token_github']}",'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $data = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return array($httpCode,$data);
      };

      
      $userInf=json_decode(get_data('https://api.github.com/user')[1]); */
    if(isset($_COOKIE['who_login_this']) && $_COOKIE['who_login_this'] == 'amdog'){      
        return 1;
      }
    else{
            echo "ERROR_DENIED";
    }
}

if($_POST && array_key_exists('title',$_POST)){
    if(isLogin() == 1){
        $html=addslashes($_POST['content_html']);
        $text=addslashes($_POST['content_text']);
            $retval = mysqli_query( $connect,"insert into blog(title,content_text,content_html,b_tag) values ('{$_POST['title']}','{$text}','{$html}','{$_POST['b_tag']}')");
            if($retval == '1'){
                header("location:/blog/");
            }
            else{
                echo "login:NO";
            }
            if($_POST && array_key_exists('update',$_POST)){
               mysqli_query($connect,"delete from blog where id={$_POST['update']}");
            }
    }
}


if($_POST &&  array_key_exists('token',$_POST)){
    setcookie("token",$_POST['token'],time()+60*60*23,"/blog/");
    echo 'SUCCESS_OK';
}

if($_POST &&   array_key_exists('subscri',$_POST)){
    mysqli_query($connect,"set names utf8");
    if(isset($_COOKIE['who_login_this'])){
    $text=addslashes($_POST['note']);
    $r=mysqli_query($connect,"insert into note(who_create,content,blog_id) values ('{$_COOKIE['who_login_this']}','{$text}','{$_POST['id']}')");     
    if($r == 1) {
        header("location:../js-css-html/details.php?id={$_POST['id']}");
    }
    }
    else{
        header('location:../js-css-html/login.php');
    }
}

if($_GET &&  array_key_exists('action',$_GET)){
    if($_GET['action'] == 'delete' && isLogin() == 1){
    mysqli_query($connect,"delete from blog where id={$_GET['id']}");
	header("location:/blog/");
    }
}

?>    
</body>
</html>



