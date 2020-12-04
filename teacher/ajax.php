<?php

require_once('../connection.php');
if(isset($_POST['id'])){
    
date_default_timezone_set("Asia/Karachi");
        $get_recent_term_Q  = mysqli_query($con,"SELECT `term_name`,`term_id` FROM `term` WHERE 1");
    while($row = mysqli_fetch_assoc($get_recent_term_Q)){
        $term_name = $row['term_name'];
        $term_id = $row['term_id'];
    }
    $term =  $term_id;
    $period_ID = $_POST['id'];
    $period_ID_Q  = mysqli_query($con,"SELECT `dept_id`,`batch_id`,`section`,`teacher_id`,`timing_id`,`day_id`,`subject_id` FROM `period_table_normal` WHERE period_id = '$period_ID'");
    while($row = mysqli_fetch_assoc($period_ID_Q)){
        $dept_id = $row['dept_id'];
        $batch_id = $row['batch_id'];
        $section = $row['section'];
        $teacher_id = $row['teacher_id'];
        $timing_id = $row['timing_id'];
        $day_id = $row['day_id'];  
        $subject_id = $row['subject_id'];
    }







    // getting name
    $batch_name_Q  = mysqli_query($con,"SELECT `batch_name` FROM `batch` WHERE batch_id = '$batch_id'");
    while($row = mysqli_fetch_assoc($batch_name_Q)){
        $batch_name = $row['batch_name'];
    }
    $dept_name_Q  = mysqli_query($con,"SELECT `department_name` FROM `department` WHERE department_id = '$dept_id'");
    while($row = mysqli_fetch_assoc($dept_name_Q)){
        $department_name = $row['department_name'];
    }
   
    $teacher_name_Q  = mysqli_query($con,"SELECT `teacher_name` FROM `teacher` WHERE teacher_id = '$teacher_id'");
    while($row = mysqli_fetch_assoc($teacher_name_Q)){
        $teacher_name = $row['teacher_name'];
    }
    $period_name_Q  = mysqli_query($con,"SELECT `period_name` FROM `period` WHERE period_id = '$timing_id'");
    while($row = mysqli_fetch_assoc($period_name_Q)){
        $period_name = $row['period_name'];
    }
    $day_id_Q  = mysqli_query($con,"SELECT `day_name` FROM `day` WHERE day_id = '$day_id'");
    while($row = mysqli_fetch_assoc($day_id_Q)){
        $day_name = $row['day_name'];
    }
    $subject_name_Q  = mysqli_query($con,"SELECT `subject_name` FROM `subject` WHERE subject_id = '$subject_id'");
    while($row = mysqli_fetch_assoc($subject_name_Q)){
        $subject_name = $row['subject_name'];
    }


    $date = date('Y-m-d');
    // echo $date;
    $dayOfWeek = date("l", strtotime($date));
    $dayOfWeek = ucfirst($dayOfWeek);
    // $nu = 2;
    switch($day_name){
        case 'Monday':
            $nu = 1;
        break;
        case 'Tuesday':
            $nu = 2;
        break;
        case 'Wednesday':
            $nu = 3;
        break;
        case 'Thursday':
            $nu = 4;
        break;
        case 'Friday':
            $nu = 5;
        break;
        case 'Saturday':
            $nu = 6;
        break;
    }

    if($dayOfWeek == $day_name){
       $date = date('Y-m-d');
    }
    else{
       $date = date('Y-m-d', strtotime(' -1 day'));
    }






    $table_name =  $dept_id.'_'.$batch_id.'_'.$term.'_'.$section.'_students';
    // $table_name = 'cs_4_1_a_students';
    
   echo '
   <input type="date" value='.$date.' name="date" style="display:none">
    <div class="table-header">  <div class="table-h-row">    <h2>   <span class="heading-table-r">Department:</span> '.$department_name.'
       </h2>  </div>  <div class="table-h-row">       <h2> <span class="heading-table-r">Batch:</span>  '.$batch_name.' </h2> <h2><span class="heading-table-r">Teacher:</span>  '.$teacher_name.'
       </h2> </div>  <div class="table-h-row">  <h2> <span class="heading-table-r">Date:</span> '.$date.'</h2><h2><span class="heading-table-r">Day:</span>  '.$day_name.'   </h2>  <h2> <span class="heading-table-r">Time:</span> '.$period_name.' </h2>
   </div> <div class="table-h-row"> <h2>  <span class="heading-table-r">Subject:</span>  '.$subject_name.' </h2> </div></div>';
    
    echo "<table style='width:100% !important'>
    <tr><td class='table-name'>Student Name</td><td>Student ID</td><td>Status</td></tr>";
    $student_name_ID  = mysqli_query($con,"SELECT `student_name`,`student_id`,`student_rollnumber` FROM `$table_name` WHERE 1");
    while($row = mysqli_fetch_assoc($student_name_ID)){
        $student_name = ucwords($row['student_name']);
        $student_id = $row['student_id'];
        $student_roll_number = $row['student_rollnumber'];
       echo "<tr >
       <td class='table-name'>
       $student_name
       </td><td>
       $student_id</td>
       <td class='get_ID'>
       <div class='attendance-switch'>
       <input type='checkbox'  id='$student_roll_number' onclick='get(this.id)' value='$student_roll_number' name='$student_roll_number'>
       <label for='$student_roll_number'>
       <span class='attendance-track students_changed' id='bustton-color'>
       </span>  </label></div></td></tr></td>";
       
    }
echo "</table>";
?>
<script>
       var student_length = <?php echo $student_roll_number ?>;
        document.getElementById('totalnumberofstudents').value = student_length;
</script>   

<?php 
}



?>