<?php
include 'conn.php';
session_start();
$id = $_SESSION['stall_id'];
$name = mysqli_query($conn, "SELECT * from stall where stall_id='$id' order by stall_id ASC");
$row = mysqli_fetch_row($name);

// Calculate the start and end dates for the current week
$today = date('Y-m-d');
if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
} else {
    // Calculate the start and end dates for the current week
    $today = date('Y-m-d');
    $startDate = date('Y-m-d', strtotime('last week', strtotime($today)));
    $endDate = date('Y-m-d', strtotime('today', strtotime($today)));
}

$query = "SELECT menu_id, COUNT(menu_id) AS order_count 
          FROM order_table 
          WHERE menu_id IN (SELECT menu_id FROM menu WHERE stall_id='$id') 
          AND dates BETWEEN '$startDate' AND '$endDate' 
          GROUP BY menu_id 
          ORDER BY order_count DESC LIMIT 10";

$result = $conn->query($query);
$menu_popularity = array();

while ($row = $result->fetch_assoc()) {
    $menu_id = $row["menu_id"];
    $order_count = $row["order_count"];
    $menu_popularity[$menu_id] = $order_count;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Menu Popularity Report</title>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php include "./sidebar_stall.php" ?>
	<div class=main>
    <div class="text-center">
    <form id="dateRangeForm">
        <div class="d-flex justify-content-center">
            <div class="me-2">
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate" value="<?php echo $startDate; ?>">
            </div>
            <div class="ms-2">
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate" value="<?php echo $endDate; ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Update Date Range</button>
    </form>
</div>

    <h1>Menu Popularity Report</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Menu Item</th>
                        <th>Order Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($menu_popularity as $menu_id => $order_count) {
                        $menu_query = "SELECT food_name FROM menu WHERE menu_id='$menu_id' AND stall_id='$id'";
                        $menu_result = $conn->query($menu_query);
                        $menu_row = $menu_result->fetch_assoc();
                        $menu_name = $menu_row["food_name"];
                        echo "<tr><td>$menu_name</td><td>$order_count</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <hr>
    <h1>Payment Type Revenue Report</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Payment Type</th>
                    <th>Total Revenue</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query for payment type revenue
                $query_money = "SELECT payment_type, SUM(quantity) AS total_quantity 
                FROM order_table 
                WHERE dates BETWEEN '$startDate' AND '$endDate' 
                GROUP BY payment_type";
                $result_money = $conn->query($query_money);
                $payment_distribution = array();
                while ($row_money = $result_money->fetch_assoc()) {
                    $payment_type = $row_money["payment_type"];
                    $total_quantity = $row_money["total_quantity"];
                    
                    // Retrieve price from menu table based on menu ID
                    $menu_info = mysqli_query($conn, "SELECT * FROM menu WHERE stall_id='$id'") or die(mysqli_error($conn));
                    $menu_info_row = mysqli_fetch_assoc($menu_info);
                    $price = $menu_info_row['price'];
                    
                    // Calculate the total amount for this payment type
                    $amount = $total_quantity * $price;
                    
                    // Print the row in the table
                    echo "<tr>";
                    echo "<td>$payment_type</td>";
                    echo "<td>RM" . number_format($amount, 2) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    </div>
    <script>
    // Handle form submission to update date range
    document.getElementById('dateRangeForm').addEventListener('submit', function (e) {
        e.preventDefault();
        
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        // Construct the URL with updated date parameters
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('startDate', startDate);
        urlParams.set('endDate', endDate);

        // Redirect the user to the updated URL
        window.location.href = `report_stall.php?${urlParams.toString()}`;
    });
</script>

</body>
</html>
