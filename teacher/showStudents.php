<?php
require_once('../connection.php');
session_start();

$lecture_id = $_GET['lect'];
$table = $_GET['table'];

$break  = explode('_',$table);
$student_table_name = $break[0]."_".$break[1]."_".$break[3]."_".$break[4]."_students";

if(isset($_POST['id'])){
    
date_default_timezone_set("Asia/Karachi");
        $get_recent_term_Q  = mysqli_query($con,"SELECT `term_name`,`term_id` FROM `term` WHERE 1");
    while($row = mysqli_fetch_assoc($get_recent_term_Q)){
        $term_name = $row['term_name'];
        $term_id = $row['term_id'];
    }
    // $term =  $term_id;
    // $period_ID = $_POST['id'];

    $date = date('Y-m-d');
    // echo $date;
    $dayOfWeek = date("l", strtotime($date));
    $dayOfWeek = ucfirst($dayOfWeek);
    // $nu = 2;
    switch($day_name){
        case 'Monday':
            $nu = 1;
        break;
        case 'Tuesday':
            $nu = 2;
        break;
        case 'Wednesday':
            $nu = 3;
        break;
        case 'Thursday':
            $nu = 4;
        break;
        case 'Friday':
            $nu = 5;
        break;
        case 'Saturday':
            $nu = 6;
        break;
    }

    if($dayOfWeek == $day_name){
       $date = date('Y-m-d');
    }
    else{
       $date = date('Y-m-d', strtotime(' -1 day'));
    }

    $table_name =  $dept_id.'_'.$batch_id.'_'.$term.'_'.$section.'_students';
    // $table_name = 'cs_4_1_a_students';
       
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
<script src="https://kit.fontawesome.com/407fccd64e.js" crossorigin="anonymous"></script>

    <title>Dashboard</title>
</head>

<body>

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
<?php

$get_period_id = mysqli_query($con,"SELECT `period_id`, `lecture_date`, `week_id`, `term_id` FROM `lecture_details` WHERE `lecture_id`='$lecture_id'");
while($row = mysqli_fetch_assoc($get_period_id)){
 $id =  $row['period_id'];
 $lecture_date = $row['lecture_date'];
}
  $period_ID = $id;
  $period_ID_Q  = mysqli_query($con,"SELECT `dept_id`,`batch_id`,`section`,`teacher_id`,`timing_id`,`day_id`,`subject_id` FROM `period_table_normal` WHERE period_id = '$period_ID'");
  while($row = mysqli_fetch_assoc($period_ID_Q)){
      $dept_id = $row['dept_id'];
      $batch_id = $row['batch_id'];
      $section = $row['section'];
      $teacher_id = $row['teacher_id'];
      $timing_id = $row['timing_id'];
      $day_id = $row['day_id'];  
      $subject_id = $row['subject_id'];
  }



  // getting name
  $dept_name_Q  = mysqli_query($con,"SELECT `department_id`, `department_name` FROM `department` WHERE department_id = '$dept_id'");
    while($row = mysqli_fetch_assoc($dept_name_Q)){
        $department_name = $row['department_name'];
    }
  $batch_name_Q  = mysqli_query($con,"SELECT `batch_name` FROM `batch` WHERE batch_id = '$batch_id'");
  while($row = mysqli_fetch_assoc($batch_name_Q)){
      $batch_name = $row['batch_name'];
  }
  $teacher_name_Q  = mysqli_query($con,"SELECT `teacher_name` FROM `teacher` WHERE teacher_id = '$teacher_id'");
  while($row = mysqli_fetch_assoc($teacher_name_Q)){
      $teacher_name = $row['teacher_name'];
  }
  $period_name_Q  = mysqli_query($con,"SELECT `period_name` FROM `period` WHERE period_id = '$timing_id'");
  while($row = mysqli_fetch_assoc($period_name_Q)){
      $period_name = $row['period_name'];
  }
  $day_id_Q  = mysqli_query($con,"SELECT `day_name` FROM `day` WHERE day_id = '$day_id'");
  while($row = mysqli_fetch_assoc($day_id_Q)){
      $day_name = $row['day_name'];
  }
  $subject_name_Q  = mysqli_query($con,"SELECT `subject_name` FROM `subject` WHERE subject_id = '$subject_id'");
  while($row = mysqli_fetch_assoc($subject_name_Q)){
      $subject_name = $row['subject_name'];
  }


?>

            <div class="dashboard-inner " id="main-bar">
                <div class="floating-menu">
                    <button id="floating">X</button>
                </div>
                <div class="dashboard-inner-teacher-top">
                    <h2>Teacher's Dashboard</h2>
                </div>

                <div class="dit-class-students confirm" style="margin-top:100px">
                    <table id='students'>
                    <div class="table-header"style="display : flex; justify-content:center; padding-left: 20%;">  
<div class="table-h-row" >    
<h2>   <span class="heading-table-r">Department: </span> <?php echo $department_name?>
       </h2>  </div>  
       <div class="table-h-row">       
       <h2> <span class="heading-table-r">Batch: </span><?php echo $batch_name ?></h2> 
       <h2><span class="heading-table-r">Teacher: </span><?php echo $teacher_name ?>
       </h2> </div>  <div class="table-h-row">  
       <h2> <span class="heading-table-r">Date: </span><?php echo $lecture_date ?></h2>
       <h2><span class="heading-table-r">Day: </span><?php echo $day_name ?>  </h2>  
       <h2> <span class="heading-table-r">Time: </span><?php echo $period_name ?></h2>
   </div>
    <div class="table-h-row">
    <h2>  <span class="heading-table-r">Subject: </span> <?php echo $subject_name ?></h2> </div></div>
                    
                        <tr>
                            <td class='table-name'>Serial Number</td>
                            <td class='table-name'>Student Name</td>
                            <td>Student ID</td>
                            <td>Status</td>
                        </tr>
                        <?php
                        
for($i=1;$i<151;$i++){
    $a = 'a'.$i;
    $get_students = mysqli_query($con,"SELECT `$a` from `$table` where lecture_id='$lecture_id'");
    while($row = mysqli_fetch_assoc($get_students)){
     $status =  $row[$a];
    }
    

    $get_students_name = mysqli_query($con,"SELECT `student_id`,`student_name` from `$student_table_name` where student_rollnumber='$i'");
    while($row = mysqli_fetch_assoc($get_students_name)){
        $student_name =  $row['student_name']; $student_id =  $row['student_id'];
    }
    if($status != null){

     
       
    ?>

                        <tr>
                            <td>
                                <?php echo $i?>
                            </td>
                            <td>
                                <?php echo $student_name?>
                            </td>
                            <td>
                                <?php echo $student_id?>
                            </td>
                            <td>
                                <?php echo $status ?>
                            </td>
                        </tr>


                        <?php

    }
                        }

                        ?>
                    </table>  

                    <div class="button-col">
                    <a href="./index.php">
                        <button>Back To Dashboard</button>
                    </a>
                    <a href="./printattendance.php">
                        <button>Download Attendance</button>
                    </a>
                </div>
                </div>
            </div> 
        </div>
        <?php 

$pdf=" <div class='dashboard-inner' id='main-bar' style='width: 100% !important;'>
                
                <div class='dashboard-inner-teacher-top' style='width:100%;'>
                    <h2>Teacher's Dashboard</h2>
                </div>

                <div class='dit-class-students confirm' style='margin-top:100px'>

                    <table id='students'>
<div class='table-header' style=' display : flex; justify-content:center; padding-left: 20%;' >  
<div class=' table-h-row'  >    
<h2>   <span class=' heading-table-r' >Department: </span> ".$department_name."
       </h2>  </div>  
       <div class=' table-h-row' >       
       <h2> <span class=' heading-table-r' >Batch: </span>".$batch_name ."</h2> 
       <h2><span class=' heading-table-r' >Teacher: </span>".$teacher_name ."
       </h2> </div>  <div class=' table-h-row' >  
       <h2> <span class=' heading-table-r' >Date: </span>".$lecture_date ."</h2>
       <h2><span class=' heading-table-r' >Day: </span>".$day_name ."  </h2>  
       <h2> <span class=' heading-table-r' >Time: </span>".$period_name ."</h2>
   </div>
    <div class=' table-h-row' >
    <h2>  <span class=' heading-table-r' >Subject: </span> ".$subject_name ."</h2> </div></div>
                        <tr>
                            <td class='table-name'>Serial Number</td>
                            <td class='table-name'>Student Name</td>
                            <td>Student ID</td>
                            <td>Status</td>
                        </tr>";
                        
for($i=1;$i<151;$i++){
    $a = 'a'.$i;
    $get_students = mysqli_query($con,"SELECT `$a` from `$table` where lecture_id='$lecture_id'");
    while($row = mysqli_fetch_assoc($get_students)){
     $status =  $row[$a];
    } 
    $get_students_name = mysqli_query($con,"SELECT `student_id`,`student_name` from `$student_table_name` where student_rollnumber='$i'");
    while($row = mysqli_fetch_assoc($get_students_name)){
        $student_name =  $row['student_name']; $student_id =  $row['student_id'];
    }
    if($status != null){

                        $pdf.="<tr>
                            <td>
                                ".$i."
                            </td>
                            <td>
                                ".$student_name."
                            </td>
                            <td>
                                ".$student_id."
                            </td>
                            <td>
                                ".$status ."
                            </td>
                        </tr>";

    }
                        }

                        
                    $pdf.="</table>"; 

                    ?>

                    <?php 
                    // echo $pdf;
                     
                     $_SESSION['pdf'] = $pdf;
                    ?>
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