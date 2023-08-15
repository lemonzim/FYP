<?php
include 'conn.php';
session_start();
$stall_id = $_GET['stall_id'];


                $sql = "DELETE FROM stall WHERE stall_id='$stall_id'";
                if (!mysqli_query($conn, $sql)) {
                    die('Error: ' . mysqli_error($conn));
                }
header("Location: stall_list.php");
?>
