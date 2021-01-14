<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.5">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>没有拉姆</title>
  <script src="./showdown.min.js"></script>
  <link href="./style.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <h1 id="title">#标题</h1>
  <form action='/blog/php-processor/db.php' method='post' >
<?php
if(array_key_exists('action',$_GET) && $_GET['action'] == 'update' ){
    $connect=mysqli_connect("chatjs.top","root","b");
    mysqli_select_db( $connect, 'blog' );
    mysqli_query($connect,"set names utf8");
    $retval=mysqli_query($connect,"select * from blog where id={$_GET['id']}");
    $row = mysqli_fetch_array($retval, MYSQLI_ASSOC);
    echo "<input  type='text' style='display:none;' name='update' value='{$_GET['id']}'>";
  }
?>  
  <h4><a href="https://github.com/showdownjs/showdown/">来自:showdown.js </a>
    <span class="edit-right-col">
      标签:
      <select id="edit-tag" name='b_tag'>
        <option>vue</option>
        <option>javascript</option>
        <option>mobie-app</option>
        <option>html5</option>
        <option>angular</option>
        <option>linux</option>
      </select>
      发布:
      <button class="focus" id="submit" action='submit'>提交</button>
    </span>
  </h4>
  <br>
  <textarea id="edit" spellcheck="false" name='content_text'><?php
    if(isset($row) && $row['content_text']){
    echo $row['content_text'];
  }
    ?></textarea>
  <div id="result">
  </div>
  <textarea style='display:none;' name='content_html' id='content_html'>
  </textarea>
  <input style='display:none;' type="text" name="title" id='i_title'>
 </form>
  <span>
    <div class="foot">
    <br>
    2020 大三上学期PHP期末大作业纪念<br>
    ©copy right<br>滇ICP备20005951号</div>
  </span>
  <script type="text/javascript">
    window.onload = () => {
      if (window.screen.height > window.screen.width) {
        document.getElementById("edit").style.width = "100%"
        document.getElementById("result").style.width = "100%"
      }
      var converter = new showdown.Converter()
      
      window.onkeyup = (e) => {
        document.getElementById("edit").focus()
        let html = converter.makeHtml(document.getElementById('edit').value)
        document.getElementById("result").innerHTML = html
        document.getElementById("content_html").value = html
        let title = document.getElementById("result").children[0].textContent
        document.getElementById("title").innerHTML = title
        document.getElementById("i_title").value = title
      }
    }
  </script>
</body>
</html>
