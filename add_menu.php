<?php
include 'conn.php';
session_start();
$id = $_SESSION['stall_id'];
$sql="INSERT into menu (stall_id, food_name, price, food_status)
values ('$id','' ,'' ,'unavailable')";
if(!mysqli_query($conn, $sql))
{
    die('Error: '.mysqli_error($conn));
}
else{
    header("location:menu_stall.php");
}
?>
    