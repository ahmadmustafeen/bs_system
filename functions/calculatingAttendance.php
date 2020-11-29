<?php

// functionality



// it takes table name then it take






function calculatingAttendance($con,$table_name,$student_table_name){  
    // echo $table_name,$student_table_name."<br>";
    $complete_class_response = [];    
    for($i=1;$i<151;$i++){
        $a = 'a'.$i;
        $valid = false;
        $get_students_details = mysqli_query($con,"SELECT `student_name`,`student_id` from `$student_table_name` where student_rollnumber = '$i'");
        while($row = mysqli_fetch_assoc($get_students_details)){
            $student_name =  $row['student_name'];  
            $student_id =  $row['student_id'];
            $valid = true; 
        }
        if($valid){ 
            $get_students_attendance = mysqli_query($con,"SELECT `$a` from `$table_name` where 1");
            $present = 0;
            $absent = 0;
            while($row = mysqli_fetch_assoc($get_students_attendance)){
                $status =  $row[$a];
                ($status === 'present')?$present++:$absent++;           
            }
            
        $reponse = [$student_name,$student_id,$present,$absent];
        // echo $reponse[0][0];
         array_push($complete_class_response,$reponse);
        }
    }
    
    return $complete_class_response;
}
    
        
        
        
    
    

        // $get_students_name = mysqli_query($con,"SELECT `student_id`,`student_name` from `$student_table_name` where student_rollnumber='$i'");
        // while($row = mysqli_fetch_assoc($get_students_name)){
        //         $student_name =  $row['student_name']; $student_id =  $row['student_id'];
    








?>

            