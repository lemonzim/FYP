<?php
	include 'conn.php';
    date_default_timezone_set('Asia/Singapore');
	session_start();
    $id = $_SESSION['student_id'];
    $result = mysqli_query($conn, "SELECT * from student where student_id='$id'");
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
        <?php include "./sidebar.php" ?>
        <div class=main>
            <h1>History</h1>
                    <?php
                            $history = mysqli_query($conn, "SELECT * from order_table where student_id=$id AND order_status IN ('not paid', 'paid') ORDER BY dates DESC") or die(mysqli_error($conn));
                            $prev_stall_name = null;
                            
                            echo "<table class='table'>";
                            echo "<thead><tr><th>Order ID</th><th>Stall Name</th><th>Menu Name</th><th>Price</th><th>Quantity</th><th>Pickup Time</th><th>Date</th><th>Amount</th><th>Status</th><th>Order Status</th><th>Payment</th></tr></thead>";
                             echo "<tbody>";
                            while ($history_row = mysqli_fetch_assoc($history)) {
                                $menu_info = mysqli_query($conn, "SELECT * from menu where menu_id = {$history_row['menu_id']}") or die(mysqli_error($conn));
                                $menu_info_row = mysqli_fetch_assoc($menu_info);
                                $stall_info = mysqli_query($conn, "SELECT * from stall where stall_id IN (select stall_id FROM menu where menu_id = {$history_row['menu_id']})");
                                $stall_info_row = mysqli_fetch_assoc($stall_info);
                                $amount = $history_row['quantity'] * $menu_info_row['price'];

                                
                            
                                $status_class = '';
                                if ($history_row['order_status'] == 'paid' && $history_row['food_status'] == 'Ready') {
                                    $status_class = 'table-success'; // set CSS class for paid status
                                } elseif ($history_row['order_status'] == 'not paid' || $history_row['food_status'] == 'Preparing') {
                                    $status_class = 'table-warning'; // set CSS class for ongoing status
                                } elseif ($history_row['order_status'] == 'cart') {
                                    $status_class = 'text-info'; // set CSS class for cart status
                                }
                            
                                echo "<tr class='$status_class'>";
                                echo "<td>{$history_row['order_id']}</td>";
                                echo "<td>{$stall_info_row['stall_name']}</td>";
                                echo "<td>{$menu_info_row['food_name']}</td>";
                                echo "<td>RM{$menu_info_row['price']}</td>";
                                echo "<td>{$history_row['quantity']}</td>";
                                echo "<td>{$history_row['arrival_time']}</td>";
                                echo "<td>{$history_row['dates']}</td>";
                                echo "<td>RM{$amount}</td>";
                                echo "<td>{$history_row['order_status']}</td>";
                                echo "<td>{$history_row['food_status']}</td>";
                                echo "<td>{$history_row['payment_type']}</td>";
                                echo "<td><a href=complain_student.php?order_id={$history_row['order_id']}>Complain</a></td>";
                                echo "</tr>";
                            }
                                echo "</tbody></table>";
                            
                    ?>     
        <script src="" async defer></script>
    </body>
</html>