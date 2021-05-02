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
    if($user_level != '3'){
        header('location:../wellcome.php');
    }

    $get_attendance_Q = mysqli_query($con, "SELECT `lecture_id`, `period_id`, `lecture_date` FROM `lecture_details` WHERE lecture_date='0000-00-00'");
while($row = mysqli_fetch_assoc($get_attendance_Q)){
    $lecture_id = $row['lecture_id'];
    $period_id = $row['period_id'];
    $lecture_date = $row['lecture_date' ];
    echo $lecture_date;
}

    $period_time_Q  = mysqli_query($con,"SELECT `subject_id`, `section`, `term_id`,`dept_id`,`batch_id` FROM `period_table_normal` WHERE period_id = '$period_id'");
    while($row = mysqli_fetch_assoc($period_time_Q)){
        $subject_id = $row['subject_id'];    
        $dept_id = $row['dept_id'];    
        $batch_id = $row['batch_id'];   
        $section = $row['section'];    
        $term_id = $row['term_id'];
    }

    $table_name = $dept_id."_".$batch_id."_".$subject_id."_".$term_id."_".$section."_attendance";

for($i=1;$i<=20;$i++){
    $delete_attendance = "DELETE FROM `$table_name` WHERE lecture_id='$lecture_id'";
    if($con -> query($delete_attendance)){
    
    }

$delete_lecture = "DELETE FROM `lecture_details` WHERE lecture_id='$lecture_id'";
if($con -> query($delete_lecture)){

}
}
}
?>