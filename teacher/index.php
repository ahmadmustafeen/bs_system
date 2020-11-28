<?php
// This code is written by collabration of Ahmad Mustafeen and Satish Jeeyani.
// All part of this code is copywrited.






// About the code



// The most imp thing is the teacher_id which is being used as a primary key in the table.
// "teacher" table have the teacher name and respective teacher id ===> section 1 and section 2

// period_table have the recent time table of the current semester and from their all the subject(Class is pulled) ====> section 3



// now to get all the names of the student first get the input choosen by the user



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


    $date = date('Y-m-d');
    $dayOfWeek = date("l", strtotime($date));
    $dayOfWeek = strtolower($dayOfWeek);
//   echo $dayOfWeek;
    switch($dayOfWeek){
        case 'monday':
            $nu = 1;
        break;
        case 'tuesday':
            $nu = 2;
        break;
        case 'wednesday':
            $nu = 3;
        break;
        case 'thursday':
            $nu = 4;
        break;
        case 'friday':
            $nu = 5;
        break;
        case 'saturday':
            $nu = 6;
        break;
          case 'sunday':
            $nu = 7;
        break;
      
    }
    
    $pu = $nu-1;
  $period_name_Q  = mysqli_query($con,"SELECT * FROM `period_table_normal` WHERE (teacher_id = '$teacher_id') and ((day_id = '$nu') or (day_id = '$pu')) ");
  $period_name_Qaa  = mysqli_query($con,"SELECT * FROM `period_table_normal` WHERE (teacher_id = '$teacher_id') and ((day_id = '$nu') or (day_id = '$pu')) ");
$period_ids = [];
while($row = mysqli_fetch_assoc($period_name_Q)){
$period_id = $row['period_id'];
array_push($period_ids,$period_id);
}
// echo sizeof($period_ids);

