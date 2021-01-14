
<?php
header("content-type:text/html;charset=utf-8"); 
$connect=mysqli_connect("chatjs.top","root","b");
mysqli_select_db( $connect, 'public' );
mysqli_query($connect,"set names utf8");
if($_GET && array_key_exists('id',$_GET)){
    $id=$_GET['id'];
    $sql="select * from diary_book where page_id={$id}";
    if($id=='last'){
        $sql="select * from diary_book order by page_id DESC limit 1";
    }
    mysqli_set_charset($connect,'utf8');
    $rows=mysqli_fetch_array(mysqli_query($connect,$sql),MYSQLI_ASSOC);
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
    //print_r(object_to_array($rows));
    echo JSON(object_to_array($rows)); 
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
        $rows=mysqli_query($connect,"select * from diary_info");
        $data=json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
        $rows=mysqli_fetch_array(mysqli_query($connect,"select * from  diary_info"),MYSQLI_ASSOC);
        if($rows['access_token'] == $data->token){
            if($rows['falid_count'] != 6){
                $text=addslashes($data->content);
                mysqli_query($connect,"update diary_info set falid_count=0 where id_='1'");
                mysqli_query($connect,"insert into diary_book(page_content) values ('{$text}')");
                echo 'success';
            }
            else{
                $count=$rows['falid_count']+1;
                mysqli_query($connect,"update diary_info set falid_count='{$count}' where id_=1");
                echo 'error,locking,';
            }
        }
        else{
            echo 'error token';
        }
    }
?>