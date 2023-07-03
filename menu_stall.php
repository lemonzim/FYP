<?php
	include 'conn.php';
	session_start();
    $id = $_SESSION['stall_id'];
    $result = mysqli_query($conn, "SELECT * from stall where stall_id='$id'");
    $row = mysqli_fetch_row($result); //nak dapatkan stall id
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
    <?php include "./sidebar_stall.php" ?>
    <div class=main>
        <?php
        mysqli_data_seek($stall_query, 0);
            echo"<h1>$stall_query_row[1]</h1>";
        ?>
<form name='register' action=add_order.php method=post>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">price</th>
        <th scope="col">Status *click to change</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php while($row2 = mysqli_fetch_row($menu)){ 
        $status_class = '';
        if ($row2[4] == 'available') {
            $status_class = 'btn btn-success'; // set CSS class for paid status
        } elseif ($row2[4] == 'unavailable') {
            $status_class = 'btn btn-danger'; // set CSS class for ongoing status
        }
        ?>
        <tr>
          <td>
            <input type='text' value='<?php echo "$row2[2]"; ?>' onchange='copyfoodname(this.value);'>
          </td>
          <td>
            <input type='text' value='<?php echo "$row2[3]"; ?>' onchange='copyprice(this.value);'>
          </td>
          <td>
          <form method='post' action='orderstatus_update.php'>
                <input type='hidden' name='menu_id' value='<?php echo $row2[0]; ?>'>
                <input type='submit' class='<?php echo "$status_class"; ?>' name='food_status' value='<?php echo $row2[4]; ?>'>
          </form>
          </td>
          <td>
          <button type='submit' class='btn btn-warning'><a style="color:white; text-decoration:none;" href='stall_menu_update.php?menu_id=<?php echo $row2[0]; ?>'>Update</a></button>
            <button type='submit' class='btn btn-danger'><a style="color:white; text-decoration:none;" href='stall_menu_delete.php?menu_id=<?php echo $row2[0]; ?>'>Delete</a></button>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</form>
 <form method='post' action='add_menu.php'>
<input type='submit' class='btn btn-primary' value='Add'>
 </form>
       
<?php
  mysqli_free_result($result);
  mysqli_close($conn);
?>

<script>
  function copyfoodname(foodname) {
    document.getElementById('food_name').value = foodname;
  }
  function copyprice(price) {
    document.getElementById('price').value = price;
  }
</script>

    </body>
    </html>