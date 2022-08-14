<?php include('partials/navbar.php');
    include('config.php'); ?>
<?php
    if(isset($_GET['location_id']))
    {
        $location_id=$_GET['location_id'];
        $sql2="SELECT title FROM location WHERE id=$location_id";
        $res2=mysqli_query($conn,$sql2);
       
            $row2=mysqli_fetch_assoc($res2);
            $title=$row2['title'];
       
    }
    else
    {
    
        header('location:'.SITEURL);
    }

?>
   


 <!-- restaurant sEARCH Section Starts Here -->
 <section class="restaurant-searchh">
        <div class="container">
            
            <h2>restaurants on Your Search <a href="#" class="text-white"><?php echo $title;?></a></h2>

        </div>
    </section>
    <!-- restaurant sEARCH Section Ends Here -->


    <!-- restaurant MEnu Section Starts Here -->
    <section class="restaurant-menu">
        <div class="container">
            <h2 class="text-center">restaurant Menu</h2>

            <?php
                $sql="SELECT * FROM restaurant WHERE location_id='$location_id'";

                $res=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image=$row['image'];

                        ?>

                        <div class="restaurant-menu-box">
                                <div class="restaurant-menu-img">
                                    <?php
                                    if($image=="")
                                    {
                                        //image not available
                                        echo "<div class='error'>Image not available.</div>";
                                    }
                                    else
                                    {
                                        //image available
                                        ?>
                                             <img src="<?php echo SITEURL;?>images/restaurant/<?php echo $image;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                    ?>
                                   
                                </div>

                                <div class="restaurant-menu-desc">
                                    <h4><?php echo $title;?></h4>
                                    <p class="restaurant-price"><?php echo $price;?></p>
                                    <p class="restaurant-detail">
                                    <?php echo $description;?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>reservation.php?restaurant_id=<?php echo $id; ?>" class="btn btn-primary">reservation Now</a>
                                </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>restaurant not available.</div>";
                }
            
            ?>
          

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- restaurant Menu Section Ends Here -->

    <?php include('partials/footer.php'); ?>