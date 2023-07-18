<?php
  $some_data = array(
    'userSecretKey'=>'fthoc13o-9ex5-13uo-y0hu-uv6u5oc4urtu',
    'categoryCode'=>'agkq5m0y',
    'billName'=>'Payment from '.$stall_name, //Kena letak
    'billDescription'=>'Car Rental WXX123 On Sunday', //kena letak
    'billPriceSetting'=>0,
    'billPayorInfo'=>0,
    'billAmount'=>$amount*100,
    'billReturnUrl'=>'http://bizapp.my',
    'billCallbackUrl'=>'history_student.php',
    'billExternalReferenceNo' => 'AFR341DFI', //letak order_id
    'billTo'=>'John Doe', //letak student name
    'billEmail'=>'jd@gmail.com', //letak student email
    'billPhone'=>'0194342411', //letak student phone
    'billSplitPayment'=>0,
    'billSplitPaymentArgs'=>'',
    'billPaymentChannel'=>'2',
    'billContentEmail'=>'Thank you for purchasing our product! Please return to Dataran Cendekia again!',
    'billChargeToCustomer'=>0,
    'billExpiryDate'=>'17-12-2020 17:00:00',
    'billExpiryDays'=>3
  );  

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/createBill');  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

  $result = curl_exec($curl);
  $info = curl_getinfo($curl);  
  curl_close($curl);
  $obj = json_decode($result);
  echo $result;