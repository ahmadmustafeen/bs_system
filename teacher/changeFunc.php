<?php
require_once('../connection.php');
session_start();
if(isset($_SESSION['User']))
{
    $username = $_SESSION['User'];
    // echo $username;
    $password = $_POST['Password'];
    $password = md5($password);
    // echo $password;
    $query = "UPDATE `login_info` SET `user_password`='$password' where username = '$username'";
    if($con -> query($query)){
        
    }




}
else{
    header('location:../index.php');
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
                        <a href="./attendance-eng.html">

                            <i class="fas fa-file-upload icon-sidebar"></i>
                            <div class="row-sidebar-text ">
                                View Attendance
                            </div>
                        </a>
                    </div>
                    <div class="row-sidebar">
                        <a href="./attendance-eng.html">

                            <i class="fas fa-unlock-alt icon-sidebar"></i>
                            <div class="row-sidebar-text ">
                                Change Password
                            </div>
                        </a>
                    </div>

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
                    <h2 style="text-align: center;">
                        Your Password is updated Successfully.
                    </h2>
                    <a href="./index.php">
                        <button>
                            Back To Dashboard
                        </button>
                    </a>
                    <a href="../logout.php">
                        <button>
                            Logout
                        </button>
                    </a>


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