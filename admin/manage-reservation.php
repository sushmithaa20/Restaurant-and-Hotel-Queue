<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage reservation</h1>

    <br /><br />
                <!-- Button to admin -->
                
                <?php
                 if(isset($_SESSION['update']))
                 {
                     echo $_SESSION['update'];
                     unset($_SESSION['update']);
                 }
                
                ?>
                <br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>restaurant</th>
                        <th>Price</th>
                        <th>No of Pepole</th>
                        <th>Total</th>
                        <th>Reserve Time</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Customer Email</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //get the reservations from database
                        $sql="SELECT *FROM reservation";
                        $res=mysqli_query($conn,$sql);
                        $count=mysqli_num_rows($res);

                        $sn=1;
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id=$row['id'];
                                $restaurant=$row['restaurant'];
                                $price=$row['price'];
                                $no_of_tables=$row['no_of_tables'];
                                $total=$row['total'];
                                $booking_time=$row['booking_time'];
                                $status=$row['status'];
                                $customer_name=$row['customer_name'];
                                $customer_contact=$row['customer_contact'];
                                $customer_email=$row['customer_email'];

                                ?>
                                    <tr>
                                        <td><?php echo $sn++;?>.</td>
                                        <td><?php echo $restaurant;?></td>
                                        <td><?php echo $price;?></td>
                                        <td><?php echo $no_of_tables;?></td>
                                        <td><?php echo $total;?></td>
                                        <td><?php echo $booking_time;?></td>
                                        <td>
                                            <?php 
                                            if($status=="reservationed")
                                            {
                                                echo "<label>$status</label>";
                                            }
                                            elseif($status=="On Delivery")
                                            {
                                                echo "<label style='color:orange;'>$status</label>";
                                            }
                                            elseif($status=="Delivered")
                                            {
                                                echo "<label style='color:green;'>$status</label>";
                                            }
                                            elseif($status=="Cancelled")
                                            {
                                                echo "<label style='color:red;'>$status</label>";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $customer_name;?></td>
                                        <td><?php echo $customer_contact;?></td>
                                        <td><?php echo $customer_email;?></td>
                                       
                                        <td>
                                            <a href="<?php  echo SITEURL;?>admin/update-reservation.php?id=<?php echo $id;?>" class="btn-secondary">Update reservation</a>
                                        </td>
                                    </tr>
                                        
                                        
                                    

                                <?php
                            }
                        }
                        else {
                            echo "<tr><td colspan='12' class='error'>reservations not Available.</td></tr>";
                        }
                    
                    
                    ?>
    
            
            
                </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>