foreach($period_ids as $period_id){
    $date = date('Y-m-d');
    $prev_date = date('Y-m-d', strtotime(' -1 day'));
    $lecture_get  = mysqli_query($con,"SELECT * FROM `lecture_details` WHERE period_id = '$period_id' and ((lecture_date = '$date') or (lecture_date = '$prev_date')) ");
    while($row = mysqli_fetch_assoc($lecture_get)){
        if (($key = array_search($period_id, $period_ids)) !== false) {
            unset($period_ids[$key]);
        }
    }
}
// echo sizeof($period_ids);
// $period_name_Q  = mysqli_query($con,"SELECT * FROM `period_table_normal` WHERE teacher_id = '$teacher_id' ");
// $period_name_Qaa  = mysqli_query($con,"SELECT * FROM `period_table_normal` WHERE teacher_id = '$teacher_id'");








    
    
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
                    <a href="./viewAttendance.php">

                        <i class="fas fa-file-upload icon-sidebar"></i>
                        <div class="row-sidebar-text ">
                            View Attendance
                        </div>
                    </a>
                </div> 
                <div class="row-sidebar">
                        <a href="./forgetPassword.html">
                            <i class="fas fa-unlock-alt icon-sidebar"></i>
                            <div class="row-sidebar-text ">
                                Change Password
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
        <div class="dashboard-inner " id="main-bar">
            <div class="floating-menu">
                <button id="floating">X</button>
            </div>

            <div class="dashboard-inner-teacher-top">
                <h2>Teacher's Dashboard</h2>
            </div>




            <div class="dashboard-inner-teacher">
                <div class="dit-heading teacher-dit-heading">
                    <h2>Select any of the Following Way:</h2>
                    <div class="attendance-upload-type">
                        <h2>
                            Submit Attendance Manually
                        </h2>
                        <div class="tick" id="manu" style="background-color:rgb(7, 219, 95);"></div>
                    </div>
                    <!-- <div class="attendance-upload-type">
                        <h2>
                            Manually Submit Attendance
                        </h2>
                        <div class="tick" id="manu"></div>
                    </div> -->
                </div>
            </div>
            <!-- <section id="automatic"> -->

            <!-- best batch -->
            <!-- <div class="dashboard-inner-teacher">
                    <h2 style="text-align: center;">
                        Upload Excel Sheet
                    </h2>

                    <div class="dit-heading">
                        <table>
                            <tr>
                                <td>
                                    <h3>Select Class</h3>
                                </td>
                                <td>
                                    <Select name="depart" id="selectDepart">

                                        <option selected disabled>Select from Available Classes</option>
                                        <?php


                                        // foreach($period_ids as $period_id){
                                        //     echo sizeof($period_ids);
                                        //     $period_name_Qaaa  = mysqli_query($con,"SELECT * FROM `period_table_normal` WHERE period_id = '$period_id'");
                                        //   while($row = mysqli_fetch_assoc($period_name_Qaaa)){
                                        //      echo $period_id;
                                        //     $period_table_id = $row['period_id'];
                                        //     $period_id = $row['timing_id'];
                                        //     $batch_id = $row['batch_id'];
                                        //     $subject_id = $row['subject_id'];
                                        
                                      
                                      
                                      
                                        // $period_time_Q  = mysqli_query($con,"SELECT `period_name` FROM `period` WHERE period_id = '$period_id'");
                                        //   while($row = mysqli_fetch_assoc($period_time_Q)){
                                        //       $period_timing = $row['period_name'];
                                        //   }
                                      
                                      
                                        //   $batch_name_Q  = mysqli_query($con,"SELECT `batch_name` FROM `batch` WHERE batch_id = '$batch_id'");
                                        //   while($row = mysqli_fetch_assoc($batch_name_Q)){
                                        //       $batch_name = $row['batch_name'];
                                        //   }
                                      
                                      
                                        //   $subject_name_Q  = mysqli_query($con,"SELECT `subject_name` FROM `subject` WHERE subject_id = '$subject_id'");
                                        //   while($row = mysqli_fetch_assoc($subject_name_Q)){
                                        //       $subject_name = $row['subject_name'];
                                        //   }
                                        //   $option_period =  ucwords($subject_name)." ===== ".$batch_name." ===== ".$period_timing;
                                          
                                        
                                        // ?>
                                        // <option value=" <?php echo $period_table_id ?>"><?php echo $option_period ?>
                                        // </option>
                                        // <?php
                                        //   }
                                        // }
                                        ?>
                                    </Select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>Upload File</h3>
                                </td>
                                <td>
                                    <input type="file" name="excelFile" id="excelFile" required>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div> -->
            <!-- </section> -->


            <form action="./confirm.php" method="POST" enctype="multipart/form-data"
                style='width:100%;display:flex;flex-direction:column;justify-content:center;align-items:center'>

                <section id="manual" style="display:flex">



                    <!-- best batch -->
                    <div class="dashboard-inner-teacher">
                        <h2 style="text-align: center;">
                            Manual Way (Mark Attendance)
                        </h2>
                        <div class="dit-heading">
                            <table>
                                <tr>
                                    <td>
                                        <h3>Select Class</h3>
                                    </td>
                                    <td>
                                        <Select name="depart" id="selectDeparta">

                                            <option selected disabled>Select from Available Classes</option>
                                            <?php
                                                  foreach($period_ids as $period_id){
                                                    echo sizeof($period_ids);
                                                    $period_name_Qaaa  = mysqli_query($con,"SELECT * FROM `period_table_normal` WHERE period_id = '$period_id'");
                                                  while($row = mysqli_fetch_assoc($period_name_Qaaa)){
                                               
                                   
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
                                            <option value=" <?php echo $period_table_id ?>" name="depart">
                                                <?php echo $option_period ?>
                                            </option>
                                            <?php
                                              }
                                            }
                                            ?>
                                        </Select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </section>


                <div class="dit-class-students" id="student_name_div">

                    <input name='period_id' id='period_id' value='<?php echo $period_table_id ?>' style="display:none">
                    <div id='studentsa' style="width:80%">

                        <input type="date" name="date" required>
                    </div>

                    <!-- <button type="submit" id="autoa" name="autoa" style="text-align:center">Confirm Submission</button> -->
                    <button type="submit" id="index" name="index" style="text-align:center;">Review Before
                        Submission</button>

            </form>

            <input type="number" id='totalnumberofstudents' style='display:none'>
        </div>





    </div>
    </div>



</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/407fccd64e.js" crossorigin="anonymous"></script>

<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
<script src="../assests/script/dashbaord.js"></script>

</html>

