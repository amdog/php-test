<!doctype html>
<html>
<head>
<title>php程序设计实验报告</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=480, user-scalable=yes">
       <script type="text/javascript" src="jQuery.js"></script>
       <link rel="stylesheet" type="text/css" href="bootstrap.css">
    </head>
<body>
<script type="text/javascript" src="jQuery.js"></script>
<br>
<br>
<img src="https://imdog.gitee.io/unit/logo.png"><br>
<kbd>php --version=5.0</kbd> <kbd>git clone https://github.com/amdog/php-test.git</kbd>
<br>
<br>
标签:<span class="badge-danger col-1 badge-pill inline">数字媒体技术</span><span class="badge-warning col-1 badge-pill inline">php实验报告</span><span class="badge-info col-1  badge-pill inline">鲁志春</span>
<br>

<br><br>
<div class="contianer" style="position:sticky;top:30px;">
<a href="#one" class=" alert alert-primary">实验一</a>
<a href="#two" class=" alert alert-primary">实验二</a>
<a href="#three" class=" alert alert-primary">实验三</a>
<a href="#fore" class=" alert alert-primary">实验四</a>
<a href="#five" class=" alert alert-primary">实验五</a>
</div>
<br>
<br><br>
<h3 class="float-left">#实验一</h3><br>
<br>安装php IDE 以及wamp php集成环境[略]
<br><br>
<div class="contianer" id="one"> 
<h3 class="float-left">#实验二</h3>
<br>
<br>
<table class="table table-striped table-bordered table-hover">
<thead class="thead "><tr><td>操作说明</td><td>结果</td></tr></thead>
<?php 
$varNum=123;
echo "<tr><td>使用 var_dump function </td> <td>".var_dump($varNum)."没有输出</td><tr>";
echo "<tr><td>使用 intval function</td> <td>".intval($varNum)."</td><tr>";
echo "<tr><td>使用 floatval function </td>  <td>".floatval($varNum)."</td><tr>";
echo "<tr><td>使用settype function </td> <td>".settype($varNum,"string")."</td><tr>";
$var = "hello";
echo "<tr><td>转换 boolean</td> <td>".(boolean)$var."</td><tr>";
echo "<tr><td>转换 int</td> <td>".(integer)$var."</td><tr>";
echo "<tr><td>转换 float type </td> <td>".(float)$var."</td><tr>";
$var1=2;
$var2=5;
$var3=1;
$result=0;
for($i=0;$i<3;$i++){
	if($var1 > $var2){
		$var4=$var1;
		$var1=$var2;
		$var2=$var4;
	}
	if ($var2 > $var3) {
		$var5=$var2;
		$var2=$var3;
		$var3=$var5;
	}
}
echo "<tr><td>排序 2 5 1</td> <td>".$var1.$var2.$var3."</td><tr>";
$r1=0;
$k=1;
do{
if($k%2 !== 0){
		$r1=$r1+$k;
	}
$k++;
}while($k<100);
echo "<tr><td>使用do...while计算1+.....99</td> <td>".$r1."</td><tr>";
$r2=0;
$l=1;
while ($l < 100) {
	if($l%2 !== 0){
		$r2=$r2+$l;
	}
	$l++;
}
echo "<tr><td>使用while计算1+.....99</td> <td>".$r2."</td><tr>";
$r3=0;
for($j=1;$j<100;$j++){
	if($j%2 !== 0){
		$r3=$r3+$j;
	}
}
echo "<tr><td>使用for计算1+.....99</td> <td>".$r3."</td><tr>";
?>
</table>
</div>


<div id="three">
<h3 class="float-left">#实验三</h3><br><br>
<table class="table table-striped table-bordered table-hover">
<thead class="thead "><tr><td>操作说明</td><td>结果</td></tr></thead>
<tbody>
<tr>
<td>使用foreach遍历[一周]</td>
<td>
<?php
 //使用[]定义
$arry[0]="星期一";
$arry[1]="星期二";
$arry[2]="星期三";
$arry[3]="星期四";
$arry[4]="星期五";
$arry[5]="星期六";
$arry[6]="星期日";
 foreach ($arry as $key => $value) {
  	echo $value;
  } 
?></td>
</tr>

<tr>
<td>
print_r打印数组[一周]
</td>
<td>
<?php 
$array= array(0=>'星期一', 1=>'星期二',2=>'星期三',3=>'星期四',4=>'星期五',5=>'星期六',6=>'星期日');
print_r($array);
?>
</td></tr>


<tr>
<td>
print_r打印数组
</td>
<td>
<?php 
$array= array(
array('name'=>'张三','sex'=>'男','age'=>'30','height'=>'180CM','weight'=>'50Kg'),
array('name'=>'李四','sex'=>'女','age'=>'28','height'=>'>170CM','weight'=>'60Kg'),
array('name'=>'王五','sex'=>'男','age'=>'20','height'=>'169CM','weight'=>'80Kg'),
array('name'=>'赵六','sex'=>'女','age'=>'28','height'=>'170CM','weight'=>'50Kg'),);
print_r($array);
?>
</td></tr>


