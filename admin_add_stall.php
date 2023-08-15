<?php
include 'conn.php';
session_start();
$id = $_SESSION['admin_id'];
$sql="INSERT into stall (stall_id, stall_name, stall_email,stall_pass,stall_phone_num)
values ('','' ,'' ,'','')";
if(!mysqli_query($conn, $sql))
{
    die('Error: '.mysqli_error($conn));
}
else{
    header("location:stall_list.php");
}
?>
    