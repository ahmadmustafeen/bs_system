<?php
ini_set('max_execution_time', '0');
include_once("./connection.php");

$two_hour_time_ids = [
    '2','8','13','23','28','33','38','42','45','48','49'
];
$table_names =[];

$term_id_q  = mysqli_query($con,"SELECT `term_id`, `term_name` FROM `term` WHERE 1");
while($row = mysqli_fetch_assoc($term_id_q)){
    $term_id = $row['term_id'];
}
$get_period_table_name  = mysqli_query($con,"SELECT `dept_id`,`batch_id`,`subject_id`,`section` FROM `period_table_normal` WHERE 1");
while($row = mysqli_fetch_assoc($get_period_table_name)){
    $dept_id = $row['dept_id'];
    $batch_id = $row['batch_id'];
    $subject_id = $row['subject_id'];
    $section = $row['section'];
    $table_name=$dept_id."_".$batch_id."_".$subject_id."_".$term_id."_".$section."_attendance";
    array_push($table_names,$table_name);
}
$table_names = array_unique($table_names);
 foreach($table_names as $table_name){
     






// $table_name = "bscs_5_18_1_a_attendance";

    // $table_name = $_GET['class_name'];


// getting all the lecture ids from attendance table of that specific class
    $lecture_ids=[];
$get_details  = mysqli_query($con,"SELECT `lecture_id` FROM `$table_name` WHERE 1");
while($row = mysqli_fetch_assoc($get_details)){
    $lecture_id = $row['lecture_id'];
    array_push($lecture_ids,$lecture_id);
}



// getting the period ids from the above lecture ids
$period_ids=[];
foreach($lecture_ids as $ids){   
    $get_period  = mysqli_query($con,"SELECT `period_id` FROM `lecture_details` WHERE lecture_id='$ids'");
    while($row = mysqli_fetch_assoc($get_period)){
    $period_id = $row['period_id'];
    array_push($period_ids,$period_id);
}
}

// removing duplication to print only period id once
$period_ids = array_unique($period_ids);

if(sizeof($period_ids)!==0){
echo "record found<br>";


// iterating to find the period ids entered twice
$double_ids = [];
foreach($period_ids as $id){
    echo $id."check<br>";
    $filter_period  = mysqli_query($con,"SELECT `timing_id` FROM `period_table_normal` WHERE period_id= '$id'");
    while($row = mysqli_fetch_assoc($filter_period)){
        $timing_id = $row['timing_id'];
        foreach($two_hour_time_ids as $time){ 
            if($timing_id===$time){
                echo $id."found<br>";
                array_push($double_ids,$id);
            }

        };
    }
}

// foreach($double_ids as $ids){
//     $get_period  = mysqli_query($con,"SELECT `lecture_id`,`lecture_date` FROM `lecture_details` WHERE period_id='$ids'");
//         while($row = mysqli_fetch_assoc($get_period)){
//         $lecture_id = $row['lecture_id'];
//         echo $lecture_id." ";
//        }
//        echo "<br>";
// }

$double_lecture_ids = [];
foreach($double_ids as $ids){
    $get_period  = mysqli_query($con,"SELECT `lecture_id`,`lecture_date` FROM `lecture_details` WHERE period_id='$ids'");
    while($row = mysqli_fetch_assoc($get_period)){
    $lecture_id = $row['lecture_id'];
    $lecture_date = $row['lecture_date'];
    echo $lecture_date."<br>";
    $add_new_lecture = "INSERT INTO `lecture_details`(`period_id`, `lecture_date`, `week_id`, `term_id`) VALUES ('$ids','$lecture_date','0','1')";
    if($con->query($add_new_lecture)){
        echo $table_name."<br>";
        $get_new_lecture_id  = mysqli_query($con,"SELECT `lecture_id` FROM `lecture_details` WHERE 1 order by lecture_id ASC");
        while($row = mysqli_fetch_assoc($get_new_lecture_id)){
        $lecture_id_new = $row['lecture_id'];
        }
        echo $lecture_id_new."lecture_id_new";
        $add_new_lecture_attendance = "INSERT INTO `$table_name`(`lecture_id`) VALUES ('$lecture_id_new')";
        $con -> query($add_new_lecture_attendance);
    }
    for($i=1;$i<151;$i++){
        $a="a".$i;
        $get_lecture_details  = mysqli_query($con,"SELECT `$a` FROM `$table_name` WHERE lecture_id='$lecture_id'");
        while($row = mysqli_fetch_assoc($get_lecture_details)){
         $status = $row[$a]; 
         $update_Q="UPDATE `$table_name` SET `$a`='$status' where lecture_id = '$lecture_id_new'";
         $con->query($update_Q);  
         if($status!== null){
          } 
        }
    }
}
}

 }

 

else{
echo "no record found";    
}
echo "$table_name<br><br><br><br><br>";
}
?>