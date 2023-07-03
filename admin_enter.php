<?php
    $con = mysqli_connect("localhost", "root", "") or die ("Unable to connect");
    mysqli_select_db($con, "datcen");
?>
<?php
if(isset($_POST['login']))
{
    $id = $_POST['id'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM admin WHERE admin_id='$_POST[id]' AND admin_pass='$_POST[password]'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result)>0)
    {
        session_start();
        $_SESSION['admin_id']=$_POST['id'];
        header('location:menu_admin.php');
    }
    else
    {
         echo '<script>language="javascript">alert("Invalid Student ID or password!");
          window.location.href="loginadmin.php";
			</script>';
    }
}
?>