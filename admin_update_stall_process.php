<?php
include 'conn.php';
session_start();
$stall_id = $_POST['stall_id'];
$stall_name = $_POST['stall_name'];
$stall_email = $_POST['stall_email'];
$stall_phone_num = $_POST['stall_phone_num'];
$stall_pass= $_POST['stall_pass'];


                $sql = "UPDATE stall SET stall_name='$stall_name', stall_email='$stall_email',stall_phone_num='$stall_phone_num',stall_pass='$stall_pass'  WHERE stall_id='$stall_id'";
                if (!mysqli_query($conn, $sql)) {
                    die('Error: ' . mysqli_error($conn));
                }
header("Location: stall_list.php");
?>
