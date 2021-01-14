<?php
        $connect=mysqli_connect("chatjs.top","root","b");
        mysqli_select_db( $connect, 'public' );
        mysqli_query($connect,"set names utf8");
        $data=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);

        if(isset($data->emaile)){
        $data->emaile=addslashes($data->emaile);
        $data->name=addslashes($data->name);
        $data->passwd=addslashes($data->passwd);
        $data->passwdagain=addslashes($data->passwdagain);
        if($data->passwdagain == $data->passwd){
        $result=mysqli_query($connect,"insert into user_info(_name,passwd,emaile) values ('{$data->name}','{$data->passwd}','{$data->emaile}')");
        setcookie("who_login_this",$data->name,time()+60*60*23*120,"/");
        echo "{\"status\":\"{$result}\"}";            
        }}else{
            $result= mysqli_query($connect,"select passwd from user_info where _name='{$data->name}'");
            $row=mysqli_fetch_array($result);
            if($result->num_rows == 1){
                if($row['passwd'] == $data->passwd){
                    setcookie("who_login_this",$data->name,time()+60*60*23*120,"/");
                    echo "{\"status\":\"1\"}";
                }
            }
        }
?>