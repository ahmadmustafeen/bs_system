<?php
include_once("../connection.php");



$dept =  $_POST['dept'];
$batch = $_POST['batch'];
$dept= strtolower($dept);
// get the period id using this

$period_Q  = mysqli_query($con,"SELECT `section`, `timing_id`, `teacher_id` , `subject_id`, `day_id` FROM `period_table_normal` WHERE dept_id='$dept' and batch_id='$batch'");
    while($row = mysqli_fetch_assoc($period_Q)){
        // $period_id = $row['period_id'];
        $section = $row['section'];
        $timing_id = $row['timing_id'];
        $teacher_id = $row['teacher_id'];
        $subject_id = $row['subject_id'];
        $day_id = $row['day_id'];

?>
    <table>
        <?php



        $subject_Q  = mysqli_query($con,"SELECT * FROM `subject` WHERE subject_id='$subject_id'");
    while($row = mysqli_fetch_assoc($subject_Q)){
       $subject_name = $row['subject_name'];
    //    echo $subject_name;
    }


        $teacher_Q  = mysqli_query($con,"SELECT * FROM `teacher` WHERE teacher_id='$teacher_id'");
    while($row = mysqli_fetch_assoc($teacher_Q)){
       $teacher_name = $row['teacher_name'];
    //    echo $teacher_name;
    }

    $day_Q  = mysqli_query($con,"SELECT * FROM `day` WHERE day_id='$day_id'");
    while($row = mysqli_fetch_assoc($day_Q)){
       $day_name = $row['day_name'];
    //    echo $day_name;
    }

?>

    
        <tr>
            <td></td>
            <td>
                
                <?php echo $day_name; ?>
</td>
</tr>
<tr>
    <td>
    
</td>
<td>
    <?php echo $subject_name;  
    echo "\r\n";
    echo $teacher_name;?>
</td>
<td>
    <?php echo $section; ?>
</td>
</tr>
<?php
}
?>
</table>