<?php
include 'conn.php';
session_start();
$menu_id = $_GET['menu_id'];
$food_name = $_POST['food_name'];
$price = $_POST['price'];

// Handle image upload
$targetDir = "images/"; // Update this path according to your project structure

// Check if a file was uploaded
if (!empty($_FILES["picture"]["tmp_name"])) {
    $targetFile = $targetDir . basename($_FILES["picture"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if ($check !== false) {
        // Allow only specific image file types (you can add more if needed)
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $allowedExtensions)) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
                // File upload was successful, update the database with the new image path
                $sql = "UPDATE menu SET food_name='$food_name', price='$price', image='$targetFile' WHERE menu_id='$menu_id'";
                if (!mysqli_query($conn, $sql)) {
                    die('Error: ' . mysqli_error($conn));
                }
            } else {
                // Handle file upload error
                die('Error: Unable to upload the image.');
            }
        } else {
            // Handle invalid file type error
            die('Error: Invalid image file type. Only JPG, JPEG, PNG, and GIF files are allowed.');
        }
    } else {
        // Handle file is not an image error
        die('Error: The uploaded file is not an image.');
    }
} else {
    // No file was uploaded, update the database without changing the image
    $sql = "UPDATE menu SET food_name='$food_name', price='$price' WHERE menu_id='$menu_id'";
    if (!mysqli_query($conn, $sql)) {
        die('Error: ' . mysqli_error($conn));
    }
}

header("Location: menu_stall.php");
?>
