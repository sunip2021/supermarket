<?php
    
    function check_if_added_to_cart($item_id){
        //session_start();    
        require 'connection.php';
        $user_id=$_SESSION['id'];
        $sql="select * from users_items where item_id='$item_id' and user_id='$user_id' and status='Added to cart'";
        $result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
        $num=mysqli_num_rows($result);
        if($num>=1)return 1;
        return 0;
    }
?>