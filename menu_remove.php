<?php
include 'conn.php';
session_start();
$id = $_SESSION['student_id'];
$sql="delete from order_table where order_id='$_POST[order_id]'";
if(!mysqli_query($conn, $sql))
{
    die('Error: '.mysqli_error($conn));
}
else{
    header("location:order.php");
}
?>