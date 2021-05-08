<?php

 
    // $con=mysqli_connect("localhost","demoacct-313437e756","asdadsad12121","demoacct-313437e756");
    $con=mysqli_connect("localhost","root","","demoacct-313437e756");
    if(!$con)
    {
        die(' Please Check Your Connection'.mysqli_error($con));
    }
else {
    // echo "working";
}
?>