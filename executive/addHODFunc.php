
<?php

require_once('../connection.php');




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
            $hod_username = $get_roll[0];
            echo 'USERNAME: '.$hod_username;

            
            $get_roll = explode("@",$getsheet[$i][1]);  
            $hod_password = $get_roll[0];
            echo "PASSWORD".$hod_password."<br>";
            $get_roll = explode("@",$getsheet[$i][2]);  
            $hod_email = $get_roll[0];
            
            $get_roll = explode("@",$getsheet[$i][3]);  
            $hod_number = $get_roll[0];


            $get_roll = explode("@",$getsheet[$i][4]);  
            $hod_name = $get_roll[0];

            $get_roll = explode("@",$getsheet[$i][5]);  
            $hod_dept = $get_roll[0];



            // $teacher_name;
                $usertype_query = "INSERT INTO `usertype_2_info`(`username`, `user_displayname`, `user_email`, `user_number`, `user_depart`) VALUES
                 ('$hod_username','$hod_name','$hod_email','$hod_number','$hod_dept')";
                $login_queray = "INSERT INTO `login_info`(`username`, `user_password`, `user_type`, `user_first`) VALUES 
                ('$hod_username','$hod_password','2','a')";
                if($con -> query($usertype_query)){
                    echo "GREAT";
                }
                else{
                    echo "AA";
                }
                if($con -> query($login_queray)){
                    echo "SDAD";
                }
                else{
                    echo "FALSE";
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
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <title>Dashboard</title>
</head>

<body>
    <div class="dashboard">
        <div class="sidebar " id="sidebar">
            <div class="sidebar-inner " id="sidebar-inner">
                <p>D.A.M.S</p>
                <hr>
                <div class="row-sidebar">
                 <a href="./index.php">   <i class="far fa-user-circle icon-sidebar"></i>
                    <div class="row-sidebar-text name-bar ">
                        Admin
                    </div>
    </a>            </div>
                <hr>
                <div class="row-sidebar selected-sidebar profile">
                    <i class="fas fa-university icon-sidebar "></i>
                    <div class="row-sidebar-text ">
                        ADD
                    </div>
                </div>
                <div id="drop-down-profile" class="row-sidebar-profile">
                    <div class="row-sidebar">
                        <i class="fas fa-download icon-sidebar"></i>
                        <div class="row-sidebar-text ">
                            Subject
                        </div>
                    </div>
                    <div class="row-sidebar">
                        <i class="fas fa-download icon-sidebar"></i>
                        <div class="row-sidebar-text ">
                            User
                        </div>
                    </div>
                    <div class="row-sidebar">
                        <i class="fas fa-download icon-sidebar"></i>
                        <div class="row-sidebar-text ">
                            Student
                        </div>
                    </div>
                    <div class="row-sidebar">
                        <i class="fas fa-download icon-sidebar"></i>
                        <div class="row-sidebar-text ">
                            Department
                        </div>
                    </div>
                    <div class="row-sidebar">
                        <i class="fas fa-download icon-sidebar"></i>
                        <div class="row-sidebar-text ">
                            Batch
                        </div>
                    </div>

                </div>

                <div class="row-sidebar">
                    <i class="fas fa-building icon-sidebar"></i>
                    <div class="row-sidebar-text ">
                        Upload Timetable
                    </div>
                </div>
                <div class="row-sidebar">
                    <i class="fas fa-users icon-sidebar"></i>
                    <div class="row-sidebar-text ">
                        Upload Compensated Table
                    </div>
                </div>
                <div class="row-sidebar">
                    <i class="fas fa-user-friends icon-sidebar"></i>
                    <div class="row-sidebar-text ">
                        Delete Subject
                    </div>
                </div>
                <div class="row-sidebar">
                    <i class="fas fa-book icon-sidebar"></i>
                    <div class="row-sidebar-text ">
                        Delete Teacher
                    </div>
                </div>
                <div class="row-sidebar">
                    <i class="fas fa-download icon-sidebar"></i>
                    <div class="row-sidebar-text ">
                        Delete Student
                    </div>
                </div>
                <div class="row-sidebar">
                    <i class="fas fa-sign-out-alt icon-sidebar"></i>
                    <div class="row-sidebar-text ">
                        Edit Profile
                    </div>
                </div>
                <div class="row-sidebar">
                    <i class="fas fa-sign-out-alt icon-sidebar"></i>
                    <div class="row-sidebar-text ">
                        Logout
                    </div>
                </div>


            </div>





        </div>
        <div class="dashboard-inner " id="main-bar">
            <div class="dashboard-inner-top">
                <h2>
                    All the Head of Departments are Uploaded Successfully
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
    $('#selectDeparta').change(function () {
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


    $('#selectBatch').change(function () {
        $('#best-batch-heading').css('display', 'none');
        $('#best-batch-div').css('display', 'none');
        $('#batch-heading').css('display', 'flex');
        $('#batch-div').css('display', 'flex');
    });

    $('#chkTest').click(function () {
        if (b == 'red') {
            b = 'green';
        }
        else {
            b = 'red';
        }

    });









    // automaic
    way = 'red';
    $('#way').click(function () {
        if (way == 'red') {
            document.getElementById('manual').style.display = 'flex';
            document.getElementById('automatic').style.display = 'none';
            way = 'green';
        }
        else {
            document.getElementById('automatic').style.display = 'flex';
            document.getElementById('manual').style.display = 'none';
            way = 'red';
        }

    });

    // attendace template to be put in loop
    var switchStatus = false;
    $(".students_present").on('change', function () {
        if ($(this).is(':checked')) {
            switchStatus = $(this).is(':checked');
        }
        else {
            switchStatus = $(this).is(':checked');
        }
    });


    $("#selectDepart").change(function () {
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
    btn.onclick = function () {
        modal.style.display = "flex";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
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
       

        
           





?>
