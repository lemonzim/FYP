<?php
	include 'conn.php';
    date_default_timezone_set('Asia/Singapore');
	session_start();
    $id = $_SESSION['stall_id'];
    $result = mysqli_query($conn, "SELECT * from stall where stall_id='$id'");
    $row = mysqli_fetch_row($result); //nak dapatkan student it
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dataran Cendekia Food Ordering System</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <?php include "./sidebar_stall.php" ?>
        <div class=main>
            <h1>Order</h1>
                    <?php   
                    $stall_info = mysqli_query($conn, "SELECT * from stall where stall_id='$id' ");
                    $stall_info_row = mysqli_fetch_assoc($stall_info);
                    $stall_name = $stall_info_row['stall_name'];
                     echo "<h3>Stall: $stall_name</h3>";
                     echo "<table class='table'>";
                     echo "<thead><tr><th>Order ID</th><th>Student ID</th><th>Menu Name</th><th>Price</th><th>Quantity</th><th>Pickup Time</th><th>Date</th><th>Amount</th><th>Payment</th><th>Food Status</th></tr></thead>";
                     echo "<tbody>";
                            $history = mysqli_query($conn, "SELECT * from order_table where menu_id IN (SELECT menu_id from menu where stall_id='$id') ORDER BY dates DESC");
                            while ($history_row = mysqli_fetch_assoc($history)) {
                                $menu_info = mysqli_query($conn, "SELECT * from menu where menu_id = {$history_row['menu_id']}") or die(mysqli_error($conn));
                                $menu_info_row = mysqli_fetch_assoc($menu_info);
                                $amount = $history_row['quantity'] * $menu_info_row['price'];

                                $student_info = mysqli_query($conn, "SELECT student_name from student where student_id = {$history_row['student_id']}") or die(mysqli_error($conn));
                                $student_info_row = mysqli_fetch_assoc($student_info);
                                    
                                $status_class = '';
                                if ($history_row['order_status'] === 'paid' && $history_row['food_status'] === 'Ready') {
                                    $status_class = 'table-success'; // set CSS class for paid status
                                } elseif ($history_row['order_status'] === 'not paid' || $history_row['food_status'] === 'Preparing') {
                                    $status_class = 'table-warning'; // set CSS class for ongoing status
                                } elseif ($history_row['order_status'] == 'cart') {
                                    $status_class = 'text-info'; // set CSS class for cart status
                                }

                                $food_status_class = '';
                                if ($history_row['food_status'] == 'Ready') {
                                    $food_status_class = 'btn btn-success'; 
                                } elseif ($history_row['food_status'] == 'Preparing') {
                                    $food_status_class = 'btn btn-warning'; 
                                }

                                $order_status_class = '';
                                if ($history_row['order_status'] == 'not paid') {
                                    $order_status_class = 'btn btn-warning'; 
                                    $attribute=''; 
                                } elseif ($history_row['order_status'] == 'paid') {
                                    $order_status_class = '';
                                    $attribute='disabled'; 
                                }
                                
                            
                                echo "<tr class='$status_class'>";
                                echo "<td>{$history_row['order_id']}</td>";
                                echo "<td>{$student_info_row['student_name']}</td>";
                                echo "<td>{$menu_info_row['food_name']}</td>";
                                echo "<td>RM{$menu_info_row['price']}</td>";
                                echo "<td>{$history_row['quantity']}</td>";
                                echo "<td>{$history_row['arrival_time']}</td>";
                                echo "<td>{$history_row['dates']}</td>";
                                echo "<td>RM{$amount}</td>";
                                echo "<td>
                                <button $attribute type='button' class='$order_status_class btn btn-success'><a style='color:white; text-decoration:none;' href='paystatus_update.php?order_id=$history_row[order_id]&order_status=$history_row[order_status]'</a>$history_row[order_status]</button>
                                </td>";
                                echo "<td>
                                <button  type='button' class='$food_status_class'><a style='color:white; text-decoration:none;' href='foodstatus_update.php?order_id=$history_row[order_id]&food_status=$history_row[food_status]'</a>$history_row[food_status]</button>
                                </td>";
                               echo "<td><a href=complain_stall.php?order_id={$history_row['order_id']}>Complain</a></td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                            
                    ?>     
        <script src="" async defer></script>
    </body>
</html>