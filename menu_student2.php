<?php
	include 'conn.php';
	session_start();
    $id = $_SESSION['student_id'];
    $first_stall_id = 100001;
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
        <style>
            .grid-container{
                display:grid;
                grid-auto-rows: minmax (150px, auto);   
                grid-template-columns: 15% 85%;
            }
            .grid-item-1{
                background-color:#30b762;
            }
            .grid-item-3{
                background-color:#30b762;
            }
            .nav{
                display:flex;
                flex-direction:column;
                background-color: #30b762;
                row-gap: 5px;

            }
            .nav a{
                border: solid white;
                text-align:center;
                width: 90%;
                align-self:center;
                height:10vh;
            }
            .nav h3{
                text-align:center;
            }
            h1{
                text-align: center;
            }
            .main {
  margin-left: 200px; /* Same as the width of the sidenav */
}
            .sidenav {
                height: 100%;
                width: 200px;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #30b762;
                overflow-x: hidden;
                padding-top: 20px;
            }
.sidenav a {
  padding: 6px 6px 6px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  border-top:solid white;
  margin-top: 2px;
        
}
.sidenav h3{
    text-align:center;
}

.sidenav a:hover {
  color: #f1f1f1;
}
        </style>
    </head>
    <body>
        <div class="sidenav">
        <?php
                    $result = mysqli_query($conn, "SELECT * from student where student_id='$id'");
                    $row = mysqli_fetch_row($result);
                    $menu = mysqli_query($conn, "SELECT * from menu where stall_id='$stall_id'");
                    $menu_name = mysqli_query($conn, "SELECT * from stall where stall_id='$stall_id'");
                    $menu_name_row = mysqli_fetch_row($menu_name);
                    echo "<h3>$row[1]</h3>";
                        ?>
                    <a aria-current="page" href="menu_student.php">Gerai 1</a>
                    <a  href="menu_student2.php">Gerai 2</a>
                    <a  href="menu_student3.php">Gerai 3</a>
        </div>
<div class="main">

        <?php echo"<h1>$menu_name_row[1]</h1>";?>

<table class="table">
  <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">price</th>
        <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
  <?php
  while($row = mysqli_fetch_row($menu)){
    echo "<tr><th scope=row>$row[2]</th><th scope=row>$row[3]</th><th scope=row>$row[4]</tr>";
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