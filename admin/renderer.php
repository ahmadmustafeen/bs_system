<?php
if(isset($_POST['dept_id']) && isset($_POST['batch_id'])){
    $dept_id = $_POST['dept_id'];
    $batch_id = $_POST['batch_id'];
    // echo $dept_id;
    header("location:./showClassAttendance.php?dept_id=".$dept_id."&batch_id=".$batch_id);
}

?>