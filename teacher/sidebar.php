<?php

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

    $username_T = "usertype_".$user_level."_info";


    
    // section 1
    $teacherID_Q  = mysqli_query($con,"SELECT `user_teacherid` FROM $username_T WHERE username = '$username'");
    while($row = mysqli_fetch_assoc($teacherID_Q)){
        $teacher_id = $row['user_teacherid'];
    }
    // section 2
    $teacherNAME_Q  = mysqli_query($con,"SELECT `teacher_name` FROM `teacher` WHERE teacher_id = '$teacher_id'");
    while($row = mysqli_fetch_assoc($teacherNAME_Q)){
        $teacher_name = $row['teacher_name'];
    }

}
    ?>



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
                <a href="./forgetPassword.php">
                    <i class="fas fa-unlock-alt icon-sidebar"></i>
                    <div class="row-sidebar-text ">
                        Change Password
                    </div>
                </a>

            </div>

        </div>
        <hr>
        <div class="row-sidebar selected-sidebar">

            <a href="./index.php">
                <i class="fas fa-file-upload icon-sidebar"></i>
                <div class="row-sidebar-text ">
                    Upload Attendance
                </div>
            </a>

        </div>
        <div class="row-sidebar">
            <a href="./viewAttendance.php">

                <i class="fas fa-file-upload icon-sidebar"></i>
                <div class="row-sidebar-text ">
                    View Attendance
                </div>
            </a>
        </div>
        <div class="row-sidebar">
            <a href="./forgetPassword.php">
                <i class="fas fa-unlock-alt icon-sidebar"></i>
                <div class="row-sidebar-text ">
                    Change Password
                </div>
            </a>

        </div>
        <div class="row-sidebar">
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSe7XlyZpiD6l-U8Irrd-GLdNF5ne7IcJW8iGOqs4IxFSJN4zA/viewform?usp=sf_link" target="_blank">
            <i class="fas fa-phone-square-alt icon-sidebar"></i>
                <div class="row-sidebar-text ">
                   Contact Support
                </div>
            </a>

        </div>
        <!-- <div class="row-sidebar">
                    <i class="far fa-calendar-alt icon-sidebar"></i>
                    <div class="row-sidebar-text ">
                        View Timetable
                    </div>
                </div>
                <div class="row-sidebar">
                    <i class="fas fa-users icon-sidebar"></i>
                    <div class="row-sidebar-text ">
                        Remaining Scheduled Classes
                    </div>
                </div>
                <div class="row-sidebar">
                    <i class="fab fa-stack-overflow icon-sidebar"></i>
                    <div class="row-sidebar-text ">
                        Student Attendance Statistics
                    </div>
                </div>
                <div class="row-sidebar">
                    <i class="fab fa-stack-overflow icon-sidebar"></i>
                    <div class="row-sidebar-text ">
                        Classes Conducted Statistics
                    </div>
                </div>
                <div class="row-sidebar">
                    <i class="fas fa-download icon-sidebar"></i>
                    <div class="row-sidebar-text ">
                        PDF Report Download
                    </div>
                </div> -->
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