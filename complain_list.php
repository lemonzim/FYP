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
<table class="table">
  <thead>
    <tr>
        <th scope="col">Complain ID</th>
        <th scope="col">Complainer</th>
        <th scope="col">Complained to</th>
        <th scope="col">reason</th>
        <th scope="col">description</th>
        <th scope="col">order_id</th>
    </tr>
  </thead>
  <tbody>
  <?php
    
    $student_list= mysqli_query($conn, "SELECT * from complain ORDER BY complain_id");
    while($row2 = mysqli_fetch_row($student_list)){
        if(strlen($row2[4])==10){$complained_to= mysqli_query($conn, "SELECT * from stall where stall_id IN (select stall_id from menu where menu_id IN (select menu_id from order_table where order_id IN (select order_id from complain)))");}
        else{$complained_to= mysqli_query($conn, "SELECT * from student where student_id IN (select student_id from order_table where order_id IN (select order_id from complain))");}
        
        $complained_to_row = mysqli_fetch_row($complained_to);
        echo "
        <tr>
            <td scope=row>$row2[0]</td>
            <td scope=row>$row2[4]</td> 
            <td scope=row>$complained_to_row[1]</td>
            <td scope=row>$row2[1]</td>
            <td scope=row>$row2[3]</td>
            <td scope=row>$row2[2]</td>
            
        </tr>";
    }
?>
</tbody>
</table>
</div>
       
    <?php
    mysqli_close($conn);
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>