<?php
include 'conn.php';
session_start();
$order_id = $_POST['order_id'];
$reason = $_POST['reason'];
$description = $_POST['description'];
$complainer = $_POST['complainer_id'];
$sql = "INSERT into complain (reason, order_id, description, complainer) values ('$reason','$order_id','$description', '$complainer')";
if (!mysqli_query($conn, $sql)) {
    die('Error: ' . mysqli_error($conn));
} else {
    $location='';
    if((strlen($complainer) == 6)) {$location = 'history_stall.php';}
    else{$location = 'history_student.php';}
    echo '<script>language="javascript">alert("Complain has been sent");
          window.location.href="' . $location . '";
			</script>';
}
?>
