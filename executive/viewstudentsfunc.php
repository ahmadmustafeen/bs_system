<?php
include_once("../connection.php");

session_start();


// $dept= strtolower($dept);

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

// authentication to be done here...


// get department and batch id and section
   $dept =  $_POST['dept'];
   $batch = $_POST['batch'];
 
// get department name
$depart_Q = mysqli_query($con,"SELECT `department_name` FROM `department` WHERE department_id = '$dept'");
while($row = mysqli_fetch_assoc($depart_Q)){
    $department_name = $row['department_name'];
}

//get batch name
$batch_Q = mysqli_query($con,"SELECT `batch_name` FROM `batch` WHERE batch_id = '$batch'");
while($row = mysqli_fetch_assoc($batch_Q)){
    $batch_name = $row['batch_name'];
}

//get section
$section_Q = mysqli_query($con,"SELECT `section` FROM `period_table_normal` WHERE 1");
while($row = mysqli_fetch_assoc($section_Q)){
    $section = $row['section'];
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
      <?php require_once("./sidebar.php") ?>
        <div class="dashboard-inner " id="main-bar">
                <div class="floating-menu">
                    <button id="floating">X</button>
                </div>
                <div class="dashboard-inner-teacher-top">
                <h2>
                   Department Of <?php echo $department_name ?><br> Batch <?php echo $batch_name ?> <br> Students List
                </h2>
                </div>

                <div class="dit-class-students confirm" style="margin-top:100px">
                    <table id='students'>
                        <tr>
                            <td class='table-name'>Serial Number</td>
                            <td class='table-name'>Student Name</td>
                            <td>Student ID</td>
                        </tr>
                        <?php
                        

$get_recent_term_Q  = mysqli_query($con,"SELECT `term_name`,`term_id` FROM `term` WHERE 1");
while($row = mysqli_fetch_assoc($get_recent_term_Q)){
    $term_name = $row['term_name'];
    $term_id = $row['term_id'];
}

$students_details = $dept."_".$batch."_".$term_id."_".$section."_students";

$students_Q  = mysqli_query($con,"SELECT `student_name`,`student_id` FROM `$students_details` WHERE 1");

$i=1;
while($row = mysqli_fetch_assoc($students_Q)){
    $student_name = $row['student_name'];
    $student_id = $row['student_id'];

    echo '<tr>
    <td>'.$i.'</td><td>'.$student_name.'</td><td>'.$student_id.'</td>
    </tr>';
    $i++;
    
}

    ?>

                        <?php
}

                        ?>
                    </table>  
                    <div class="button-col">
                    <a href="./index.php">
                        <button>Back To Dashboard</button>
                    </a>
                </div>
                </div>
            </div>
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