<script>
$i = 0;
b = 'red';
status = [];
$('#selectDeparta').change(function() {
    $('#student_name_div').css('display', 'flex');
    document.getElementById('period_id').value = document.getElementById('selectDeparta').value;
    number_of_students = document.getElementById('totalnumberofstudents').value;
    for (i = 0; i > number_of_students; i++) {
        status.push('present');
    }
    var periodID = $(this).val();
    $.ajax({
        method: 'POST',
        url: 'ajax.php',
        data: {
            id: periodID
        },
        dataType: 'HTML',
        success: function(data) {
            $('#studentsa').html(data);
        }
    });

});


$('#selectBatch').change(function() {
    $('#best-batch-heading').css('display', 'none');
    $('#best-batch-div').css('display', 'none');
    $('#batch-heading').css('display', 'flex');
    $('#batch-div').css('display', 'flex');
});

$('#chkTest').click(function() {
    if (b == 'red') {
        b = 'green';
    } else {
        b = 'red';
    }

});









// automaic
way = 'red';
com = 'grey';
$('#way').click(function() {
    if (way == 'red' && com == 'grey') {
        // alert(way+com);
        document.getElementById('manual').style.display = 'flex';
        document.getElementById('automatic').style.display = 'none';
        document.getElementById('myBtsn').style.display = 'flex';
        document.getElementById('myBtan').style.display = 'none';
        document.getElementById('automatic-com').style.display = 'none';
        document.getElementById('manual-com').style.display = 'none';
        way = 'green';
    } else if (way == 'green' && com == 'grey') {
        // alert(way+com);
        document.getElementById('automatic').style.display = 'flex';
        document.getElementById('myBtan').style.display = 'flex';
        document.getElementById('myBtsn').style.display = 'none';
        document.getElementById('manual').style.display = 'none';
        document.getElementById('automatic-com').style.display = 'none';
        document.getElementById('manual-com').style.display = 'none';

        way = 'red';
    } else if (way == 'red' && com == 'green') {
        // alert(way+com);
        document.getElementById('manual').style.display = 'none';
        document.getElementById('automatic').style.display = 'none';
        document.getElementById('manual-com').style.display = 'flex';
        document.getElementById('automatic-com').style.display = 'none';
        way = 'green';
    } else if (way == 'green' && com == 'green') {
        document.getElementById('automatic').style.display = 'none';
        document.getElementById('manual').style.display = 'none';
        document.getElementById('manual-com').style.display = 'none';
        document.getElementById('automatic-com').style.display = 'flex';
        way = 'red';
    }

});



i = 0;
$('#compedfnsated').click(function() {
    if (com == 'grey') {
        com = 'green';
    } else if (com == 'green') {
        com = 'grey';
    }

});






// attendace template to be put in loop
var switchStatus = false;
$(".students_present").on('change', function() {
    if ($(this).is(':checked')) {
        switchStatus = $(this).is(':checked');
    } else {
        switchStatus = $(this).is(':checked');
    }
});


$("#selectDepart").change(function() {
    $('.dit-class-students').css('display', 'flex');
    var x = document.getElementById('selectDepart').value;
    document.getElementById('period_id').value = x

});
</script>




<script src="./jquery.js"></script>





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


$('#auto').click(function() {
    var auto = document.getElementById('auto');
    var manu = document.getElementById('manu');
    auto.style.backgroundColor = 'rgb(7, 219, 95)';
    manu.style.backgroundColor = '  rgb(141, 141, 141)';
    document.getElementById('automatic').style.display = 'flex';
    document.getElementById('manual').style.display = 'none';
    document.getElementById('autoa').style.display = 'flex';
    document.getElementById('manua').style.display = 'none';
});
$('#manu').click(function() {
    var auto = document.getElementById('auto');
    var manu = document.getElementById('manu');
    manu.style.backgroundColor = 'rgb(7, 219, 95)';
    auto.style.backgroundColor = '  rgb(141, 141, 141)';
    document.getElementById('automatic').style.display = 'none';
    document.getElementById('manual').style.display = 'flex';
    document.getElementById('autoa').style.display = 'none';
    document.getElementById('manua').style.display = 'flex';

});
</script>


<script src="./jquery.js"></script>








<?php
}
else{
  header('location:../index.php');
}
?>