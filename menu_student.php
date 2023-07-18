<?php
	include 'conn.php';
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
        <?php
        mysqli_data_seek($stall_query, 0);
        if(isset($_GET['stall_id'])) {
            echo"<h1>$stall_name_row[1]</h1>";
            
        }else{
            echo"<h1>$stall_query_row[1]</h1>";
        }
        ?>
<table class="table">
  <thead>
    <tr>
        <th scope="row">Image</th>
        <th scope="row">Name</th>
        <th scope="row">price</th>
        <th scope="row">Status</th>
        <th scope="row"></th>
    </tr>
  </thead>
  <tbody>
  <?php
  
  if(isset($_GET['stall_id'])) {
    while($row2 = mysqli_fetch_row($second_menu)){
        $available_style = '';
        if ($row2[4] == 'unavailable') {
            $available_style = 'btn btn-secondary add-button'; // Set CSS class for unavailable status
            $disabled_attribute = 'disabled'; // Add the 'disabled' attribute
        }else{
            $available_style = 'btn btn-primary add-button'; // Set CSS class for available status
            $disabled_attribute = ''; // No 'disabled' attribute
        }
        echo "
        <tr>
        <td>
            <img src='$row2[5]' alt='Food Image' style='object-fit: cover; width: 150px; height: 150px';>
        </td>
        <td scope='row'>$row2[2]</td><td scope='row'>RM$row2[3]</td><td scope='row'>$row2[4]</td>
            <td>
                <form method='post' action='add_order.php'>
                    <input type='hidden' name='stall_id' value='$row2[1]'>
                    <input type='hidden' name='menu_id' value='$row2[0]'>
                    <input type='hidden' name='food_name' value='$row2[2]'>
                    <input type='hidden' name='price' value='$row2[3]'>
                    <input type='submit' class='$available_style' value='Add' $disabled_attribute>
                </form>
            </td>
        </tr>";
      } 
  }else{
    while($row2 = mysqli_fetch_row($first_menu)){
        $available_style = '';
        if ($row2[4] == 'unavailable') {
            $available_style = 'btn btn-secondary add-button'; // Set CSS class for unavailable status
            $disabled_attribute = 'disabled'; // Add the 'disabled' attribute
        }else{
            $available_style = 'btn btn-primary add-button'; // Set CSS class for available status
            $disabled_attribute = ''; // No 'disabled' attribute
        }

        echo "
        <tr>
        <td>
            <img src='$row2[5]' alt='Food Image' style='object-fit: cover; width: 150px; height: 150px';>
        </td>
        <td scope=row>$row2[2]</td><td scope=row>RM$row2[3]</td><td scope=row>$row2[4]</td>
        <td>
        <form method='post' action='add_order.php'>    
                    <input type='hidden' name='stall_id' value='$row2[1]'>
                    <input type='hidden' name='menu_id' value='$row2[0]'>
                    <input type='hidden' name='food_name' value='$row2[2]'>
                    <input type='hidden' name='price' value='$row2[3]'>
                    <input type='submit' class='$available_style' value='Add' $disabled_attribute>
        </form>        
            </td>

        </tr>";
  }
}
?>
</tbody>
</table>
</div>
       
    <?php

    mysqli_free_result($result);
    mysqli_close($conn);
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>