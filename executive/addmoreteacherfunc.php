<?php

require_once('../connection.php');
session_start();
date_default_timezone_set("Asia/Karachi");
if(isset($_SESSION['User']))
{
    $username = $_SESSION['User'];
    $user_level_Q  = mysqli_query($con,"SELECT `user_type` FROM `login_info` WHERE username = '$username'");
    while($row = mysqli_fetch_assoc($user_level_Q)){
        $user_level = $row['user_type'];
    }
    if($user_level != '2'){
        header('location:../wellcome.php');
    }


    $teachername = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $insert_teacher_name = "INSERT INTO `teacher`(`teacher_name`) VALUES ('$teachername')";

if($con -> query($insert_teacher_name)){
    $teacher_id = mysqli_insert_id($con);

    $insert_details = "INSERT INTO `usertype_3_info`(`username`, `user_displayname`, `user_email`, `user_number`, `user_teacherid`) VALUES ('$username','$teachername','email', '111', '$teacher_id')";
    if($con -> query($insert_details)){
    }

    // $pass = str_replace("_","",$username)."01";
    // $pwd = md5($password);
    $pwd = $password;
    $insert_login_cred = "INSERT INTO `login_info`(`username`, `user_password`, `user_type`, `user_first`) VALUES ('$username','$pwd','3','a')";
    if($con -> query($insert_login_cred)){
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assests/style/dashboard-index.css">
    <link rel="stylesheet" href="../assests/style/teacher-portal.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <title>Add More Teacher - Admin</title>
</head>

<body>
    <div class="dashboard">
        <?php require_once("./sidebar.php") ?>
        <div class="dashboard-inner " id="main-bar">
            <div class="main-box">
                <h2>
                    Teacher  <?php echo $teachername ?> added Successfully!
                </h2>
                <a href="./index.php">
                <button>Go to dashboard </button>
                </a>
            </div>
        </div>
    </div>
</body>
 <?php
}

else{
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assests/style/dashboard-index.css">
    <link rel="stylesheet" href="../assests/style/teacher-portal.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <title>Add More Teacher - Admin</title>
</head>

<body>
    <div class="dashboard">
        <?php require_once("./sidebar.php") ?>
        <div class="dashboard-inner " id="main-bar">
            <div class="main-box">
                <h2>
                 Something Went Wrong!!!
                </h2>
                <a href="./index.php">
                <button>Go to dashboard </button>
                </a>
            </div>
        </div>
    </div>
</body>
    <?php
}
?>

<?php
}
else{
    header("location:../login.html");
}