<tr>
<td>使用foreach遍历</td>
<td>
<?php
$array= array(
	array('name'=>'张三','sex'=>'男','age'=>'30','height'=>'180CM','weight'=>'50Kg'),
	array('name'=>'李四','sex'=>'女','age'=>'28','height'=>'>170CM','weight'=>'60Kg'),
	array('name'=>'王五','sex'=>'男','age'=>'20','height'=>'169CM','weight'=>'80Kg'),
	array('name'=>'赵六','sex'=>'女','age'=>'28','height'=>'170CM','weight'=>'50Kg'),);
 foreach ($array as $key => $value) {
	foreach ($value as $k => $v) {
  	echo $v;
	} 
  } 
?></td>
</tr>


<td>合并数组12345，67890</td>
<td>
<?php
$arr1 = array(1, 2, 3, 4, 5);
$arr2 = array(6, 7, 8, 9, 0);
$result = array_merge($arr1, $arr2);
print_r($result);
echo "</td></tr>";
echo "<tr><td>使用array_push添加元素123</td>";
echo "<td>";
echo array_push($result,"a","b","c");
echo "</td>";
echo "</tr>";
?>
<tr>





<td>找出最大值，最小值，和，平均数</td>
<td>
<?php
$ar=array(
array(12,13,556,656,78),
array(12,13,56,66,78),
array(12,13,55,6,78),
array(12,83,54,696,78),
array(12,73,56,6,78),
);
$max=0;
$min=999999;
$sub=0;
function cal($arr){
	global $max,$min,$sub;
	foreach ($arr as $key => $value) {
			if(is_array($value)){
				cal($value);//递归
			}
			else{
				if($max < $value){
					$max=$value;
				}
				if($min > $value){
					$min=$value;
				}
				$sub+=$value;
			}
		}
}
cal($ar);
$rang=$sub/25;
echo "最大值:$max;最小值$min;和$sub;平均数$rang;";
?>
</td>
</tr>
</tbody>
</table>
</div>


<h3 class="float-left">#实验四,六</h3>
<br>
<br>
<br> 
<div id="fore" class="container">
<form method="get"  action="/old/login.php"  id="login-form">
<input type="text" name="name"  class="col-6 offset-3" id="name" placeholder="用户名">
<br><br>
<input type="password" class="col-6 offset-3" name="password" id="password" placeholder="密码">
<br>
<br>
<input type="submit"  class="btn btn-info col-6 offset-3" id="submit" value="登录" >
<br>
<br>
<a class="offset-3 text-info" id="logup">立即注册</a>
<br>
<br>
</form>
<?php
if(array_key_exists('who',$_COOKIE)){
	echo "<div class='alert alert-success'>欢迎{$_COOKIE['who']}<a class='badge-pill badge-danger offset-10' 
	href='/old/logout.php'>注销</a></div> <script type='text/javascript'>
	$(window).load(()=>{
		$('#login-form').css('display','none')
	})
	</script>";
}
?>
        <form class="form-group" action="/old/logup.php" id="logup-form"  method="post" style="display:none">
			<input type="text" name="name"  class="form-control" placeholder="用户名">
			<br>
			<input type="password" name="password"  class="form-control" placeholder="输入密码">
			<br>
			<input type="password" class="form-control" name="passwordAgain" placeholder="再输入一次"> 
			<br>
			上传头像
			<br>
			<input type="file" name="file" class="form-control">
			<br>
			<input  type="submit"  class="btn btn-info col-6 offset-2 form-control "  value="注册">
			<input  type="button" id='reset' class="btn btn-secondary col-2  form-control "  value="重置">
		</form>
	<script type='text/javascript'>
	$(window).load(()=>{
		$('#logup').click(()=>{
			$('#logup-form').css('display','block')
			$('#login-form').css('display','none')
		})
		$('#reset').click(()=>{
			window.location.href="/old"
		})
	})
	</script>
<br>
<br>
<br>

<h2>#实验五</h2>
<br>
<form method="post" action="/old/" class='form-group'>
	<input class="form-control" type="text" name="value1">
	<br>
	<input class="form-control" type="text" name="value2">
	<br>
	<input class="form-control" type="text" name="value3">
	<br>
	<input class="form-control" type="submit" name='caculate'>
</form>
<?php
function caculate_3($v1,$v2,$v3){
	if($v1+$v2>$v3 && $v1+$v3>$v2 && $v2+$v3>$v2){
		$t=($v1+$v2+$v3)/2;
		$re=sqrt($t*($t-$v1)*($t-$v3)*($t-$v3));
		echo "面积:{$re}";
	}
	else{
		echo "<div class='alert alert-danger'>不能构成三角形</div>";
	}
}
if($_POST && array_key_exists('caculate',$_POST)){
	caculate_3($_POST['value1'],$_POST['value2'],$_POST['value3']);
}
?>
<form method="post" action="/old/" class='form-group'>
		<textarea  class="form-control" name="text_long" rows="3" height='300'></textarea>
		<br>
		<input class="form-control" type="submit" name="submit_long_text">
</form>
<?php
if($_POST && array_key_exists('submit_long_text',$_POST)){
echo "截取前十个字符:".mb_substr($_POST['text_long'],0,10,'UTF-8')."......";
}
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

</div>
</body>
</html>