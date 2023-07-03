<?php
	include 'conn.php';
	session_start();
    $id = $_SESSION['admin_id'];
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
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
    <?php include "./sidebar_admin.php" ?>
    <div class=main>
    <?php
                            $history = mysqli_query($conn, "SELECT * from order_table ORDER BY menu_id");
                            $prev_stall_name = null;
                            while ($history_row = mysqli_fetch_assoc($history)) {
                                $menu_info = mysqli_query($conn, "SELECT * from menu where menu_id = {$history_row['menu_id']}") or die(mysqli_error($conn));
                                $menu_info_row = mysqli_fetch_assoc($menu_info);
                                $stall_info = mysqli_query($conn, "SELECT * from stall where stall_id IN (select stall_id FROM menu where menu_id = {$history_row['menu_id']})");
                                $stall_info_row = mysqli_fetch_assoc($stall_info);
                                $amount = $history_row['quantity'] * $menu_info_row['price'];
                                $stall_name = $stall_info_row['stall_name'];
                                if ($stall_name != $prev_stall_name) {
                                    // close previous table
                                    if ($prev_stall_name !== null) {
                                        echo "</tbody></table>";
                                    }
                                    // start new table for current menu_id
                                    echo "<h3>Stall: $stall_name</h3>";
                                    echo "<table class='table'>";
                                    echo "<thead><tr><th>Order ID</th><th>Menu Name</th><th>Price</th><th>Quantity</th><th>Pickup Time</th><th>Amount</th><th>Status</th></tr></thead>";
                                    echo "<tbody>";
                                    $prev_stall_name = $stall_name;
                                }
                                
                            
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
                                echo "</tr>";
                            }
                            // close last table
                            if ($prev_stall_name !== null) {
                                echo "</tbody></table>";
                            }
                            
                    ?>     
</div>
       
    <?php
    mysqli_close($conn);
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>