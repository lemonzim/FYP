<div class="sidenav">
        <?php
                $stall_query = mysqli_query($conn, "SELECT * from stall ORDER BY stall_id");//Table stall dalam susunan abjad
                $stall_query_row = mysqli_fetch_row($stall_query);
                 
                $first_menu = mysqli_query($conn, "SELECT * from menu where stall_id='$stall_query_row[0]'");
                
                if(isset($_GET['stall_id']))//kalau ada stall id 
                {
                    $stall_id = $_GET['stall_id'];
                    //Dapatkan nama each stall_id 
                    $stall_name = mysqli_query($conn, "SELECT * from stall where stall_id=$stall_id ORDER BY stall_name");
                    //nak dapatkan each nama dalam banyak row
                    $stall_name_row = mysqli_fetch_row($stall_name);


                    $second_menu = mysqli_query($conn, "SELECT * from menu where stall_id='$stall_id'");
                } else //Kalau takde stall id (baru masuk menu) akan automatik tunjuk gerai 1
                {
                    $stall_id = 0;
                }
                 //$stall_id=$_GET['stall_id'];
                    
                    echo "<h3>$row[1]</h3>";
                    mysqli_data_seek($stall_query, 0);
                    while($stall_query_row2 = mysqli_fetch_row($stall_query)){
                        echo "<a href=menu_student.php?stall_id=$stall_query_row2[0]>$stall_query_row2[1]</a>";
                    }
        echo"<a href=order.php>Order</a>";
        echo"<a href=history_student.php>History</a>";
        ?>
        </div>
        