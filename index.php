<?php include('partials/navbar.php');
      include('config.php');
?>

   <!-- restaurant sEARCH Section Starts Here -->
   <section class="restaurant-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>restaurant-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for restaurant.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- restaurant sEARCH Section Ends Here -->




    <!-- locations Section Starts Here -->
 <section class="locations">
        <div class="container">
            <h2 class="text-center">Explore restaurants</h2>

            <?php
                //create sql query to display locations from database
                $sql="SELECT *FROM `location` WHERE active='Yes' AND featured='Yes' LIMIT 4 ";

                //execute the query
                $res=mysqli_query($conn,$sql);
                //count rows to check whether the location is available or not
                $count=mysqli_num_rows($res);

                if($count>0)
                {
                    //locations available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the values like id,location,image name
                        $id=$row['id'];
                        $location=$row['location'];
                        $image=$row['image'];
                        ?>
                        <a href="<?php echo SITEURL;?>location-restaurant.php?location_id=<?php echo $id;?>">
                            <div class="box-3 float-container" height="350">

                                <?php
                                //check whether image is available or not
                                if($image=="")
                                {
                                    //display image
                                    echo "<div class='error'>Image not Available.</div>";
                                }
                                else
                                {
                                ?>
                                         <img src="<?php echo SITEURL;?>images/location/<?php echo $image;?>" alt="hotels" class="image img-responsive img-curve" height="250">
                                         <div class="middle">
                                    <?php
                                }


                                    ?>
                        
                                <h3 class="text"><?php echo $location; ?></h3>
                            </div>
        </div>
            
                        </a>

                        <?php
                    }
                }
                else
                {
                    //locations not available
                    echo "<div class='error'>location not Added</div>";
                }
                        ?>
          

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- locations Section Ends Here -->


  




    

    <!-- restaurant MEnu Section Starts Here -->
    <section class="restaurant-menu">
        <div class="container">
            <h2 class="text-center">restaurant List</h2>

            <?php
            //getting restaurants from database that are active and featured
            //sql query
            $sql2="SELECT *FROM restaurant WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //execute the query
            $res2=mysqli_query($conn,$sql2);

            //count the rows
            $count2=mysqli_num_rows($res2);

            //check whether restaurant avalable or not
            if($count2>0)
            {
                //restaurant available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //get all the values
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $opening_timing=$row['opening_timing'];
                    $closing_timing=$row['closing_timing'];
                    $description=$row['description'];
                    $image=$row['image'];

                    ?>
                        <div class="restaurant-menu-box">
                            <div class="restaurant-menu-img">
                                <?php
                                    //check whether image available or not
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
                                 <h4><?php echo $title; ?></h4>
                                     <p class="restaurant-price"><?php echo "Per Person:₹$price"; ?></p>
                                     <p class="restaurant-detail">
                                     <?php echo "Opening time  :$opening_timing"; ?><br>
                                     <?php echo " Closing time           : $closing_timing"; ?><br>
                                     
                                     <?php echo $description; ?>
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
                //restaurant not available
                echo "<div class='error'>restaurant not available.</div>";
            }
            ?>
           
           


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All restaurants</a>
        </p>
    </section>
    <!-- restaurant Menu Section Ends Here -->

     
    <?php include('partials/footer.php')?>