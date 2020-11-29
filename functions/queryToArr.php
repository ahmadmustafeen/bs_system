<?php
function queryToArr($con,$query,$required_data_arr){
    $arr =[];

    $applyQuery  = mysqli_query($con,$query);
    while($row = mysqli_fetch_assoc($applyQuery)){
        $temp = "";
        foreach($required_data_arr as $required_data){
            // echo $required_data."  ";
            $dataget = $row[$required_data];
            $temp .=$required_data." ".$dataget." ";
        }
        array_push($arr,$temp);
    }
    return $arr;
}

?>