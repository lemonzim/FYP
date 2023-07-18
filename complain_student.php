<?php
	include 'conn.php';
    date_default_timezone_set('Asia/Singapore');
	session_start();
    $id = $_SESSION['student_id'];
    $result = mysqli_query($conn, "SELECT * from student where student_id='$id'");
    $row = mysqli_fetch_row($result);
    $order_id = $_GET['order_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
            // https://dashboard.emailjs.com/admin/account
            emailjs.init('ndaFkzNWnW-z2a7qz');
        })();
    </script>
    <script type="text/javascript">
        window.onload = function() {
            var form = document.getElementById('contact-form');
            form.addEventListener('submit', function(event) {
            event.preventDefault();
            // generate a five digit number for the contact_number variable
            this.contact_number.value = Math.random() * 100000 | 0;
            // these IDs from the previous steps
            emailjs.sendForm('contact_service', 'contact_form', this)
            .then(function() {
                console.log('SUCCESS!');
                // submit the form to sendcomplain.php
                form.submit();
            }, function(error) {
                console.log('FAILED...', error);
            });
    });
}
    </script>
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
    $order = mysqli_query($conn, "SELECT * from order_table where order_id=$order_id");
    $order_row = mysqli_fetch_assoc($order);
    $menu_info = mysqli_query($conn, "SELECT * from menu where menu_id = {$order_row['menu_id']}")or die(mysqli_error($conn));
    $menu_info_row = mysqli_fetch_assoc($menu_info);
    $stall_info = mysqli_query($conn, "SELECT * from stall where stall_id IN (select stall_id FROM menu where menu_id = {$order_row['menu_id']})" );
    $stall_info_row = mysqli_fetch_row($stall_info);
    $reason_table = mysqli_query($conn, "SELECT * from reason where target IN ('stall', 'both')");
    $reason_row = mysqli_fetch_row($reason_table);
    ?>
    <div class='main'>
    <form  onsubmit="return validateform()" name='complain' action="sendcomplain.php" method='post' id="contact-form">
        
    <div class='flex'>
        <legend class="col-form-label col-sm-2 pt-0">Complain</legend>
        <input type="hidden" name="contact_number">
        
        <div class="mb-3">
            <label for="order_id" class="form-label">Order ID</label>
            <input readonly aria-describedby="emailHelp" class="form-control" type="text" name="order_id" value="<?php echo "$order_id" ?>">
        </div>
        
        <div class="mb-3">
            <label for="food" class="form-label">Food</label>
            <input aria-describedby="emailHelp" class="form-control" readonly type="text" name="food_name" value="<?php echo $menu_info_row['food_name']; ?>">
        </div>

        <div class="mb-3">
            <label for="student id" class="form-label">Student ID</label>
            <input aria-describedby="emailHelp" class="form-control" readonly type="text" name="complainer" value=<?php echo "$id"; ?>>
            <input  type="hidden" name="complainer_id" value=<?php echo "$id"; ?>>
        </div>

        <div class="mb-3">
            <label for="stall" class="form-label">Stall</label>
            <input type="hidden" value="<?php echo "{$stall_info_row[0]}"; ?>">
            <input aria-describedby="emailHelp" class="form-control" readonly type="text" name="complaint_to" value="<?php echo "{$stall_info_row[1]}"; ?>">
        </div>
        
        <select required class='form-select form-select-sm' aria-label='Default select example' name='reason'>
        <option value='' selected>Reason</option>
        <?php
        	foreach( $reason_table as $reason_row ){
                $reason=$reason_row['reason'];
                echo "<option value='$reason'>" . $reason_row['reason'] . "</option>";
            }
        ?>
        </select><br>

        <label>Description</label>
        <textarea name="description"></textarea>
        <button type="submit"  class="button btn btn-primary">Send</button>
        <button type="button"  class="button btn btn-dark"><a href="history_student.php">Back</a></button>
    </div>
    </form>
    </div>
</body>
</html>