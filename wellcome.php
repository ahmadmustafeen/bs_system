<?php
    session_start();
    require_once('./connection.php');

    if(isset($_SESSION['User']))
    {
        $username = $_SESSION['User'];
        $user_level_Q  = mysqli_query($con,"SELECT `user_type` FROM `login_info` WHERE username = '$username'");
        while($row = mysqli_fetch_assoc($user_level_Q)){
            $user_level = $row['user_type'];
        }
        if($user_level == 1){
        header("location:./admin/");
        }
         if($user_level == 2){
        header("location:./executive/");
        }
        if($user_level == 3){
            header("location:./teacher/");
        }
    }
    else
    {
        header("location:index.php");
    }


?>
<html>
<h1> <a href="dashboard/index.php">DASHBOARD</a> </h1>

</html>