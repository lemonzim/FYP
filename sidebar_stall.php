<div class="sidenav">
        <?php
                $stall_query = mysqli_query($conn, "SELECT * from stall WHERE stall_id=$id");//Table stall dalam susunan abjad
                $stall_query_row = mysqli_fetch_row($stall_query);

                $menu = mysqli_query($conn, "SELECT * from menu where stall_id='$id'");
        
        echo "<h3>$stall_query_row[1]</h3>";
        echo"<a href=menu_stall.php>Menu</a>";
        echo"<a href=history_stall.php>Order</a>";
        echo"<a href=report_stall.php>Report</a>";
        ?>
        </div>
        