<?php
	include 'conn.php';
	session_start();
	$id = $_SESSION['stall_id'];
	$order_status = $_GET['order_status'];
	$order_id = $_GET['order_id'];

	if ($order_status === 'not paid') {
		$order_status = 'paid';
    }

	$sql = "UPDATE order_table SET order_status='$order_status' WHERE order_id=$order_id";

	if (!mysqli_query($conn, $sql)) {
		die('Error: ' . mysqli_error($conn));
	} else {
		header("location:history_stall.php");
	}
?>
