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





$dept =  $_GET['dept'];
$batch = $_GET['batch'];
$period_Q  = mysqli_query($con,"SELECT * FROM `period_table_normal` WHERE dept_id = '$dept' and batch_id = '$batch'");

// $dept = 'ch';
// $batch = 19;
// get the period id using this

// $period_Q  = mysqli_query($con,"SELECT `section`, `timing_id`, `teacher_id` , `subject_id`, `day_id` FROM `period_table_normal` WHERE dept_id='$dept' and batch_id='$batch'");
//     while($row = mysqli_fetch_assoc($period_Q)){
//         // $period_id = $row['period_id'];
//         $section = $row['section'];
//         $timing_id = $row['timing_id'];
//         $teacher_id = $row['teacher_id'];
//         $subject_id = $row['subject_id'];
//         $day_id = $row['day_id'];

//     }
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="../assests/style/teacher-portal.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <script>
    $('.profile').click(function() {
        if (
            $("#drop-down-profile").hasClass('row-sidebar-profile')) {
            $("#drop-down-profile").addClass('row-sidebar-profile-display');
            $("#drop-down-profile").removeClass('row-sidebar-profile');
        } else {
            $("#drop-down-profile").addClass('row-sidebar-profile');
            $("#drop-down-profile").removeClass('row-sidebar-profile-display');
        }
    });

    // hover function only if width is above 768px
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
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assests/style/dashboard-index.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <title>View Timetable</title>
</head>




<body>
    <div class="dashboard select-admin-main">
        <?php
            include_once("./sidebar.php");
            $Department_Q  = mysqli_query($con,"SELECT  `department_name` FROM `department` WHERE department_id='$dept'");
            while($row = mysqli_fetch_assoc($Department_Q)){
            $department_name = $row['department_name'];
            }
             $batch_Q  = mysqli_query($con,"SELECT  `batch_name` FROM `batch` WHERE batch_id='$batch'");
            while($row = mysqli_fetch_assoc($batch_Q)){
            $batch_name = $row['batch_name'];
            }

?>

        <div class="dashboard-inner " id="main-bar">
            <div class="depart-admin depart-admin-select">
                <h2>
                   Department <?php echo $department_name ?><br> Batch <?php echo $batch_name ?> <br> Time table
                </h2>
            </div>
            <div class="floating-menu">
                    <button id="floating">X</button>
                </div>

            <div class="dit-class-students confirm" style="margin-top:100px">

                <table id='students'>
                    <tr>
                    <td>Period Id</td>
                        <td class='table-name'>Subject.</td>
                        <td class='table-name'>Teacher</td>
                        <td>Section</td>
                        <td>Timing</td>
                        <td>Day</td>
                        <td>Credit Hour</td>
                    </tr>
                <?php
while($row = mysqli_fetch_assoc($period_Q)){
    // declaration
    $section = $row['section'];
    $period = $row['period_id'];
    $timing_id = $row['timing_id'];
    $teacher_id = $row['teacher_id'];
    $subject_id = $row['subject_id'];
    $day_id = $row['day_id'];
    $credit_hour = $row['credit_hour'];
    
    $term_Q  = mysqli_query($con,"SELECT `term_id`, `term_name` FROM `term` WHERE 1");
        while($row = mysqli_fetch_assoc($term_Q)){
        $term_id = $row['term_id'];
        }
    $subject_Q  = mysqli_query($con,"SELECT * FROM `subject` WHERE subject_id='$subject_id'");
        while($row = mysqli_fetch_assoc($subject_Q)){
        $subject_name = $row['subject_name'];
        }
        $teacher_Q  = mysqli_query($con,"SELECT * FROM `teacher` WHERE teacher_id='$teacher_id'");
        while($row = mysqli_fetch_assoc($teacher_Q)){
        $teacher_name = $row['teacher_name'];
        }
         $day_Q  = mysqli_query($con,"SELECT * FROM `day` WHERE day_id='$day_id'");
        while($row = mysqli_fetch_assoc($day_Q)){
        $day_name = $row['day_name'];
        }
        $timing_id_Q  = mysqli_query($con,"SELECT * FROM `period` WHERE period_id='$timing_id'");
        while($row = mysqli_fetch_assoc($timing_id_Q)){
        $timing_name = $row['period_name'];
        }
?>
        <tr>
        <td><?php echo $period ?></td>
        <td><?php echo $subject_name ?></td>
        <td><?php echo $teacher_name ?></td>
        <td><?php echo $section ?></td>
        <td><?php echo $timing_name ?></td>
        <td><?php echo $day_name ?></td>
        <td><?php echo $credit_hour ?></td>
    </tr>

<?php




}






?>     


                </table>
                <a href="./index.php">
                    <button>
                        Back to Dashboard
                    </button>
                </a>


            </div>






        </div>
    </div>











</body>
<script src="https://kit.fontawesome.com/407fccd64e.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>

<script src="../assests/script/dashbaord.js"></script>

</html>


<script src="https://kit.fontawesome.com/407fccd64e.js" crossorigin="anonymous"></script>
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
</script><?php
}

                    
else{
    header("../login.html");
}



                    ?>