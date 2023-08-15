<?php
include 'conn.php';
session_start();
$id = $_SESSION['admin_id'];
$sql="INSERT into student (student_id, student_name, student_email,student_password,student_phonenum)
values ('','' ,'' ,'','')";
if(!mysqli_query($conn, $sql))
{
    die('Error: '.mysqli_error($conn));
}
else{
    header("location:menu_admin.php");
}
?>
    