<?php

session_start();
 
// echo $_SESSION['details'];
echo $_SESSION['pdf'];


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