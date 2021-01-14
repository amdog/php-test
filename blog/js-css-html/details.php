<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<?php
    $connect=mysqli_connect("chatjs.top","root","b");
    
    mysqli_select_db( $connect, 'blog' );

    mysqli_query($connect,"set names utf8");
    $retval = mysqli_query( $connect,"select * from blog where id={$_GET['id']}");
    $row = mysqli_fetch_array($retval, MYSQLI_ASSOC);
    $new_weight=$row['b_weight']+1;
    $trend_row=mysqli_query($connect,"select * from blog order by b_weight desc limit 16");
    $r=mysqli_query( $connect,"update blog set b_weight={$new_weight} where id={$_GET['id']}");
    echo "<script>let id={$_GET['id']}</script>";
    echo "<title>{$row['title']}</title>";
    echo "<meta keywords='{$row['title']}' />";
?>

<link href="./style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="./styles/rainbow.css" />
<script src="./highlight.pack.js" type='text/javascript'></script>
<script type='text/javascript'>hljs.initHighlightingOnLoad();</script>
</head>
<body>
  <div id="body">
<?php
/* if($_COOKIE && array_key_exists('access_token_github',$_COOKIE)){
  function get_data($url){
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
  $userInf=json_decode(get_data('https://api.github.com/user')[1]);
} */
?>
<div class="float-right" id="floatRight">
      <div id="status">
        <br>
        <span class="login-status"><a href="./login.php">[
          <?php
          if(isset($_COOKIE['who_login_this'])){
            echo $_COOKIE['who_login_this']."<a href='../index.php?exit=1'>[退出登录] </a>";
          }
          else{
            echo "登录";
          }
          ?>
          ]</a></span>
        <form method="get" action="/blog/index.php">
        <div class="search">
          <input type="text" name='word'>
          <button  type='submit' >搜索</button>
        </div>          
        </form>
      </div>
      <div>
      <a href='https://weibo.com/'>
        <img src="../img/weibo.svg" alt="weibo">
      </a>&nbsp;
      <a href='https://github.com/amdog'>
        <img src="../img/github.svg" alt="github">
      </a>
      </div>
      <br>
      <div id="write">
        <img src="../img/write.svg" alt="write">
        <a href="./js-css-html/edit.php">写文章</a>
      </div>
      <br>
      <div>
        <span class="myfocus">
          浏览量<br>
          <?php
          $row_=mysqli_query($connect,"select sum(b_weight) from blog");
          echo mysqli_fetch_array($row_,MYSQLI_ASSOC)['sum(b_weight)']/10000;
          ?>w+次
        </span>
        <span class="myfocus">创作了
          <br>
          <?php
          $row_=mysqli_query($connect,"select count(*) from blog");
          echo mysqli_fetch_array($row_,MYSQLI_ASSOC)['count(*)'];
          ?>篇
        </span>
      </div>
      <br>
      <div id="trends">
        <ul>
        <br>
          <?php
            while($row = mysqli_fetch_array($trend_row, MYSQLI_ASSOC)){
            $sjb=mb_substr($row['title'],0,15,"UTF-8");
            echo "<a href='./details.php?&id={$row['id']}'>-{$sjb}</a>...</br>";
            }
          ?>
        </ul>
      </div>
      <br>
      <span>
        <img src="../img/tag.svg">
        标签：<span class="badge badge-pill badge-danger">angular</span>
        <span class="badge badge-pill badge-warning">javascript</span>
        <span class="badge badge-pill badge-primary">html5</span>
        <span class="badge badge-pill badge-secondary">mobie-app</span>
        <span class="badge badge-pill badge-info">linux</span>
        <span class="badge badge-pill badge-success">vue</span>
      </span>
    </div>

    <div class='main' id="main">
    <br>
    <h1>
        <?php
         mysqli_query($connect,"set names utf8");
        $retval = mysqli_query( $connect,"select * from blog where id={$_GET['id']}");
        $row = mysqli_fetch_array($retval, MYSQLI_ASSOC);
        echo $row['title'];
        ?>
    </h1>
    <span class="item-date">发布时间:
    <?php
        echo $row['b_date'];
    ?>
    作者:没有拉姆
    阅:
    <?php

        echo $row['b_weight'];
    ?></span>
    <br>
    <hr>
    <div class="content">
    <?php
        echo $row['content_html'];
    ?>  
    </div>
    <div class="bottom-control">
   <label>
 <?php
 switch ($row['b_tag']) {
     case 'vue':
         echo "<span class='badge badge-pill badge-success'>vue</span>";
     break;
     case 'angular':
        echo "<span class='badge badge-pill badge-danger'>angular</span>";
    break;
    case 'html5':
        echo "<span class='badge badge-pill badge-primary'>html5</span>";
    break;
    case 'javascript':
        echo "<span class='badge badge-pill badge-warning'>javascript</span>";
    break;
    case 'mobie-app':
        echo "<span class='badge badge-pill badge-secondary'>mobie-app</span>";
    break;
    case 'linux':
        echo "<span class='badge badge-pill badge-info'>linux</span>";
    break;
 }
        ?>
        </label>
        <script type="text/javascript">
        window.onload=()=>{
            if (window.screen.height > window.screen.width) {
        document.getElementById("body").style.display = "block"
        document.getElementById("body").style.width = "700px"
        document.getElementsByClassName("float-right")[0].style.width = "100%"
        document.getElementsByClassName("float-right")[0].style.margin = "0 auto"
        document.getElementsByClassName("float-right")[0].style.position = "relative"
      }
        }
            function delete_(){
                window.location.href='/blog/php-processor/db.php?action=delete&id='+id
            }
            function update_(){
                window.location.href='/blog/js-css-html/edit.php?action=update&id='+id
            }
            function share_(){
                window.location.href='http://jianshu.com'
            }
            function goHome_(){
                window.location.href='../'
            }
        </script>

