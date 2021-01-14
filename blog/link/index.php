<?php
    if($_COOKIE && array_key_exists('who_login_this',$_COOKIE)){
        $data=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);   
        $connect=mysqli_connect("chatjs.top","root","b");
        mysqli_select_db( $connect, 'public' );
        mysqli_query($connect,"set names utf8");             
        if(isset($data->delete)){
            $data->delete=addslashes($data->delete);
            $result=mysqli_query($connect,"delete from linklist where links='{$data->delete}'");
            echo "{\"status\":\"{$result}\"}";  
        }
        else{
        $data->link=addslashes($data->link);
        $result=mysqli_query($connect,"insert into linklist(_name,links) values ('{$_COOKIE['who_login_this']}','{$data->link}')");
        echo "{\"status\":\"{$result}\"}";            
        }
    }
?>