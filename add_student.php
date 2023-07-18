<?php
include 'conn.php';

$sql="insert into student (student_id, student_name, student_email, student_password, student_phonenum)
values ('$_POST[id]','$_POST[name]','$_POST[email]','$_POST[password]','$_POST[phone]')";
if(!mysqli_query($conn, $sql))
{
    die('Error: '.mysqli_error($conn));
}
else{
     echo '<script>language="javascript">alert("You succesfully registered!");
          window.location.href="loginpage.php";
			</script>';
}
?>