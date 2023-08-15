<?php
	include 'conn.php';
    date_default_timezone_set('Asia/Singapore');
	session_start();
    $id = $_SESSION['admin_id'];
    $stall_id=$_GET['stall_id'];

?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title></title>
    <style>
        * {
            box-sizing: border-box;
        }
        body{
            background-color: #1D1D1D;
        }
        .flex{
         background-color: white;
         width: 30%;
         display: flex;
         flex-direction: column;
         justify-content: center;
         padding: 10px;
         box-shadow: 0px 0px 10px rgba(68, 219, 124, 1);
         width: 170%; 
        }
        .main{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width:100%;
        }
        .button{
            margin-top: 10px;
        }

    </style>
</head>
<body>
    <?php
    $stall_info = mysqli_query($conn, "SELECT * from stall where stall_id =$stall_id")or die(mysqli_error($conn));
    $stall_info_row = mysqli_fetch_assoc($stall_info);
    ?>
    <div class='main'>
    <form name='complain' action="admin_update_stall_process.php" method='post' enctype="multipart/form-data" id="contact-form">
        
    <div class='flex'>
        <legend class="col-form-label col-sm-2 pt-0">Update Stall</legend>
       
        <div class="mb-3">
            <label for="stall" class="form-label">Old Stall ID</label>
            <input type="text" class="form-control" name="old_stall_id" readonly value="<?php echo "{$stall_info_row['stall_id']}"; ?>">
        </div>

        <div class="mb-3">
            <label for="stall" class="form-label">New Stall ID</label>
            <input type="text" class="form-control" name="new_stall_id" value="<?php echo "{$stall_info_row['stall_id']}"; ?>">
        </div>

        <div class="mb-3">
            <label for="order_id" class="form-label">Stall Name</label>
            <input aria-describedby="emailHelp" class="form-control" type="text" name="stall_name" value="<?php echo "{$stall_info_row['stall_name']}" ?>">
        </div>
        
        <div class="mb-3">
            <label for="food" class="form-label">Email</label>
            <input aria-describedby="emailHelp" class="form-control" type="text" name="stall_email" value="<?php echo $stall_info_row['stall_email']; ?>">
        </div>
        <div class="mb-3">
            <label for="food" class="form-label">Phone Number</label>
            <input aria-describedby="emailHelp" class="form-control" type="text" name="stall_phone_num" value="<?php echo $stall_info_row['stall_phone_num']; ?>">
        </div>
        <div class="mb-3">
            <label for="food" class="form-label">Password</label>
            <input aria-describedby="emailHelp" class="form-control" type="text" name="stall_pass" value="<?php echo $stall_info_row['stall_pass']; ?>">
        </div>

       

        <button type="submit"  class="button btn btn-primary">Send</button>
        <button type="button"  class="button btn btn-dark"><a href="menu_admin.php">Back</a></button>
    </div>
    </form>
    </div>
</body>
</html>