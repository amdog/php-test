<?php
header("content-type:text/html;charset=utf-8"); 
$connect=mysqli_connect("chatjs.top","root","b");
mysqli_select_db( $connect, 'public' );
mysqli_query($connect,"set names utf8");
function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
{
  static $recursive_counter = 0;
  if (++$recursive_counter > 1000) {
    die('possible deep recursion attack');
  }
  foreach ($array as $key => $value) {
    if (is_array($value)) {
      arrayRecursive($array[$key], $function, $apply_to_keys_also);
    } else {
      $array[$key] = $function($value);
    }
  
    if ($apply_to_keys_also && is_string($key)) {
      $new_key = $function($key);
      if ($new_key != $key) {
        $array[$new_key] = $array[$key];
        unset($array[$key]);
      }
    }
  }
  $recursive_counter--;
}
function object_to_array($obj){  
    if(is_array($obj)){  
        return $obj;  
    }  
    $_arr = is_object($obj)? get_object_vars($obj) :$obj;  
    foreach ($_arr as $key => $val){  
    $val=(is_array($val)) || is_object($val) ? object_to_array($val) :$val;  
    $arr[$key] = $val;  
    }  
    return $arr;  
} 
function JSON($array) {
    arrayRecursive($array, 'urlencode', true);
    $json = json_encode($array);
    return urldecode($json);
}
if($_GET && array_key_exists('page',$_GET)){
    $page=$_GET['page']*8;
    $page_=($_GET['page']-1)*8;
    $sql="select * from all_maile  order by id_maile DESC limit {$page_},{$page} ";
    $rows=mysqli_query($connect,$sql);
        $all=array(); 
        $i=0; 
        while($row=mysqli_fetch_array($rows,MYSQL_ASSOC)){ 
            $all[$i]=$row;
            $i++;
        } 
    echo JSON(object_to_array($all));
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $data=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
    if($data->action == "filter"){
        $sql="select * from all_maile where send_time between '{$data->intervalList[0]}-{$data->intervalList[1]}-{$data->intervalList[2]} 00:00:00' and '{$data->intervalList[3]}-{$data->intervalList[4]}-{$data->intervalList[5]} 00:00:00'";
        $rows=mysqli_query($connect,$sql);
        $all=array(); 
        $i=0; 
        while($row=mysqli_fetch_array($rows,MYSQL_ASSOC)){ 
            $all[$i]=$row;
            $i++;
        } 
        echo JSON(object_to_array($all));
    }
    if($data->action == "search"){
        $sql="select * from all_maile where message_content like  '%%{$data->keyWords}%%' order by id_maile desc";
        $rows=mysqli_query($connect,$sql);
        $all=array(); 
        $i=0; 
        while($row=mysqli_fetch_array($rows,MYSQL_ASSOC)){ 
            $all[$i]=$row;
            $i++;
        } 
        echo JSON(object_to_array($all));
    }
    if($data->action == 'delete'){
        foreach($data->checkedList as $k=>$v){ 
            $tmp=$k;
            $sql="delete from all_maile where id_maile={$v}";
            $target=mysqli_query($connect,$sql);
        } 
        echo "success";
    }
    if($data->action == 'response'){
      $text=addslashes($data->resMessage);
      $sql="update all_maile set response_content='{$text}'";
      $target=mysqli_query($connect,$sql);
      echo '1'
    }
}
?>