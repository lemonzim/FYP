<?php
	include 'conn.php';
    date_default_timezone_set('Asia/Singapore');
	session_start();
    $id = $_SESSION['stall_id'];
    $menu_id = $_GET['menu_id'];
    $result = mysqli_query($conn, "SELECT * from stall where stall_id='$id'");
    $row = mysqli_fetch_row($result);

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
    $menu_info = mysqli_query($conn, "SELECT * from menu where menu_id =$menu_id")or die(mysqli_error($conn));
    $menu_info_row = mysqli_fetch_assoc($menu_info);
    ?>
    <div class='main'>
    <form name='complain' action="update_menu.php?menu_id=<?php echo $menu_id?>" method='post' enctype="multipart/form-data" id="contact-form">
        
    <div class='flex'>
        <legend class="col-form-label col-sm-2 pt-0">Update Food</legend>
       
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="picture" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="stall" class="form-label">Stall</label>
            <input type="text" class="form-control" readonly value="<?php echo "{$row[1]}"; ?>">
        </div>

        <div class="mb-3">
            <label for="order_id" class="form-label">Food Name</label>
            <input aria-describedby="emailHelp" class="form-control" type="text" name="food_name" value="<?php echo "{$menu_info_row['food_name']}" ?>">
        </div>
        
        <div class="mb-3">
            <label for="food" class="form-label">Price</label>
            <input aria-describedby="emailHelp" class="form-control" type="text" name="price" value="<?php echo $menu_info_row['price']; ?>">
        </div>

       

        <button type="submit"  class="button btn btn-primary">Send</button>
        <button type="button"  class="button btn btn-dark"><a href="menu_stall.php">Back</a></button>
    </div>
    </form>
    </div>
</body>
</html>