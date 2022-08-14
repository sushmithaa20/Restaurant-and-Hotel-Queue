<?php include('partials/navbar.php');
    include('config.php');?>

    <!-- restaurant sEARCH Section Starts Here -->
    <section class="restaurant-search text-center">
        <div class="container">
            
            <form action="restaurant-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for restaurant.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- restaurant sEARCH Section Ends Here -->








  <!-- restaurant MEnu Section Starts Here -->
  <section class="restaurant-menu">
        <div class="container">
            <h2 class="text-center">restaurant Menu</h2>

            <?php 
             

                //sql query to get restaurant based on search keyword
                $sql="SELECT *FROM restaurant WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //execute the query
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
                                                    echo "<div class='error'>Image not available.</div>";
                                                }
                                                else
                                                {
                                                    ?>
                                                        <img src="<?php echo SITEURL; ?>images/restaurant/<?php echo $image; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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

                                            <a href="<?php echo SITEURL; ?>reservation.php?restaurant_id=<?php echo $id; ?>" class="btn btn-primary">Reserv Your Table  Now</a>
                                        </div>
                             </div>

                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>restaurant not Found.</div>";
                }
            
            ?>
          

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- restaurant Menu Section Ends Here -->

   
    
    <?php include('partials/footer.php')?>