<?php

if(isset($_COOKIE['who_login_this']) && $_COOKIE['who_login_this'] == 'amdog'){
  echo "        <label onclick='delete_()'>
            <img src='../img/delete.svg' >
            删除
        </label>
        <label onclick='update_()'>
            <img src='../img/edit.svg' >
            修改
        </label>";
}
?>
        <label onclick='share_()'>
            <img src="../img/share-ditails.svg">
            分享
        </label>

        <label onclick='goHome_()'>
            <img src="../img/home.svg">
            首页
        </label>

    </div>

      </div>
</div>    
<div class='subscribe'>
    <form action="../php-processor/db.php" method='post'>
    <textarea name='note'>
    留下你的评论...
    </textarea>
      <input type="submit" name='subscri' value='发表'>
      <?php
       echo "<input type='text' value='{$_GET['id']}' name='id' style='display:none;'>"
      ?>
    </form>
  </div>

  <?php

mysqli_query($connect,"set names utf8");
            $row_=mysqli_query($connect,"select * from note where blog_id={$_GET['id']} order by create_time desc");
              while($row = mysqli_fetch_array($row_, MYSQLI_ASSOC)){
                echo "  <div class='note'> <span>{$row['who_create']}</span>
                      <span>{$row['content']}</span>
                    <span>发表于{$row['create_time']}</span>
                    </div>";
            }
  ?>

  <style>
.subscribe > form{
  z-index: 100000;
  width: 1000px;
  height: 250px;
  margin: 0 auto;
  display:flex;
  justify-content:space-around;
  align-items: center;
}
.subscribe > form > textarea{
  width: 600px;
  height: 100px;
  border: solid 1px #aaaaaa;
  background-color: #f9f9f9;
  border-radius: 9px;
}
.subscribe > form > input{
  width: 100px;
  height: 30px;
  letter-spacing: 13px;
  background-color: tomato;
  color:#fff;
  outline: none;
  border-radius: 3px;
  border: 0;
}
.note{
  width: 1000px;
  height: 100px;
  margin: 0 auto;
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  margin-top:30px;
}
.note>span:nth-child(2){
  width: 600px;
  display: block;
  color: #aaaaaa;
  border-radius: 9px;
  height: 100px;
  background-color: #f4f4f4;
}
.note>span:nth-child(3){
  color: #aaaaaa;
}
  </style>
<div class="foot foot-details" >
2020 大三上学期PHP期末大作业<br>
©copy right<br>滇ICP备20005951号</div>
</body>
</html>
