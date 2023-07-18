<?php
include 'conn.php';

$sql="insert into stall (stall_id, stall_name, stall_email, stall_pass, stall_phone_num)
values ('$_POST[id]','$_POST[name]','$_POST[email]','$_POST[password]','$_POST[phone]')";
if(!mysqli_query($conn, $sql))
{
    die('Error: '.mysqli_error($conn));
}
else{
     echo '<script>language="javascript">alert("You succesfully registered!");
          window.location.href="loginstall.php";
			</script>';
}
?>