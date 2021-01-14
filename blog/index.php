<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.5">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="keywords" content="没有拉姆博客,一个简陋的博客">
  <meta name="baidu-site-verification" content="code-GylTrxfZNe" />
  <title>没有拉姆</title>
  <link href="./js-css-html/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

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
}
if($_GET && array_key_exists('code',$_GET)){
header("Location:/blog");  
function http_post_json($url, $jsonStr)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($jsonStr)
        )
    );
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array($httpCode, $response);
}
function convertUrlQuery($query)
{
  $queryParts = explode('&', $query);
  $params = array();
  foreach ($queryParts as $param) {
    $item = explode('=', $param);
    $params[$item[0]] = $item[1];
  }
  return $params;
}
$url = "https://github.com/login/oauth/access_token";
$jsonStr=json_encode(array('client_id' => "Iv1.8eecfca7238fa79a", 'client_secret' => 'cce7c08be88349009bcbdb40840970f479f1f5c9', 'code' => $_GET['code']));
$access_token=convertUrlQuery(http_post_json($url, $jsonStr)[1])['access_token'];
} */

//setcookie('who_login_this',$access_token,time()+3600*24,'/');


?>
  <div id="body">
    <div class='main' id="main">
      <div class='about'>
        <img src="./img/hello.gif">
        <div class="introduce">
          <span class="name">没有拉姆</span>
          <br>
          <span>
            <img src="./img/about.svg" alt="about">
            世界上最后一只咸鱼前端</span><br>
          <img src="./img/work.svg" alt="work">
          <span class="work">/UI/设计/美工</span>
        </div>
      </div>
      <div class='nav'>
        <a href="./index.php">文章</a>
        <a href="./index.php?&h5=1">HTML5</a>
        <a href="/">工具</a>
      </div>
<?php
$connect=mysqli_connect("chatjs.top","root","b");
mysqli_select_db( $connect, 'blog' );
mysqli_query($connect,"set names utf8");
$trend_row=mysqli_query($connect,"select * from blog order by b_weight desc limit 16");
if($_GET && array_key_exists('page',$_GET)){
  $start=($_GET['page']-1)*10;
  $end=$_GET['page']*10;
  $sql="select * from blog order by id desc limit {$start},{$end}";
}
elseif ($_GET && array_key_exists('word',$_GET)) {
  $sql="select * from blog  where content_text like '%%{$_GET['word']}%%' order by id desc";
}
elseif ($_GET && array_key_exists('h5',$_GET)) {
  $sql="select * from blog where b_tag='html5' order by id desc";
}
else{
  $sql="select * from blog order by id desc limit 10";
}
$retval = mysqli_query( $connect,$sql);
if(isset($_GET['exit'])){
  setcookie("who_login_this",'d',time()-1,"/",false,false);
}
while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)){
    echo "
      <div class='item' >
        <img src='./img/hello.gif'>
        <a href='./js-css-html/details.php?&id={$row['id']}'>
        <div class='item-about'>
          <span class='item-name'>没有拉姆</span>
          <br>
          <span class='item-date'>{$row['b_date']} </span>";
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
    echo "<br>
          <span  class='item-content'>{$row['title']}</span>
        </div>
        </a>
        <lable onclick='toJianShu({$row['id']})'> <img src='./img/share.svg' alt='share'></lable>
      </div>
    ";
}
?>

 <div class="from-page">
        <?php
        if($_GET && array_key_exists('page',$_GET) || (array_key_exists('page',$_GET) && $_GET['page']!=1)){
          $thisPage=$_GET['page']-1;
          echo "<div><a href='/blog/index.php?page={$thisPage}'>上一页</a></div>";
        }
        else{
          echo "<div><a href='/blog/index.php?'>上一页</a></div>";
        }
        ?>

        <div class="page-counter">
        第
        <?php
        if($_GET && array_key_exists('page',$_GET)){
        echo $_GET['page'];
        }
        else{
          echo 1;
        }
        ?>页
        </div>

        <?php
        if($retval->num_rows==10){
          if($_GET && array_key_exists('page',$_GET)){
          $thisPage=$_GET['page']+1;
          echo "<div><a href='/blog/index.php?page={$thisPage}'>下一页</a></div>";
          }
          else{
            echo "<div><a href='/blog/index.php?page=2'>下一页</a></div>";
          }
        }
        else{
          echo "<div><a href='/blog/index.php?'>下一页</a></div>";
        }
        ?>
        </div>
    </div>

    <div class="float-right" id="floatRight">
      <div id="status">
        <br>
        <span class="login-status"><a href="./js-css-html/login.php">[
          <?php
          if(isset($_COOKIE['who_login_this'])){
            echo $_COOKIE['who_login_this']."<a href='./index.php?exit=1'>[退出登录] </a>";
          }
          else{
            echo "登录";
          }
          ?>
          ]</a></span>
        <form method="get" action="./index.php">
        <div class="search">
          <input type="text" name='word'>
          <button  type='submit' >搜索</button>
        </div>          
        </form>
      </div>
      <div>
      <a href='https://weibo.com/'>
        <img src="./img/weibo.svg" alt="weibo">
      </a>&nbsp;
      <a href='https://github.com/amdog'>
        <img src="./img/github.svg" alt="github">
      </a>
      </div>
      <br>
      <div id="write">
        <img src="./img/write.svg" alt="write">
        <a href="./js-css-html/edit.php">写文章</a>
      </div>
      <br>
      <div>
        <span class="myfocus">
          浏览量<br>
          <?php
          $row_=mysqli_query($connect,"select sum(b_weight) from blog");
          echo mysqli_fetch_array($row_,MYSQLI_ASSOC)['sum(b_weight)'];
          ?>+次
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
            echo "<a href='./js-css-html/details.php?&id={$row['id']}'>-{$sjb}</a>...</br>";
            }
          ?>
        </ul>
      </div>
      <br>
      <span>
        <img src="./img/tag.svg">
        标签：<span class="badge badge-pill badge-danger">angular</span>
        <span class="badge badge-pill badge-warning">javascript</span>
        <span class="badge badge-pill badge-primary">html5</span>
        <span class="badge badge-pill badge-secondary">mobie-app</span>
        <span class="badge badge-pill badge-info">linux</span>
        <span class="badge badge-pill badge-success">vue</span>
      </span>
    </div>
    
    <div class="foot">
    2020 大三上学期PHP期末大作业<br>
    <a href="http://www.beian.miit.gov.cn">
    ©copy right<br>滇ICP备20005951号</div></a>
  </div>
  <script type="text/javascript">
  function toJianShu(id){
    window.location.href='http://jianshu.com'
  }
    window.onload = () => {
      if (window.screen.height > window.screen.width) {
        document.getElementById("body").style.display = "block"
        document.getElementById("body").style.width = "700px"
        document.getElementsByClassName("float-right")[0].style.width = "100%"
        document.getElementsByClassName("float-right")[0].style.margin = "0 auto"
      }
    }
  </script>
</body>
</html>


