<?php
include 'conn.php';
session_start();
$id = $_SESSION['stall_id'];
$food_status =$_POST['food_status'];
$menu_id =$_POST['menu_id'];

if($food_status === 'available'){
    $food_status = 'unavailable';
}elseif($food_status === 'unavailable'){
    $food_status = 'available';
}
$sql="UPDATE menu SET food_status='$food_status' WHERE menu_id=$menu_id";
if(!mysqli_query($conn, $sql))
{
    die('Error: '.mysqli_error($conn));
}
else{
    header("location:menu_stall.php");
}
?>




