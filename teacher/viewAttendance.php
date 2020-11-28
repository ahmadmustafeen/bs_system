<?php

require_once('../connection.php');
session_start();

    $username = $_SESSION['User'];
    $user_level_Q  = mysqli_query($con,"SELECT `user_type` FROM `login_info` WHERE username = '$username'");
    while($row = mysqli_fetch_assoc($user_level_Q)){
        $user_level = $row['user_type'];
    }
    if($user_level != '3'){
        header('location:../wellcome.php');
    }

    $username_T = "usertype_".$user_level."_info";
    $teacherID_Q  = mysqli_query($con,"SELECT `user_teacherid` FROM $username_T WHERE username = '$username'");
    while($row = mysqli_fetch_assoc($teacherID_Q)){
        $teacher_id = $row['user_teacherid'];
    }
$period_name_Q  = mysqli_query($con,"SELECT * FROM `period_table_normal` WHERE teacher_id = '$teacher_id' ");

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
    <title>Dashboard</title>
</head>

<body style="background-color: #e0e0e0;">
    <div class="dashboard">
        <div class="sidebar " id="sidebar">
            <div class="sidebar-inner " id="sidebar-inner">
                <p>D.A.M.S</p>
                <hr>
                <div class="row-sidebar profile">

                    <i class="far fa-user-circle icon-sidebar"></i>
                    <div class="row-sidebar-text name-bar ">
                        <?php echo $teacher_name; ?>

                    </div>
                </div>
                <div id="drop-down-profile" class="row-sidebar-profile">
                    <div class="row-sidebar">
                        <a href="">
                            <i class="fas fa-address-card icon-sidebar"></i>
                            <div class="row-sidebar-text ">
                                View Profile
                            </div>
                        </a>

                    </div>
                    <div class="row-sidebar">
                        <a href="">
                            <i class="fas fa-unlock-alt icon-sidebar"></i>
                            <div class="row-sidebar-text ">
                                Change Password
                            </div>
                        </a>

                    </div>

                </div>
                <hr>
                <div class="row-sidebar selected-sidebar">


                    <i class="fas fa-file-upload icon-sidebar"></i>
                    <div class="row-sidebar-text ">
                        Upload Attendance
                    </div>
                </div>
                <div class="row-sidebar">
                    <a href="./attendance-eng.html">

                        <i class="fas fa-file-upload icon-sidebar"></i>
                        <div class="row-sidebar-text ">
                            View Attendance
                        </div>
                    </a>
                </div>

                <div class="row-sidebar">
                    <a href="../logout.php" class='row-sidebar' style='width:100%'>
                        <i class="fas fa-sign-out-alt icon-sidebar"></i>
                        <div class="row-sidebar-text ">
                            Logout
                        </div>
                    </a>
                </div>


            </div>











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
                    
                </h2>

                <div class="dit-heading >
                    <table>
                        <tr>
                            <td>
                                <h3>Select Class</h3>
                            </td>
                            <td>
                                <Select name="depart" id="selectDepart">

                                    <option selected disabled>Select from Available Classes</option>
                                    <?php
                                          while($row = mysqli_fetch_assoc($period_name_Q)){
                                            $period_table_id = $row['period_id'];
                                            $period_id = $row['timing_id'];
                                            $batch_id = $row['batch_id'];
                                            $subject_id = $row['subject_id'];
                                        
                                      
                                      
                                      
                                        $period_time_Q  = mysqli_query($con,"SELECT `period_name` FROM `period` WHERE period_id = '$period_id'");
                                          while($row = mysqli_fetch_assoc($period_time_Q)){
                                              $period_timing = $row['period_name'];
                                          }
                                      
                                      
                                          $batch_name_Q  = mysqli_query($con,"SELECT `batch_name` FROM `batch` WHERE batch_id = '$batch_id'");
                                          while($row = mysqli_fetch_assoc($batch_name_Q)){
                                              $batch_name = $row['batch_name'];
                                          }
                                      
                                      
                                          $subject_name_Q  = mysqli_query($con,"SELECT `subject_name` FROM `subject` WHERE subject_id = '$subject_id'");
                                          while($row = mysqli_fetch_assoc($subject_name_Q)){
                                              $subject_name = $row['subject_name'];
                                          }
                                          $option_period =  ucwords($subject_name)." ===== ".$batch_name." ===== ".$period_timing;
                                          
                                        
                                        ?>
                                    <option value=" <?php echo $period_table_id ?>" ><?php echo $option_period ?>
                                    </option>
                                    <?php
                                          }
                                        ?>
                                </Select>
                            </td>
                        </tr>
                        <tr>  <td></td>
                            <td>
                                <div class="button-col">
                                    <form action="./showAttendanceClass.php" method="POST">
                                    <input type="text" value="" name="period_id" id="period_id" style="display:none">
                                        <button type="submit" name="dept">Show</button>
                                    </form>
                                </div>
                            </td>
                          


                        </tr>


                    </table>
                </div>
            </div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script>
$("#selectDepart").change(function() {
    $('.dit-class-students').css('display', 'flex');
    var x = document.getElementById('selectDepart').value;
  document.getElementById('period_id').value = x

});

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