<?php
include 'conn.php';
session_start();
$student_id = $_GET['student_id'];


                $sql = "DELETE FROM student WHERE student_id='$student_id'";
                if (!mysqli_query($conn, $sql)) {
                    die('Error: ' . mysqli_error($conn));
                }
header("Location: menu_admin.php");
?>
