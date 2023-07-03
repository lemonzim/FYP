<?php
include 'conn.php';
session_start();
$time = $_POST['time'];
$totalamount =$_POST['totalamount'];
$foodtotal = '';
$orderidtotal = '';
$id = $_SESSION['student_id'];
$student_info = mysqli_query($conn,  "SELECT * FROM student WHERE student_id=$id")or die(mysqli_error($conn));
$student_info_row = mysqli_fetch_assoc($student_info);

// Gabung dua2
$order_quantities = array_combine($_POST['order_id'], $_POST['quantity']);

// Loop over the array and update the order_table database table for each order
foreach ($order_quantities as $order_id => $quantity) {
    $sql = "UPDATE order_table SET quantity='$quantity', arrival_time='$time' WHERE order_id='$order_id'";
    if (!mysqli_query($conn, $sql)) {
        die('Error: ' . mysqli_error($conn));
    }
}

foreach ($_POST['order_id'] as $orderid) {
   
    $orderidtotal .= $orderid . ', ';
}

foreach ($_POST['food_name'] as $foodname) {
    $foodtotal .= $foodname . ', ';
}
$foodtotal = rtrim($foodtotal, ', '); // nak buang comma and space last2 sekali
$orderidtotal = rtrim($orderidtotal, ', ');

echo "$foodtotal "."$orderidtotal";
$some_data = array(
    'userSecretKey'=>'fthoc13o-9ex5-13uo-y0hu-uv6u5oc4urtu',
    'categoryCode'=>'agkq5m0y',
    'billName'=>'Dataran Cendekia FOS',
    'billDescription'=>'Your order:'.$foodtotal. ' With total of: '.$totalamount, //kena letak
    'billPriceSetting'=>0,
    'billPayorInfo'=>0,
    'billAmount'=>$totalamount*100,
    'billReturnUrl'=>'http://localhost/fyp/afterpayment.php',
    'billCallbackUrl'=>'http://localhost/fyp/order.php',
    'billExternalReferenceNo' => $orderidtotal, //letak order_id
    'billTo'=>$student_info_row['student_name'], //letak student name
    'billEmail'=>$student_info_row['student_email'], //letak student email
    'billPhone'=>$student_info_row['student_phonenum'], //letak student phone
    'billSplitPayment'=>0,
    'billSplitPaymentArgs'=>'',
    'billPaymentChannel'=>'2',
    'billContentEmail'=>'Thank you for purchasing our product! Please return to Dataran Cendekia again!',
    'billChargeToCustomer'=>0,
    'billExpiryDate'=>'',
    'billExpiryDays'=>3
  );

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

  $result = curl_exec($curl);
  $info = curl_getinfo($curl);  
  curl_close($curl);
  $obj = json_decode($result);
  echo "$result";
  $billcode = $obj[0]->BillCode;
  header("Location: https://dev.toyyibpay.com/$billcode");

mysqli_close($conn);
?>
