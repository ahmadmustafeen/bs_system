<?php

 
    $con=mysqli_connect("localhost","demoacct-313437e756","asdadsad12121","demoacct-313437e756");
    // $con=mysqli_connect("shareddb-v.hosting.stackcp.net","root","","dams");
    if(!$con)
    {
        die(' Please Check Your Connection'.mysqli_error($con));
    }
else {
    // echo "working";
}
?>