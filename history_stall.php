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
                     echo "<thead><tr><th>Order ID</th><th>Menu Name</th><th>Price</th><th>Quantity</th><th>Pickup Time</th><th>Amount</th><th>Status</th><th></th></tr></thead>";
                     echo "<tbody>";
                            $history = mysqli_query($conn, "SELECT * from order_table where menu_id IN (SELECT menu_id from menu where stall_id='$id') ORDER BY order_id");
                            while ($history_row = mysqli_fetch_assoc($history)) {
                                $menu_info = mysqli_query($conn, "SELECT * from menu where menu_id = {$history_row['menu_id']}") or die(mysqli_error($conn));
                                $menu_info_row = mysqli_fetch_assoc($menu_info);
                                $amount = $history_row['quantity'] * $menu_info_row['price'];
                                    
                                $status_class = '';
                                if ($history_row['order_status'] == 'paid') {
                                    $status_class = 'table-success'; // set CSS class for paid status
                                } elseif ($history_row['order_status'] == 'ongoing') {
                                    $status_class = 'table-warning'; // set CSS class for ongoing status
                                } elseif ($history_row['order_status'] == 'cart') {
                                    $status_class = 'text-info'; // set CSS class for cart status
                                }
                            
                                echo "<tr class='$status_class'>";
                                echo "<td>{$history_row['order_id']}</td>";
                                echo "<td>{$menu_info_row['food_name']}</td>";
                                echo "<td>{$menu_info_row['price']}</td>";
                                echo "<td>{$history_row['quantity']}</td>";
                                echo "<td>{$history_row['arrival_time']}</td>";
                                echo "<td>{$amount}</td>";
                                echo "<td>{$history_row['order_status']}</td>";
                               echo "<td><a href=complain_stall.php?order_id={$history_row['order_id']}>Complain</a></td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                            
                    ?>     
        <script src="" async defer></script>
    </body>
</html>