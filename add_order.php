<?php
include 'conn.php';
session_start();
$id = $_SESSION['student_id'];
$sql_check="SELECT * from order_table where menu_id='$_POST[menu_id]' AND student_id='$id' ORDER BY order_id DESC";
$result = mysqli_query($conn, $sql_check);
if(!$result){
    die('Error: '.mysqli_error($conn));
}else{
        $sql_insert="INSERT into order_table (menu_id, student_id,order_status) values ('$_POST[menu_id]','$id','cart')";
        if(!mysqli_query($conn, $sql_insert)){
            die('Error: '.mysqli_error($conn));
        }

    header("location:menu_student.php?stall_id=$_POST[stall_id]");
}   
