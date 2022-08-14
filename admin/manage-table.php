<?php include('partials/navbar.php');
?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Tables</h1>

    
             

                <br /><br />
                <?php
                if(isset($_SESSION['add']))//checking whether the ssion is set or not
                    {
                        echo $_SESSION['add'];//displaying session message
                        unset($_SESSION['add']);//removing session message
                    }
                    

                    if(isset($_SESSION['remove']))//checking whether the ssion is set or not
                    {
                        echo $_SESSION['remove'];//displaying session message
                        unset($_SESSION['remove']);//removing session message
                    }

                    if(isset($_SESSION['delete']))//checking whether the ssion is set or not
                    {
                        echo $_SESSION['delete'];//displaying session message
                        unset($_SESSION['delete']);//removing session message
                    }
                    if(isset($_SESSION['no-tables-found']))//checking whether the ssion is set or not
                    {
                        echo $_SESSION['no-tables-found'];//displaying session message
                        unset($_SESSION['no-tables-found']);//removing session message
                    }
                    if(isset($_SESSION['upload']))//checking whether the ssion is set or not
                    {
                        echo $_SESSION['upload'];//displaying session message
                        unset($_SESSION['upload']);//removing session message
                    }

                    if(isset($_SESSION['failed-remove']))//checking whether the ssion is set or not
                    {
                        echo $_SESSION['failed-remove'];//displaying session message
                        unset($_SESSION['failed-remove']);//removing session message
                    }

                    if(isset($_SESSION['update1']))//checking whether the ssion is set or not
                    {
                        echo $_SESSION['update1'];//displaying session message
                        unset($_SESSION['update1']);//removing session message
                    }
                    ?>
                       <!-- Button to admin -->
                       <br /> <br />
                <a href="<?php echo SITEURL;?>admin/add-table.php" class="btn-primary">Add tables</a>
                    <br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Table No</th>
                        <th>Number Of Seats</th>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Image</th>
                    </tr>

                    <?php
                    //query to get all tables from database
                        $sql="SELECT *FROM tables";

                        //execute query
                        $res=mysqli_query($conn,$sql);

                        //count Rows
                        $count=mysqli_num_rows($res);

                        //create serial number variable and assigns value as 1
                        $ns=1;

                        //check whether we have data in database or not
                        if($count>0)
                        {
                            //we have data in database
                            //get the data and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id=$row['id'];
                                $table_no=$row['table_no'];
                                $no_of_seats=$row['no_of_seats'];
                                $price=$row['price'];
                                $size	=$row['size'];
                                $image=$row['image'];
                               
                                ?>
                                <tr>
                                     <td><?php echo $ns++;?></td>
                                    <td><?php echo $table_no;?></td>
                                    <td><?php echo $no_of_seats;?></td>
                                    <td><?php echo $price;?></td>
                                    <td><?php echo $size;?></td>
                                   

                                     <td>
                                         <?php
                                            //check whether image name is available or not
                                            if($image!="")
                                            {
                                                //display image
                                                ?>
                                                    <img src="<?php echo SITEURL;?>images/tables/<?php echo $image;?>" width="100px">

                                                <?php
                                            }
                                            else
                                            {
                                                //display message
                                                echo "<div class='error'>Image not Added</div>";
                                            }
                                         ?>
                                    </td>

                                     <td><?php echo $featured;?></td>
                                     <td><?php echo $active;?></td>
                
                                     <td>
                                         <a href="<?php echo SITEURL;?>admin/update-tables.php?id=<?php echo $id;?>"  class="btn-secondary">Update tables</a>
                                         <br />
                                         <a href="<?php echo SITEURL;?>admin/delete-tables.php?id=<?php echo $id;?>&image=<?php echo $image;?>" class="btn-danger">Delete tables</a>
                                     </td>
                                 </tr>


                                <?php
                            }
                        }
                        else
                        {
                            //we do not have data
                            //we'll display the message inside table
                            echo "<tr><td colspan='7' class='error'>tables not Added Yet.</td></tr>";
                        }
                    
                    ?>
                </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>