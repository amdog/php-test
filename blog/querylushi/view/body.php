<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>炉啊炉攻略</title>
</head>
<body>
    <?php
    if($_COOKIE && array_key_exists('who_login_this',$_COOKIE)){
        echo $_COOKIE['who_login_this'].'你好';
    }
    ?>
    <a href="./create.php">新套路</a>
    <?php
    $connect=mysqli_connect("chatjs.top","root","b");
    mysqli_select_db( $connect, 'public' );
    mysqli_query($connect,"set names utf8");
    $result=mysqli_query($connect,"select * from query_lushi");
        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo $row['content_html'],$row['_date'],$row['_who'];
        }
    ?>
</body>
</html>