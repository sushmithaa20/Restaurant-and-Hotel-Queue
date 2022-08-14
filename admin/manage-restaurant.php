<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage restaurant</h1>

    
             

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
                    if(isset($_SESSION['no-restaurant-found']))//checking whether the ssion is set or not
                    {
                        echo $_SESSION['no-restaurant-found'];//displaying session message
                        unset($_SESSION['no-restaurant-found']);//removing session message
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
                <a href="<?php echo SITEURL;?>admin/add-restaurant.php" class="btn-primary">Add restaurant</a>
                    <br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Opening Time</th>
                        <th>Closing Time</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    //query to get all restaurant from database
                        $sql="SELECT *FROM restaurant";

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
                                $title=$row['title'];
                                $description=$row['description'];
                                $price=$row['price'];
                                $opening_timing	=$row['opening_timing'];
                                $closing_timing=$row['closing_timing'];
                                $image=$row['image'];
                                $featured=$row['featured'];
                                $active=$row['active'];

                                ?>
                                <tr>
                                     <td><?php echo $ns++;?></td>
                                    <td><?php echo $title;?></td>
                                    <td><?php echo $description;?></td>
                                    <td><?php echo $price;?></td>
                                    <td><?php echo $opening_timing;?></td>
                                    <td><?php echo $closing_timing;?></td>

                                     <td>
                                         <?php
                                            //check whether image name is available or not
                                            if($image!="")
                                            {
                                                //display image
                                                ?>
                                                    <img src="<?php echo SITEURL;?>images/restaurant/<?php echo $image;?>" width="100px">

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
                                         <a href="<?php echo SITEURL;?>admin/update-restaurant.php?id=<?php echo $id;?>"  class="btn-secondary">Update restaurant</a>
                                         <br />
                                         <a href="<?php echo SITEURL;?>admin/delete-restaurant.php?id=<?php echo $id;?>&image=<?php echo $image;?>" class="btn-danger">Delete restaurant</a>
                                     </td>
                                 </tr>


                                <?php
                            }
                        }
                        else
                        {
                            //we do not have data
                            //we'll display the message inside table
                            echo "<tr><td colspan='7' class='error'>restaurant not Added Yet.</td></tr>";
                        }
                    
                    ?>
                </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>