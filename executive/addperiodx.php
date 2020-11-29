<?php

require_once('../connection.php');
$get_depart  = mysqli_query($con,"SELECT `department_id`,`department_name` FROM `department` WHERE 1");
$get_batch  = mysqli_query($con,"SELECT `batch_id`,`batch_name` FROM `batch` WHERE 1");
$get_time = mysqli_query($con,"SELECT `period_id`, `period_name` FROM `period` WHERE 1");
$get_day = mysqli_query($con,"SELECT `day_id`, `day_name` FROM `day` WHERE 1");
$get_teacher = mysqli_query($con,"SELECT `teacher_id`, `teacher_name` FROM `teacher` WHERE 1");
$get_room = mysqli_query($con,"SELECT `room_id`, `room_name` FROM `room` WHERE 1");
$get_subject = mysqli_query($con,"SELECT `subject_id`, `subject_name`, `subject_type` FROM `subject` WHERE 1");







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
    <title>Add teacher - Admin</title>
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
                        <a href="./addsubject.php">
                        <i class="fas fa-download icon-sidebar"></i>
                        <div class="row-sidebar-text ">
                            Subject
                        </div>
                        </a>
                    </div>
                    <div class="row-sidebar">
                        <a href="./addteacher.html">
                        <i class="fas fa-download icon-sidebar"></i>
                        <div class="row-sidebar-text ">
                            Add Teacher
                        </div>
                        </a>
                    
                    </div>
                    <div class="row-sidebar">
                        <a href="./addStudent.php">
                        <i class="fas fa-download icon-sidebar"></i>
                        <div class="row-sidebar-text ">
                            Student
                        </div>
                    </a>
                       
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
                    <a href="./addperiod.php">

                    <i class="fas fa-building icon-sidebar"></i>
                    <div class="row-sidebar-text ">
                        Upload Timetable
                    </div>
                    </a>
                    
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
            <div class="main-box">
                <h2>
                    Add Period Table
                </h2>
                <div class="main-box-inner">
                    <form action="./addPeriodFunc.php" method="POST" enctype="multipart/form-data">
                        <table>
                        <tr>
                                <td>
                                    <label for="dept">
                                        Select Department

                                    </label>
                                </td>
                                <td>
                                    <Select name='dept' id='dept' required>
                                        <?php
                                        while($row = mysqli_fetch_assoc($get_depart)){
                                            $department_id = $row['department_id'];
                                            $department_name = $row['department_name'];
                                        
                                        ?>
                                        <option value="<?php echo $department_id ?>" name='dept'>
                                            <?php echo $department_name ?></option>
                                        <?php
                                        }
                                        ?>
                                    </Select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="batch" required>
                                        Select Batch
                                    </label>
                                </td>
                                <td>
                                    <Select name='batch' id='batch'>
                                        <?php
                                        while($row = mysqli_fetch_assoc($get_batch)){
                                            $batch_id = $row['batch_id'];
                                            $batch_name = $row['batch_name'];
                                        
                                        ?>
                                        <option value="<?php echo $batch_id ?>" name='batch'>
                                            <?php echo $batch_name ?></option>
                                        <?php
                                        }
                                        ?>
                                    </Select>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    <label for="subject">
                                        Select subject

                                    </label>
                                </td>
                                <td>
                                    <Select name='subject' id='subject' required>
                                        <?php
                                        while($row = mysqli_fetch_assoc($get_subject)){
                                            $subject_id = $row['subject_id'];
                                            $subject_name = $row['subject_name'];
                                        
                                        ?>
                                        <option value="<?php echo $subject_id ?>" name='subject'>
                                            <?php echo $subject_name ?></option>
                                        <?php
                                        }
                                        ?>
                                    </Select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="time">
                                        Select Period

                                    </label>
                                </td>
                                <td>
                                    <Select name='time' id='time' required>
                                        <?php
                                        while($row = mysqli_fetch_assoc($get_time)){
                                            $period_id = $row['period_id'];
                                            $period_name = $row['period_name'];
                                        
                                        ?>
                                        <option value="<?php echo $period_id ?>" name='time'>
                                            <?php echo $period_name ?></option>
                                        <?php
                                        }
                                        ?>
                                    </Select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="day">
                                        Select Day
                                    </label>
                                </td>
                                <td>
                                    <Select name='day' id='day' required>
                                        <?php
                                        while($row = mysqli_fetch_assoc($get_day)){
                                            $day_id = $row['day_id'];
                                            $day_name = $row['day_name'];
                                        
                                        ?>
                                        <option value="<?php echo $day_id ?>" name='day'>
                                            <?php echo $day_name ?></option>
                                        <?php
                                        }
                                        ?>
                                    </Select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="teacher">
                                        Select Teacher
                                    </label>
                                </td>
                                <td>
                                    <Select name='teacher' id='teacher' required>
                                        <?php
                                        while($row = mysqli_fetch_assoc($get_teacher)){
                                            $teacher_id = $row['teacher_id'];
                                            $teacher_name = $row['teacher_name'];
                                        
                                        ?>
                                        <option value="<?php echo $teacher_id ?>" name='teacher'>
                                            <?php echo $teacher_name ?></option>
                                        <?php
                                        }
                                        ?>
                                    </Select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="room">
                                        Select Room
                                    </label>
                                </td>
                                <td>
                                    <Select name='room' id='room' required>
                                        <?php
                                        while($row = mysqli_fetch_assoc($get_room)){
                                            $room_id = $row['room_id'];
                                            $room_name = $row['room_name'];
                                        
                                        ?>
                                        <option value="<?php echo $room_id ?>" name='room'>
                                            <?php echo $room_name ?></option>
                                        <?php
                                        }
                                        ?>
                                    </Select>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <label for="credit">
                                        Enter Credit Hour
                                    </label>
                                </td>
                                <td>
                                    <input type="number" name="credit" id="credit" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="section">
                                        Enter Section
                                    </label>
                                </td>
                                <td>
                                <select name="section" id="section" required>
                                <option value="A"  name="section" >A</option>
                                <option value="B"  name="section" >B</option>
                                <option value="C"  name="section" >C</option>
                                </select>
                                </td>
                            </tr>
                         
                            <tr>
                                <td>

                                </td>
                                <td>
                                    <button type="submit" name='deptS'>Submit</button>

                                </td>
                            </tr>
                        </table>
                    </form>
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
b = 'red';
status = [];
$('#selectDeparta').change(function() {
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