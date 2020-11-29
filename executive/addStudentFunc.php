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
    if($user_level != '2'){
        header('location:../wellcome.php');
    }

$get_recent_term_Q  = mysqli_query($con,"SELECT `term_name`,`term_id` FROM `term` WHERE 1");
while($row = mysqli_fetch_assoc($get_recent_term_Q)){
    $term_name = $row['term_name'];
    $term_id = $row['term_id'];
}
$term =  $term_id;
$dept =  $_POST['dept'];
$batch =  $_POST['batch'];
$section =  $_POST['section'];
$table_name = $dept."_".$batch."_".$term."_".$section."_students";
// echo $table_name;
$create_table = "CREATE TABLE $table_name(
    student_rollnumber INT(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    student_name VARCHAR(100) NOT NULL,
    student_email VARCHAR(100),
    student_fathername VARCHAR(100),
    student_mobile VARCHAR(100),
    student_id VARCHAR(100) NOT NULL UNIQUE
)";

if($con -> query($create_table)){
    // echo "GE";
}
else{
    // echo "AA";
}


    if(!isset($_POST['deptS'])){
        header("location:./automatic.php");
    }

    include("../Classes/PHPExcel/IOFactory.php");  

    $allowed = array('.xlsx');
    $filename = $_FILES['excelFile']['name'];
    $file = explode(".",$filename);
    $filename = $file[1];
   


    if(isset($_FILES['excelFile']) && !empty($_FILES['excelFile']['tmp_name'])){
        $excelObject = PHPExcel_IOFactory::load($_FILES['excelFile']['tmp_name']);
        $getsheet = $excelObject->getActiveSheet()->toArray(null);
        // echo "<pre>";
        $file = $_FILES['excelFile']['tmp_name'];
        $readerType = 'Excel2007';
        $reader = PHPExcel_IOFactory::createReader($readerType);
        $PHPExcel = $reader->load($file);
        $sheet = $PHPExcel->getSheet(0);
        
        $highestRow = $sheet->getHighestRow();
        $counter = 1;
        for($i=0;$i<$highestRow;$i++){
            
            $get_roll = explode("@",$getsheet[$i][0]);  
            $student_name = $get_roll[0];
            // echo "NAME".$student_name."&nbsp";

            $get_roll = explode("@",$getsheet[$i][1]);  
            $student_email = $get_roll[0];
            // echo "EMAIL".$student_email."&nbsp";

            $get_roll = explode("@",$getsheet[$i][2]);  
            $student_fathername = $get_roll[0];
            // echo "FATHER".$student_fathername."&nbsp";
            
            $get_roll = explode("@",$getsheet[$i][3]);  
            $student_number = $get_roll[0];
            // echo "NUMBER".$student_number."&nbsp";

            
            $get_roll = explode("@",$getsheet[$i][4]);  
            $student_id = $get_roll[0];
            // echo "ID".$student_id."<BR>";
            $student_table_query = "INSERT INTO $table_name (`student_name`, `student_email`, `student_fathername`, `student_mobile`, `student_id`)  VALUES 
            ('$student_name','$student_email','$student_fathername','$student_number','$student_id')";
            if($con -> query($student_table_query)){
                // echo $student_id;
            }
            // if($con -> query($teacher_table_query)){
            //     $teacher_name_id  = mysqli_query($con,"SELECT `teacher_id` FROM `teacher` WHERE teacher_name = '$teacher_name'");
            //     while($row = mysqli_fetch_assoc($teacher_name_id)){
            //         $teacher_id = $row['teacher_id'];
            //     }
            //     $usertype_query = "INSERT INTO `usertype_3_info`(`username`, `user_displayname`, `user_email`, `user_number`, `user_teacherid`) VALUES
            //      ('$teacher_username','$teacher_name','$teacher_email','$teacher_number','$teacher_id')";
            //     $login_query = "INSERT INTO `login_info`(`username`, `user_password`, `user_type`, `user_first`) VALUES ('$teacher_username','$teacher_password','3','a')";

            //     $con -> query($usertype_query);
            //     $con -> query($login_query);

            // }            
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
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <title>Dashboard</title>
</head>

<body>
    <div class="dashboard">
       <?php require_once("./sidebar.php"); ?>
        <div class="dashboard-inner " id="main-bar">
            <div class="dashboard-inner-top">
                <h2>
                    All the Students of <?php echo $dept ?> are Uploaded Successfully
                </h2>
                <a href="./index.php" style="text-align:center">

                    <h3>
                        Back to Dashboard
                    </h3>
                </a>

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
b = 'red';
status = [];
$('#selectDeparta').change(function() {
    // $('#best-batch-heading').css('display', 'none');
    // $('#best-batch-div').css('display', 'none');
    // $('#batch-heading').css('display', 'flex');
    // $('#batch-div').css('display', 'flex');
    $('#student_name_div').css('display', 'flex');
    number_of_students = document.getElementById('totalnumberofstudents').value;
    for (i = 0; i > number_of_students; i++) {
        status.push('present');
    }

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
$('#way').click(function() {
    if (way == 'red') {
        document.getElementById('manual').style.display = 'flex';
        document.getElementById('automatic').style.display = 'none';
        way = 'green';
    } else {
        document.getElementById('automatic').style.display = 'flex';
        document.getElementById('manual').style.display = 'none';
        way = 'red';
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

});
</script>

<!-- pop up code -->
<script>
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "flex";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script src="./jquery.js"></script>





<script>
function get(ida) {
    alert(ida);
}
</script>
<?php
        
        



    }
       

        
           





// ?>

<?php
}
else{
    header("location:../login.html");

}