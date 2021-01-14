<?php
        if(isset($_COOKIE['who_login_this'])){
            $conn = mysqli_connect ("localhost","root","123","dbrepair");
            $row=mysqli_query($conn,"select * from tbuser where  username='{$_COOKIE['who_login_this']}'");
            $r=mysqli_fetch_assoc($row);
            if($r['isadmin'] == 1){
                mysqli_query($conn,"delete from repair where id_={$_GET['id']}
                ");
                header('location:./index.php');
            }
        }
?>