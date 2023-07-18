<?php
include 'conn.php';
session_start();
$student_id = $_POST['student_id'];
$student_name = $_POST['student_name'];
$student_email = $_POST['student_email'];
$student_phonenum = $_POST['student_phonenum'];
$student_password = $_POST['student_password'];


                $sql = "UPDATE student SET student_name='$student_name', student_email='$student_email',student_phonenum='$student_phonenum',student_password='$student_password'  WHERE student_id='$student_id'";
                if (!mysqli_query($conn, $sql)) {
                    die('Error: ' . mysqli_error($conn));
                }
header("Location: menu_admin.php");
?>
