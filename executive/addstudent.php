<?php

require_once('../connection.php');
$get_depart  = mysqli_query($con,"SELECT `department_id`,`department_name` FROM `department` WHERE 1");
$get_batch  = mysqli_query($con,"SELECT `batch_id`,`batch_name` FROM `batch` WHERE 1");







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
    <title>Add Student - Admin</title>
</head>

<body>
    <div class="dashboard">
      <?php require_once("./sidebar.php") ?>
        <div class="dashboard-inner " id="main-bar">
            <div class="main-box">
                <h2>
                    Add Student
                </h2>
                <div class="main-box-inner">
                    <form action="./addStudentFunc.php" method="POST" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>
                                    <label for="dept">
                                        Select Department

                                    </label>
                                </td>
                                <td>
                                    <Select name='dept' id='dept'>
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
                                    <label for="batch">
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
                                    <label for="section">
                                        Enter Section
                                    </label>
                                </td>
                                <td>
                                    <select name="section" id="section">
                                        <option value="A" name="section">A</option>
                                        <option value="B" name="section">B</option>
                                        <option value="C" name="section">C</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Upload the Excel File</label>
                                </td>
                                <td>
                                    <input type="file" name="excelFile" id="excelFile">
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
    



<script>
function get(ida) {
    alert(ida);
}
</script>