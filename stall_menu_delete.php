<?php
include 'conn.php';
session_start();
$id = $_SESSION['stall_id'];
$menu_id = $_GET['menu_id'];
$sql="DELETE from menu WHERE menu_id=$menu_id";
if(!mysqli_query($conn, $sql))
{
    die('Error: '.mysqli_error($conn));
}
else{
    header("location:menu_stall.php");
}
?>
    