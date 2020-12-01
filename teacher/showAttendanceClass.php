<?php
$period_id = $_POST['period_id'];
require_once('../connection.php');
session_start();



     
$period_time_Q  = mysqli_query($con,"SELECT `subject_id`, `section`, `term_id`,`dept_id`,`batch_id` FROM `period_table_normal` WHERE period_id = '$period_id'");
while($row = mysqli_fetch_assoc($period_time_Q)){
    $subject_id = $row['subject_id'];    $dept_id = $row['dept_id'];    $batch_id = $row['batch_id'];   $section = $row['section'];    $term_id = $row['term_id'];
}
$table_name = $dept_id."_".$batch_id."_".$subject_id."_".$term_id."_".$section."_attendance";
// echo $table_name;
$lecture_id_Q  = mysqli_query($con,"SELECT `lecture_id` FROM `$table_name` WHERE 1 order by lecture_id DESC");



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assests/style/dashboard-index.css">
    <link rel="stylesheet" href="../assests/style/teacher-portal.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://kit.fontawesome.com/407fccd64e.js" crossorigin="anonymous"></script>

    <title>Dashboard</title>
</head>

<body style="background-color: #e0e0e0;">
    <div class="dashboard">
        <div class="sidebar " id="sidebar">
          <?php include_once("./sidebar.php")?>











        </div>
        <div class="dashboard-inner " id="main-bar">
            <div class="floating-menu">
                <button id="floating">X</button>
            </div>
            <div class="dashboard-inner-teacher-top">
                <h2>Teacher's Dashboard</h2>
            </div>
            <div class="dashboard-inner-teacher">
                <h2 style="text-align: center;">
                    Following Attendance are Uploaded So Far!
                </h2>
            </div>
            <?php
            while($row = mysqli_fetch_assoc($lecture_id_Q)){
            $lecture_id = $row['lecture_id'];
         ?>
            <a class="dashboard-inner-teacher" href="showStudents.php?lect=<?php echo $lecture_id?>&table=<?php echo $table_name; ?>">

            <?php 
                $data_Q  = mysqli_query($con,"SELECT `lecture_date` FROM `lecture_details` WHERE lecture_id = '$lecture_id'");
                while($row = mysqli_fetch_assoc($data_Q)){
                    $date = $row['lecture_date'];   
                }
            ?>
                <h2 style="text-align: center; text-decoration:none;color:black">
                   Date: <?php echo $date ?> 
                </h2>
            </a>
            <?php
            }

?>   <div class="button-col">
<a href="./index.php">
    <button>Back To Dashboard</button>
</a>
</div>







</body>

</html>


<script>
if ($(window).width() > 768) {
    $('#sidebar').hover(function() {
            // alert("done");
            $(this).addClass('sidebar-opened');
            $(".row-sidebar-text").addClass('text-opened');
            $('.icon-sidebar').css('margin', '0px');
            $('.row-sidebar').css('padding', '0px 10px');
        },
        function() {
            $(this).removeClass('sidebar-opened');
            $(".row-sidebar-text").removeClass('text-opened');
            $(".dashboard-inner").removeClass('da');
            $('.icon-sidebar').css('margin', 'auto');
            $('.row-sidebar').css('padding', '0px');
        }
    );
}
</script>