<?php
include 'conn.php';
session_start();
$menu_id = $_GET['menu_id'];
$food_name = $_POST['food_name'];
$price = $_POST['price'];

    $sql = "UPDATE menu SET food_name='$food_name', price='$price' WHERE menu_id='$menu_id'";
    if(!mysqli_query($conn, $sql)){die('Error: '.mysqli_error($conn));}
    header("Location: menu_stall.php");
?> 