<?php
	include 'conn.php';
    date_default_timezone_set('Asia/Singapore');
	session_start();
    $id = $_SESSION['student_id'];
    $result = mysqli_query($conn, "SELECT * from student where student_id='$id'");
    $row = mysqli_fetch_row($result); //nak dapatkan student it
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="multipart/form-data"><!--Untuk toyyibpay-->
        <title>Dataran Cendekia Food Ordering System</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <style>
            .total{
                display:block;
            }
            .mid{
                display: flex;
                justify-content: center;
            }
        </style>
    </head>
    <body>
    <script>
        function validateform()
{
	var quantity = document.querySelector('.hidden_quantity').value;
	if(quantity === null || quantity === "" || quantity === "0")
	{
		alert("Quantity cannot be zero");
		return false;
	}
}
    </script>
    <?php include "./sidebar.php" ?>
    <div class=main>
        <h1>Your Order</h1>
                        <?php
                            $order = mysqli_query($conn, "SELECT * from order_table where student_id=$id AND order_status='cart' ORDER BY menu_id");
                            $prev_stall_name = null;
                            $totalAmount = 0; 

                            while($order_row = mysqli_fetch_assoc($order)){
                                $menu_info = mysqli_query($conn, "SELECT * from menu where menu_id = {$order_row['menu_id']}")or die(mysqli_error($conn));
                                $menu_info_row = mysqli_fetch_assoc($menu_info);
                                $stall_info = mysqli_query($conn, "SELECT * from stall where stall_id IN (select stall_id FROM menu where menu_id = {$order_row['menu_id']})" );
                                $stall_info_row = mysqli_fetch_assoc($stall_info);
                                $amount = $order_row['quantity'] * $menu_info_row['price'];
                                $stall_name = $stall_info_row['stall_name'];
                                if ($stall_name != $prev_stall_name) {
                                    // close previous table
                                    if ($prev_stall_name !== null) {
                                        echo "</tbody></table>";
                                    }
                                    // start new table for current menu_id
                                    echo "<h3>Stall: $stall_name</h3>";
                                    echo "<table class='table'>";
                                    echo "<thead><tr><th>Order ID</th><th>Name</th><th>Price</th><th>Quantity</th><th>Amount</th></tr></thead>";
                                    echo "<tbody>";
                                    $prev_stall_name = $stall_name;
                                }

                                echo "
                                <tr>
                                    <td>{$order_row['order_id']}</td>
                                    <td>{$menu_info_row['food_name']}</td>
                                    <td>{$menu_info_row['price']}</td>
                                    <th scope=row>
                                       
                                        <div><input min='1' class='input' name='quantity' type='number' value='{$order_row['quantity']}' 
                                        onchange='calculateAmount(this.value, {$menu_info_row['price']}, {$order_row['menu_id']});
                                        copyquantity(this.value, {$order_row['menu_id']});'></div>
                                    </th>
                                    <th><div class='Amount  Amount-{$order_row['menu_id']}'>$amount</div></th>
                                    <th>
                                        <form name='register' action='menu_remove.php' method='post'>
                                            <input type='hidden' name='order_id' value='{$order_row['order_id']}'>
                                            <button type='submit' class='btn btn-danger'>Remove</button>
                                        </form>
                                    </th>
                                </tr>
                                ";
                            }
   ?>
           
        
        
        </table>   
        <h1 class="total"><?php echo"Total:  $totalAmount"?></h1>
        
        <?php
         mysqli_data_seek($order, 0);
         echo"<form name='register2' onsubmit='return validateform()' action='order_confirm.php' method='post'>";
        while($order_row = mysqli_fetch_assoc($order)){
            $menu_info = mysqli_query($conn, "SELECT * from menu where menu_id = {$order_row['menu_id']}")or die(mysqli_error($conn));
            $menu_info_row = mysqli_fetch_assoc($menu_info);
        echo
        "
                    <input type='hidden' name='order_id[]' value='{$order_row['order_id']}'>
                    <input type='hidden' name='menu_id' value='{$order_row['menu_id']}'>
                    <input type='hidden' class='hidden_quantity quantity-{$order_row['menu_id']}' name='quantity[{$order_row['order_id']}]'>   
                    <input type='hidden' name='food_name[{$order_row['order_id']}]' value='{$menu_info_row['food_name']}'> 
                          
        ";
        }
        ?>
                <input type='hidden' class="totalamount" name='totalamount' value="<?php echo $totalAmount; ?>">
                <div class='mid'><input required type='time' name='time' min="<?php echo date('H:i', strtotime('+30 minutes'))?>"></div>
                <div class='mid'><button class='mid btn btn-primary'>Order</button></div>
                </form>
            </div>
      </div>
               
    <script>
    var totalAmount = <?php echo $totalAmount; ?>;
    function calculateAmount(quantity, price, orderId) {
        var amount = quantity * price;
        document.querySelector('.Amount-' + orderId).innerHTML = amount;
        
        var totalAmount = 0;
        var amountElems = document.querySelectorAll('.Amount');
        for (var i = 0; i < amountElems.length; i++) {
                 totalAmount += parseFloat(amountElems[i].textContent);
            }
        console.log(totalAmount);
        document.querySelector('.total').innerHTML = "Total: " + totalAmount;
        document.querySelector('.totalamount').value =totalAmount;
    }
    
function copyquantity(quantity, order_id) {
    document.querySelector('.quantity-' + order_id).value = quantity;
}

</script>
</body>
</html>