<?php include('partials/navbar.php');
      include('config.php');?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore restaurant</h2>

            <?php
                 
                 //create sql query to display categories from database
                 $sql="SELECT *FROM `location`  WHERE active='Yes'";
 
                 //execute the query
                 $res=mysqli_query($conn,$sql);
                 //count rows to check whether the location` is available or not
                 $count=mysqli_num_rows($res);
 
                 if($count>0)
                 {
                     //categories available
                     while($row=mysqli_fetch_assoc($res))
                     {
                         //get the values like id,location,imaage name
                         $id=$row['id'];
                         $location=$row['location'];
                         $image=$row['image'];
                         ?>
                               <a href="<?php echo SITEURL;?>location`-restaurant.php?location`_id=<?php echo $id;?>">
                              <div class="box-3 float-container">
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
                                      <img src="<?php echo SITEURL;?>images/location/<?php echo $image;?>" class="image img-responsive img-curve height" height="250" >
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
                     //categories not available
                     echo "<div class='error'>location` not Found</div>";
                 }
             ?>
           


            
           

           
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<

<?php include('partials/footer.php')?>