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

$get_recent_term_Q  = mysqli_query($con,"SELECT `term_name`,`term_id` FROM `term` WHERE 1");
while($row = mysqli_fetch_assoc($get_recent_term_Q)){
    $term_name = $row['term_name'];
    $term_id = $row['term_id'];
}


$dept =  $_POST['dept'];
$batch =  $_POST['batch'];
$teacher =  $_POST['teacher'];
$room =  $_POST['room'];
$time =  $_POST['time'];
$subject =  $_POST['subject'];
$day =  $_POST['day'];
$credit =  $_POST['credit'];
$section =  $_POST['section'];

$section = strtolower($section);
$term_id = 1;




$get_details  = "DELETE FROM `period_table_normal` WHERE dept_id = '$dept' and batch_id = '$batch' and teacher_id = '$teacher' and room_id = '$room' and timing_id = '$time' and day_id = '$day' and credit_hour = '$credit'";
if($con -> query($get_details)){
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
<script src="https://kit.fontawesome.com/407fccd64e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assests/style/dashboard-index.css">
    <link rel="stylesheet" href="../assests/style/teacher-portal.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <title>Delete Student - Admin</title>
</head>

<body>
    <div class="dashboard">
        <?php require_once("./sidebar.php") ?>
        <div class="dashboard-inner " id="main-bar">
            <div class="main-box">
                <h2>
                    Period  Successfully Deleted!  
                </h2>
                <a href="./index.php">
                <button>Go to dashboard </button>
                </a>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
    
<script src="https://kit.fontawesome.com/407fccd64e.js" crossorigin="anonymous"></script>
<script>
    if ($(window).width() > 768) {
        $('#sidebar').hover(function () {
            // alert("done");
            $(this).addClass('sidebar-opened');
            $(".row-sidebar-text").addClass('text-opened');
            $('.icon-sidebar').css('margin', '0px');
            $('.row-sidebar').css('padding', '0px 10px');
        },
            function () {
                $(this).removeClass('sidebar-opened');
                $(".row-sidebar-text").removeClass('text-opened');
                $(".dashboard-inner").removeClass('da');
                $('.icon-sidebar').css('margin', 'auto');
                $('.row-sidebar').css('padding', '0px');
            }
        );
    }
</script>
<?php
}
else{
    ?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assests/style/dashboard-index.css">
    <link rel="stylesheet" href="../assests/style/teacher-portal.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <title>Delete Student - Admin</title>
</head>

<body>
    <div class="dashboard">
        <?php require_once("./sidebar.php") ?>
        <div class="dashboard-inner " id="main-bar">
            <div class="main-box">
                <h2>
                    Something Went Wrong!  
                </h2>
                <a href="./index.php">
                <button>Go to dashboard </button>
                </a>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script>
    if ($(window).width() > 768) {
        $('#sidebar').hover(function () {
            // alert("done");
            $(this).addClass('sidebar-opened');
            $(".row-sidebar-text").addClass('text-opened');
            $('.icon-sidebar').css('margin', '0px');
            $('.row-sidebar').css('padding', '0px 10px');
        },
            function () {
                $(this).removeClass('sidebar-opened');
                $(".row-sidebar-text").removeClass('text-opened');
                $(".dashboard-inner").removeClass('da');
                $('.icon-sidebar').css('margin', 'auto');
                $('.row-sidebar').css('padding', '0px');
            }
        );
    }
</script>
    <?php
}
?>


<?php
}
else{
    header("location:../login.html");

}