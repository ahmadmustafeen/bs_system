<?php
include_once('../connection.php');

session_start();
date_default_timezone_set("Asia/Karachi");
if(isset($_SESSION['User']))
{
    $username = $_SESSION['User'];
    $user_level_Q  = mysqli_query($con,"SELECT `user_type` FROM `login_info` WHERE username = '$username'");
    while($row = mysqli_fetch_assoc($user_level_Q)){
        $user_level = $row['user_type'];
    }
    if($user_level != '1'){
        header('location:../wellcome.php');
    }






$departments = [];
$batchs = [];
$department_Q = mysqli_query($con,"SELECT `department_name`,`department_id` from `department` where 1");
while($row = mysqli_fetch_assoc($department_Q)){
    $department_name =  $row['department_name'];  
    $department_id =  $row['department_id']; 
    $arr = [$department_id,$department_name];
    array_push($departments,$arr);
 }
 $batch_Q = mysqli_query($con,"SELECT `batch_name`,`batch_id` from `batch` where 1");
 while($row = mysqli_fetch_assoc($batch_Q)){
     $batch_name =  $row['batch_name'];  
     $batch_id =  $row['batch_id']; 
     $arr = [$batch_id,$batch_name];
     array_push($batchs,$arr);
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assests/style/dashboard-index.css">
    <link rel="stylesheet" href="../assests/style/teacher-portal.css">
    <script src="../assests/script/dashbaord.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>



<?php if(isset($_GET['no_Record_found'])){
            ?>
        <script>
        alert("Class does'nt exist!");
        </script>
        <?php
            }?>
<body>
    <div class="dashboard">
        <?php include_once("./sidebar.php") ?>
        <div class="dashboard-inner select-admin-main" id="main-bar">
            <div class="floating-menu">
                <button id="floating">X</button>
            </div>

            <div class="dashboard-inner-main-graph">
                Dawood Attendance Management System
            </div>

            <div class="dashboard-inner-teacher dashboard-dit-heading">
                <div class="dit-heading">
                    <form action="renderer.php" method="post">
                        <table>
                            <tr>
                                <td>
                                    <h3>Select Department</h3>
                                </td>
                                <td>
                                    <Select name="dept_id" id="dept_id">

                                        <option>Select from Available Department
                                        </option>
                                        <?php
                                    foreach($departments as $department){
                                        $department_id = $department[0];
                                        $department_name = $department[1];
                                    ?>
                                        <option name="dept_id" value="<?php echo $department_id?>">
                                            <?php echo $department_name ?></option>
                                        <?php
                                    }

                                    ?>

                                    </Select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>Select Batch</h3>
                                </td>
                                <td>
                                    <Select name="batch_id" id="batch">
                                        <option disabled>Select from Available Batch</option>
                                        <?php
                                    foreach($batchs as $batch){
                                        $batch_id = $batch[0];
                                        $batch_name = $batch[1];
                                    ?>
                                        <option name="batch_id" value="<?php echo $batch_id?>"><?php echo $batch_name ?>
                                        </option>
                                        <?php
                                    }

                                    ?>
                                    </Select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="button-col">
                                        <form action="./showAttendanceClass.php" method="POST">
                                            <input type="text" value="" name="period_id" id="period_id"
                                                style="display:none">
                                            <button type="submit" name="dept">Show</button>
                                        </form>
                                    </div>
                                </td>



                            </tr>


                        </table>
                    </form>
                </div>
            </div>





        </div>
</body>

</html>

<style>
*,
*::before,
*::after {
    box-sizing: border-box
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
}

.avatar {
    min-width: 200px;
    border-radius: 50%;
    background-size: cover;
    background-position: center;
    position: relative;
}

.avatar::before,
.avatar::after {
    --scale: 0;
    --arrow-size: 20px;
    --tooltip-color: #2196f3;
    position: absolute;
    z-index: 999;
    top: -.25rem;
    font-size: 18px !important;
    font-weight: 400 !important;
    left: 50%;
    transform: translateX(-50%) translateY(var(--translate-y, 0)) scale(var(--scale));
    transition: 150ms transform;
    transform-origin: bottom center;
}

.avatar::before {
    --translate-y: calc(-100% - var(--arrow-size));
    content: attr(data-tooltip);
    color: white;
    padding: .5rem;
    border-radius: .3rem;
    text-align: center;
    width: max-content;
    max-width: 100%;
    background: var(--tooltip-color);
}

.avatar:hover::before,
.avatar:hover::after {
    --scale: 1;
}

.avatar::after {
    --translate-y: calc(-1 * var(--arrow-size));

    content: '';
    border: var(--arrow-size) solid transparent;
    border-top-color: var(--tooltip-color);
    transform-origin: top center;
}
</style>



<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
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







<script src="https://kit.fontawesome.com/407fccd64e.js" crossorigin="anonymous"></script>
</body>
<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
<!-- <script src="../assests/script/dashbaord.js"></script> -->
<!-- <script src="./jquery.min.js"></script> -->

</html>
<?php
}
else{
    header("location:../login.html");

}