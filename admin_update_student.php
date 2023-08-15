<?php
	include 'conn.php';
    date_default_timezone_set('Asia/Singapore');
	session_start();
    $id = $_SESSION['admin_id'];
    $student_id=$_GET['student_id'];

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
    $student_info = mysqli_query($conn, "SELECT * from student where student_id =$student_id")or die(mysqli_error($conn));
    $student_info_row = mysqli_fetch_assoc($student_info);
    ?>
    <div class='main'>
    <form name='complain' action="admin_update_student_process.php" method='post' enctype="multipart/form-data" id="contact-form">
        
    <div class='flex'>
        <legend class="col-form-label col-sm-2 pt-0">Update Student</legend>
        
        <div class="mb-3">
            <label for="stall" class="form-label">Old Student ID</label>
            <input type="text" class="form-control" name="old_student_id" readonly value="<?php echo "{$student_info_row['student_id']}"; ?>">
        </div>

        <div class="mb-3">
            <label for="stall" class="form-label">New Student ID</label>
            <input type="text" class="form-control" name="new_student_id" value="<?php echo "{$student_info_row['student_id']}"; ?>">
        </div>

        <div class="mb-3">
            <label for="order_id" class="form-label">Student Name</label>
            <input aria-describedby="emailHelp" class="form-control" type="text" name="student_name" value="<?php echo "{$student_info_row['student_name']}" ?>">
        </div>
        
        <div class="mb-3">
            <label for="food" class="form-label">Email</label>
            <input aria-describedby="emailHelp" class="form-control" type="text" name="student_email" value="<?php echo $student_info_row['student_email']; ?>">
        </div>
        <div class="mb-3">
            <label for="food" class="form-label">Phone Number</label>
            <input aria-describedby="emailHelp" class="form-control" type="text" name="student_phonenum" value="<?php echo $student_info_row['student_phonenum']; ?>">
        </div>
        <div class="mb-3">
            <label for="food" class="form-label">Password</label>
            <input aria-describedby="emailHelp" class="form-control" type="text" name="student_password" value="<?php echo $student_info_row['student_password']; ?>">
        </div>

       

        <button type="submit"  class="button btn btn-primary">Send</button>
        <button type="button"  class="button btn btn-dark"><a href="menu_admin.php">Back</a></button>
    </div>
    </form>
    </div>
</body>
</html>