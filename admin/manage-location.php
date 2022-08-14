<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage location</h1>

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

                    if(isset($_SESSION['no-location-found']))//checking whether the ssion is set or not
                    {
                        echo $_SESSION['no-location-found'];//displaying session message
                        unset($_SESSION['no-location-found']);//removing session message
                    }

                    if(isset($_SESSION['update']))//checking whether the ssion is set or not
                    {
                        echo $_SESSION['update'];//displaying session message
                        unset($_SESSION['update']);//removing session message
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


                ?>
                <br /><br />
                <!-- Button to admin -->
                <a href="<?php echo SITEURL;?>admin/add-location.php" class="btn-primary">Add location</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Location</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    //query to get all categories from database
                        $sql="SELECT *FROM `location`";

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
                                $location=$row['location'];
                                $image=$row['image'];
                                $featured=$row['featured'];
                                $active=$row['active'];

                                ?>
                                <tr>
                                     <td><?php echo $ns++;?></td>
                                    <td><?php echo $location;?></td>

                                     <td>
                                         <?php
                                            //check whether image name is available or not
                                            if($image!="")
                                            {
                                                //display image
                                                ?>
                                                    <img src="<?php echo SITEURL;?>images/location/<?php echo $image;?>" width="100px">

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
                                         <a href="<?php echo SITEURL;?>admin/update-location.php?id=<?php echo $id;?>" class="btn-secondary" class="btn-secondary">Update location</a> 
                                         <a href="<?php echo SITEURL;?>admin/delete-location.php?id=<?php echo $id;?>&image=<?php echo $image;?>" class="btn-danger">Delete location</a>
                                     </td>
                                 </tr>


                                <?php
                            }
                        }
                        else
                        {
                            //we do not have data
                            //we'll display the message inside table
                            ?>
                            <tr>
                                <td><div class="error">No location Added.</div><td>
                            </tr>

                            <?php
                        }
                    
                    ?>
                    

                   
                </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
