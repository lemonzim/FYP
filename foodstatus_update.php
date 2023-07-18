<?php
	include 'conn.php';
	session_start();
	$id = $_SESSION['stall_id'];
	$food_status = $_GET['food_status'];
	$order_id = $_GET['order_id'];

	if ($food_status === 'Preparing') {
		$food_status = 'Ready';
	} elseif ($food_status === 'Ready') {
		$food_status = 'Preparing';
	}

	$sql = "UPDATE order_table SET food_status='$food_status' WHERE order_id=$order_id";

	if (!mysqli_query($conn, $sql)) {
		die('Error: ' . mysqli_error($conn));
	} else {
		header("location:history_stall.php");
	}
?>
