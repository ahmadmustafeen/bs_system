<?php
require_once('../connection.php');
include_once("../functions/queryToArr.php");
include_once("../functions/calculatingAttendance.php");

// authentication to be done here...




$term_Q="SELECT `term_id` FROM `term` WHERE 1";
$applyQuery  = mysqli_query($con,$term_Q);
while($row = mysqli_fetch_assoc($applyQuery)){
    $term_id = $row['term_id'];
}



// null will be replaced by code to send it back
$_GET['dept_id']?($getDept = $_GET['dept_id']):null;
$_GET['batch_id']?($getBatch = $_GET['batch_id']):null;
$query="SELECT `period_id`,`subject_id`,`section` FROM `period_table_normal` WHERE dept_id = '$getDept' and batch_id = '$getBatch' and term_id='$term_id'";

$get_department = mysqli_query($con,"SELECT `department_name` from `department` where department_id = '$getDept'");
while($row = mysqli_fetch_assoc($get_department)){
    $department_name =  $row['department_name'];
} 
$get_batch = mysqli_query($con,"SELECT `batch_name` from `batch` where batch_id = '$getBatch'");
while($row = mysqli_fetch_assoc($get_batch)){
    $batch_name =  $row['batch_name'];
}

// get all the period id based on dept and batch

$period_ids_data = queryToArr($con,$query,['period_id',"subject_id","section"]);




// getting all the table name from where data will be extracted
$duplicate_table_name = [];
foreach($period_ids_data as $data) {
    $explode = explode(" ",$data);
    $period_id=  "period_id ".$explode[1];
    array_push($duplicate_table_name,$getDept."_".$getBatch."_".$explode[3]."_".$term_id."_".$explode[5]."_attendance");
}
// excluding all the duplications
$table_name = array_unique($duplicate_table_name);

if(sizeof($table_name)===0){ header("location:./index.php?no_Record_found=1");}
$check = explode("_",$table_name[0]);
$student_table = $check[0]."_".$check[1]."_".$check[3]."_".$check[4]."_students";
// echo $student_table;

    



$lecture_ids = [];
// get all lecture_id based on dates
foreach ($period_ids_data as $period_id_data){
    // echo $period_id_data;
    $explode = explode(" ",$period_id_data);
    $period_id=  $explode[1];
    // echo "period_id ".$period_id;
    $query="SELECT `lecture_id`,`lecture_date` FROM `lecture_details` WHERE period_id = '$period_id'";
    $lecture_id =  queryToArr($con,$query,['lecture_id',"lecture_date"]); 
    array_push($lecture_ids,$lecture_id);
}  



$complete_class_response = [];
foreach($table_name as $data){
    // echo $data;
    $tablearr =  calculatingAttendance($con,$data,$student_table);
    array_push($complete_class_response,$tablearr);
} 

// foreach($complete_class_response as $class_response){
    
// }








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
    <title>Dashboard</title>
</head>




<body>
    <div class="dashboard select-admin-main">
       
       
            <?php
            include_once("./sidebar.php");
                $present = [];
                $absent = [];
                $student_id = [];
                $student_name = [];
                  foreach($complete_class_response as $class_responses){
                      $i=0;
                    foreach($class_responses as $class_response){
                        
                        if(isset($present[$i])){
                            $present[$i] = $present[$i] + $class_response[2];
                            $absent[$i] = $absent[$i] + $class_response[3];
                        }
                        else{
                            array_push($student_name,$class_response[0]);
                            array_push($student_id,$class_response[1]);
                            array_push($present,$class_response[2]);
                            array_push($absent,$class_response[3]);

                        }
                        $i++;
                    }

                }
                ?>
       
        <div class="dashboard-inner " id="main-bar">
            <div class="floating-menu">
                <button id="floating">X</button>
            </div>
            <div class="depart-admin depart-admin-select">
                <h2>
                    Class Wise Report
                </h2>
            </div>
            <div class="dit-class-students confirm" style="margin-top:100px">
                <div class="table-header" style="display:flex;flex-direction:column;justify-content:center;width:80%;align-self:center;">
                    <div class="table-h-row" >
                        <h2> <span class="heading-table-r">Department:</span> <?php echo $department_name?>
                        </h2>
                    </div>
                    <div class="table-h-row">
                        <h2> <span class="heading-table-r">Batch:</span>  <?php echo $batch_name?> </h2>
                        </h2>
                    </div>
                    <div class="table-h-row">
                        <h2> <span class="heading-table-r">Number of Classes (conducted):</span> <?php echo $present[0] ?> </h2>
                        <!-- <h2> <span class="heading-table-r">Number of Classes (missed):</span> <?php echo sizeof($complete_class_response[0][2]); ?> </h2> -->
                    </div>
                </div>
                <table id='students'>
                    <tr>
                        <td class='table-name'>Serial No.</td>
                        <td class='table-name'>Student Name</td>
                        <td>Student ID</td>
                        <td>Present(in classes)</td>
                        <td>Status</td>

                    </tr>
                 <?php 
                 for($i=0;$i<(sizeof($present));$i++){
                     $name = $student_name[$i];
                     $id = $student_id[$i];
                     $student_present = $present[$i];
                     $student_absent = $absent[$i];
                    $student_present_percent = ($student_present===0)?0: ((($student_present)/($student_present+$student_absent))*100);
                ?>
                 
                    <tr>
                      
                        <td><?php echo($i+1)?></td>
                        <td><?php echo $name?></td>
                        <td><?php echo $id?></td>
                        <td ><?php echo $student_present?></td>
                        <td ><?php echo round($student_present_percent)?>%</td>
                    </tr>
                    <?php
                     }
                    ?>
                   
                </table>
                <a href="./index.php">
                <button >
                    Back to Dashboard
                    </button>
                </a>
              
           
            </div>






        </div>
    </div>


    
    <!-- 
        [
            [
                [name],[id],[present],[absent]
            ],
            [
                [name],[id],[present],[absent]

            ], 
            [
                [name],[id],[present],[absent]

            ], 
            [
                [name],[id],[present],[absent]

            ], 
            [
                [name],[id],[present],[absent]

            ],    
        ]




     -->






    <script src="https://kit.fontawesome.com/407fccd64e.js" crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>

<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
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
</script>
