<?php

require_once('../connection.php');
$department = $_POST['dept'];
$batch = $_POST['batch'];
$section = $_POST['section'];
$name = $_POST['name'];

$rollnumber = $_POST['rollnumber'];
$rollnumber = strtoupper($rollnumber);



// term id
$table = $department."_".$batch."_1_".$section."_students";
echo $table;
$get_details  = "INSERT INTO `$table`(`student_name`, `student_email`, `student_fathername`, `student_mobile`, `student_id`) VALUES ('$name','fasd@gmail.cpm','father','3424324234','$rollnumber');";

if($con -> query($get_details)){
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
                    Student  <?php echo $name ?> having student ID "<?php echo $rollnumber ?>"  added Successfully!
                </h2>
                <a href="./index.php">
                <button>Go to dashboard </button>
                </a>
            </div>
        </div>
    </div>
</body>
 <?php
}
else{
    echo"SDDAS";
}
?>