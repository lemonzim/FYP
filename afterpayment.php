<?php
include 'conn.php';
session_start();
$order_id = $_GET['order_id'];
$orders = explode(", ", $order_id);
$order_numbers = array_slice($orders, 0);

echo "Order numbers: " . implode(", ", $order_numbers) . "\n";

foreach ($order_numbers as $order_id => $order) {
    $order = mysqli_real_escape_string($conn, $order);
    $sql = "UPDATE order_table SET order_status='paid' WHERE order_id='$order'";
    if(!mysqli_query($conn, $sql)){die('Error: '.mysqli_error($conn));}
    header("Location: http://localhost/fyp/history_student.php");
}
?> 