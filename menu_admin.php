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
        <th scope="col">Student ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Password</th>
        <th scope="col">Phone_numb</th>
    </tr>
  </thead>
  <?php
    $student_list = mysqli_query($conn, "SELECT * FROM student ORDER BY student_name");

    while ($row2 = mysqli_fetch_row($student_list)) {
        echo "
        <tr>
            <td scope='row'>$row2[0]</td>
            <td scope='row'>$row2[1]</td>
            <td scope='row'>$row2[2]</td>
            <td scope='row'>$row2[3]</td>
            <td scope='row'>$row2[4]</td>
            <td>
                    <a class='btn btn-warning' href='admin_update_student.php?student_id=$row2[0]'>UPDATE</a>
                    <a class='btn btn-danger' href='admin_delete_student.php?student_id=$row2[0]'>DELETE</a>
            </td>
        </tr>";
    }
?>

</tbody>
</table>
<a class='btn btn-primary' href='admin_add_student.php?'>ADD</a>
</div>
       
    <?php
    mysqli_close($conn);
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>