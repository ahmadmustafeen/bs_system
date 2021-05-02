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

if(isset($_POST['index'])){


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
    $get_recent_term_Q  = mysqli_query($con,"SELECT `term_name`,`term_id` FROM `term` WHERE 1");
    while($row = mysqli_fetch_assoc($get_recent_term_Q)){
        $term_name = $row['term_name'];
        $term_id = $row['term_id'];
    }
    $term =  $term_id;
    $date = $_POST['date'];
    $period_ida = $_POST['period_id'];
    $period_name_Qa = mysqli_query($con,"SELECT  * FROM `period_table_normal` WHERE period_id = '$period_ida'");
    while($row = mysqli_fetch_assoc($period_name_Qa)){
        $period_id = $row['timing_id'];
        $dept_id = $row['dept_id'];
        $batch_id = $row['batch_id'];
        $section = $row['section'];
        $subject_id = $row['subject_id'];
        $batch_name_Q  = mysqli_query($con,"SELECT `batch_name` FROM `batch` WHERE batch_id = '$batch_id'");
        }
    $absent = [];
    $present = [];
    $term = $term_id;
    $table_name =  $dept_id.'_'.$batch_id.'_'.$term.'_'.$section.'_students';
    for($i=1;$i<151;$i++){
        if(isset($_POST[$i])){
            array_push($absent,$_POST[$i]);
        }
    }
    $student_name_ID  = mysqli_query($con,"SELECT `student_name`,`student_id`,`student_rollnumber` FROM `$table_name` WHERE 1");
    while($row = mysqli_fetch_assoc($student_name_ID)){
    array_push($present,$row['student_rollnumber']);
    }
    for($i=0;$i<sizeof($present);$i++){     
        for($j=0;$j<sizeof($absent);$j++){
            if($present[$i] == $absent[$j]){
                array_splice($present,$i,1);
            }
        }   
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <title>Confirm Attendance</title>
</head>

<body>
    <form action="./attendancesubmit.php" method="POST">
        <div class="dashboard">
         <?php include_once("./sidebar.php"); ?>
            <div class="dashboard-inner " id="main-bar">
                <div class="floating-menu">
                    <button id="floating">X</button>
                </div>
                <div class="dashboard-inner-teacher-top">
                    <h2>Teacher's Dashboard (Review Attendance)</h2>
                </div>
                <br>
                <div class="dit-class-students confirm">
                    <h2>Absent Students</h2>
                    <p>All the student who are absent</p>
                    <table id='students'>
                        <tr>
                            <td class='table-name'>Serial Number</td>
                            <td class='table-name'>Student Name</td>
                            <td>Student ID</td>
                            <td>Status</td>
                        </tr>
                        <?php
                        for($i=0;$i<sizeof($absent);$i++){
                            $student_roll_get = $absent[$i];
                            $student_name_IDs  = mysqli_query($con,"SELECT `student_name`,`student_id`,`student_rollnumber` FROM `$table_name` WHERE student_rollnumber = '$student_roll_get'");
                            ?>
                        <tr>
                            <?php
                            while($row = mysqli_fetch_assoc($student_name_IDs)){
                                $student_name = ucwords($row['student_name']);
                                $student_id = $row['student_id'];
                                ?>
                            <td class='table-name'><?php echo $i+1 ?></td>
                            <td class='table-name'><?php echo $student_name ?></td>
                            <td><?php echo $student_id ?></td>
                            <td style="background-color:#f5365c !important;color:white">
                                <input name="<?php echo $student_id ?>" id="<?php echo $student_id ?>" value="absent"
                                    style="display:none;">Absent
                            </td>
                        </tr>
                        <?php
                        }
                    }
                        ?>

                    </table>


                </div>
                <div class="dit-class-students confirm">
                    <h2>Present Students</h2>
                    <p>All the student who are present</p>
                    <table id='students'>
                        <tr>
                            <td class='table-name'>Serial Number</td>
                            <td class='table-name'>Student Name</td>
                            <td>Student ID</td>
                            <td>Status</td>
                        </tr>
                        <?php
                        for($j=0;$j<sizeof($present);$j++){
                            $student_roll_geta = $present[$j];
                            $student_name_IDs  = mysqli_query($con,"SELECT  `student_name`,`student_id`,`student_rollnumber` FROM `$table_name` WHERE student_rollnumber = '$student_roll_geta'");
                            ?>
                        <tr>
                            <?php
                            while($row = mysqli_fetch_assoc($student_name_IDs)){
                                $student_name = ucwords($row['student_name']);
                                
                                $student_id = $row['student_id'];
                                ?>
                            <td class='table-name'><?php echo $j+1 ?></td>
                            <td class='table-name'><?php echo $student_name ?></td>
                            <td><?php echo $student_id ?></td>
                            <td style="background-color: #2dce89 !important;color:white"><input
                                    name="<?php echo $student_id; ?>" value="present" id="<?php echo $student_id ?>"
                                    style="display:none;"><?php echo 'PRESENT'?></td>


                            <?php
                        } 
                        ?>
                        </tr>
                        <?php }
                        ?>

                    </table>

                    <input type="date" name="date" id='date' value="<?php  echo $date ?>" >
                    <input name="class_name" id='class_name' value="<?php  echo $dept_id.'_'.$batch_id ?>"
                        style="display:none">
                    <input name="period_id" id='period_id' value="<?php  echo $period_ida ?>" style="display:none">

                    <div style="display:flex;flex-direction:row;justify-content:space-between;width:50%">


                        <h2>Total Absent: <?php echo $i ?></h2>
                        <h2>Total Present: <?php echo $j ?></h2>
                    </div>
                    <div style="display:flex;flex-direction:row;justify-content:space-between;width:80%">
                        <a href="./index.php">
                            <button style='background-color:#f5365c; border:0;color:white'>Cancel</button>
                        </a>
                        <button style='background-color:#2dce89 !important; border:0;' name='edit'>Edit</button>
                        <button style='background-color:#2dce89 !important; border:0;' name='submit'>Confirm</button>
                    </div>
                </div>


            </div>
        </div>
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/407fccd64e.js" crossorigin="anonymous"></script>
<script src="../assests/script/dashbaord.js"></script>
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
</html>
<?php 
                }
            }
            
            if(isset($_POST['attendancesubmit'])){
                $absent = [];
                $present = [];
               
                $get_recent_term_Q  = mysqli_query($con,"SELECT `term_name`,`term_id` FROM `term` WHERE 1");
                    while($row = mysqli_fetch_assoc($get_recent_term_Q)){
                        $term_name = $row['term_name'];
                        $term_id = $row['term_id'];
                    }
                    $term =  $term_id;
              $class_name = $_POST['class_name'];
              $period_id  =$_POST['period_id'];
              $date =  $_POST['date'];
              $period_name_Qa = mysqli_query($con,"SELECT  * FROM `period_table_normal` WHERE period_id = '$period_id'");
                  while($row = mysqli_fetch_assoc($period_name_Qa)){
                      $period_timing = $row['timing_id'];
                      $dept_id = $row['dept_id'];
                      $batch_id = $row['batch_id'];
                      $section = $row['section'];
                      $subject_id = $row['subject_id'];
                    }
                    $student_table = $dept_id."_".$batch_id."_".$term_id."_".$section."_students";
                    // echo $student_table;
                    $student_name_Q = mysqli_query($con,"SELECT `student_id` FROM `$student_table` WHERE 1 order by student_rollnumber ASC");
                    while($row = mysqli_fetch_assoc($student_name_Q)){
                        $student_id = $row['student_id'];
                        $term = $term_id;
                        $table_name =  $dept_id.'_'.$batch_id.'_'.$term.'_'.$section.'_students';
                            if(!isset($_POST[$student_id])){
                                array_push($present,$student_id);
                        }
                            if(isset($_POST[$student_id])){
                                array_push($absent,$student_id);
                        }
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <title>Confirm Attendance</title>
</head>

<body>
    <form action="./attendancesubmit.php" method="POST">
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
                    <h2>Teacher's Dashboard (Review Attendance)</h2>
                </div>
                <br>
                <div class="dit-class-students confirm">
                    <h2>Absent Students</h2>
                    <p>All the student who are absent</p>
                    <table id='students'>
                        <tr>
                            <td class='table-name'>Serial Number</td>
                            <td class='table-name'>Student Name</td>
                            <td>Student ID</td>
                            <td>Status</td>
                        </tr>
                        <?php
                        for($i=0;$i<sizeof($absent);$i++){
                            $student_roll_get = $absent[$i];
                            $student_name_IDs  = mysqli_query($con,"SELECT `student_name`,`student_id`,`student_rollnumber` FROM `$table_name` WHERE student_id = '$student_roll_get'");
                            ?>
                        <tr>
                            <?php
                            while($row = mysqli_fetch_assoc($student_name_IDs)){
                                $student_name = ucwords($row['student_name']);
                                $student_id = $row['student_id'];
                                ?>
                            <td class='table-name'><?php echo $i+1 ?></td>
                            <td class='table-name'><?php echo $student_name ?></td>
                            <td><?php echo $student_id ?></td>
                            <td style="background-color:#f5365c !important;color:white">
                                <input name="<?php echo $student_id ?>" id="<?php echo $student_id ?>" value="absent"
                                    style="display:none;">Absent
                            </td>
                        </tr>
                        <?php
                        }
                    }
                        ?>

                    </table>


                </div>
                <div class="dit-class-students confirm">
                    <h2>Present Students</h2>
                    <p>All the student who are present</p>
                    <table id='students'>
                        <tr>
                            <td class='table-name'>Serial Number</td>
                            <td class='table-name'>Student Name</td>
                            <td>Student ID</td>
                            <td>Status</td>
                        </tr>
                        <?php
                        for($j=0;$j<sizeof($present);$j++){
                            $student_roll_geta = $present[$j];
                            $student_name_IDs  = mysqli_query($con,"SELECT  `student_name`,`student_id`,`student_rollnumber` FROM `$table_name` WHERE student_id = '$student_roll_geta'");
                            ?>
                        <tr>
                            <?php
                            while($row = mysqli_fetch_assoc($student_name_IDs)){
                                $student_name = ucwords($row['student_name']);
                                
                                $student_id = $row['student_id'];
                                ?>
                            <td class='table-name'><?php echo $j+1 ?></td>
                            <td class='table-name'><?php echo $student_name ?></td>
                            <td><?php echo $student_id ?></td>
                            <td style="background-color: #2dce89 !important;color:white"><input
                                    name="<?php echo $student_id; ?>" value="present" id="<?php echo $student_id ?>"
                                    style="display:none;"><?php echo 'PRESENT'?></td>


                            <?php
                        } 
                        ?>
                        </tr>
                        <?php }
                        ?>

                    </table>

                    <input type="date" name="date" id='date' value="<?php  echo $date ?>">
                    <input name="class_name" id='class_name' value="<?php  echo $dept_id.'_'.$batch_id ?>"
                        style="display:none">
                    <input name="period_id" id='period_id' value="<?php  echo $period_id ?>" style="display:none">

                    <div style="display:flex;flex-direction:row;justify-content:space-between;width:50%">


                        <h2>Total Absent: <?php echo $i ?></h2>
                        <h2>Total Present: <?php echo $j ?></h2>
                    </div>
                    <div style="display:flex;flex-direction:row;justify-content:space-between;width:80%">
                        <a href="./index.php">
                            <button style='background-color:#f5365c; border:0;color:white'>Cancel</button>
                        </a>
                        <button style='background-color:#2dce89 !important; border:0;' name='edit'>Edit</button>
                        <button style='background-color:#2dce89 !important; border:0;' name='submit'>Confirm</button>
                    </div>
                </div>


            </div>
        </div>
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/407fccd64e.js" crossorigin="anonymous"></script>
<script src="../assests/script/dashbaord.js"></script>
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
</html>




<?php




            }
?>