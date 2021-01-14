<?php
    if($_COOKIE && array_key_exists('who_login_this',$_COOKIE)){
        $connect=mysqli_connect("chatjs.top","root","b");
        mysqli_select_db( $connect, 'public' );
        mysqli_query($connect,"set names utf8");
        $result=mysqli_query($connect,"select * from linklist where _name='{$_COOKIE['who_login_this']}'");
        echo "{\"name\":\"{$_COOKIE['who_login_this']}\",\"linkList\":[";
        $i=1;
            while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
                if($i!==$result->num_rows){
                     echo "\"{$row['links']}\",";
                }
               else{
                echo "\"{$row['links']}\"";
               }
                $i++;
            }
        echo "]}";
    }
?>