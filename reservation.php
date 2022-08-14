<?php include('partials/navbar.php');
      include('config.php');
     
      
      ?>
    
<?php



// if (isset($_SESSION['username'])==true) {
//     header("Location:reservation.php");
// }
// else{
//     header("Location:userlogin.php");
// }

if(isset($_GET['table']))//checking whether the ssion is set or not
{
    echo $_SESSION['table'];//displaying session message
    unset($_SESSION['table']);//removing session message
}





    if(isset($_GET['restaurant_id']))
    {
        //get the restaurant id and details of selected restaurant
        $restaurant_id=$_GET['restaurant_id'];

        $sql="SELECT *FROM restaurant WHERE id=$restaurant_id";

        $res=mysqli_query($conn,$sql);

        $count=mysqli_num_rows($res);

        if($count==1)
        {
            $row=mysqli_fetch_assoc($res);
            $title=$row['title'];
            $price=$row['price'];
            $image=$row['image'];
            
        }
        else
        {
            header('location:'.SITEURL);
        }
    }
    else
    {
        //redrect to homepage
        header('location:'.SITEURL);
    }
?>

    <!-- restaurant sEARCH Section Starts Here -->
    <section class="restaurant-search">
        <div class="container">
            
            <h2 class="text-center text-white color"></h2>

            <form action="" method="POST" class="reservation" style="margin-right:200px;margin-left:200px;margin-top:285px">
                <fieldset>
                    <legend class="legend" style="color:white">Selected restaurant</legend>

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
                        <h3 style="color:white"><?php echo $title;?></h3>
                        <input type="hidden" name="restaurant"  value="<?php echo $title;?>">
                        <p class="reservation-price" style="color:white"><?php echo "₹$price";?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <div class="reservation-label" style="color:white">No of tables Available:6</div>
                        <input type="number" name="no_of_tables" class="input-responsive" value="1" required>
                        <?php 
                        ?>
                       
                        <?php   ?>
                                </div>
                   
                </fieldset>
                
                
                <fieldset>
                    <div id="reserv">
                    <legend class="legend" style="color:white">Reserve Details</legend>
                 
                    <div class="reservation-label" style="color:white">Number of Guests</div>
                    <input type="text" name="fullname" placeholder="Number of Guest" class="input-responsive" required>
                    
                    <div class="reservation-label" style="color:white">Date</div>
                    <!-- <input type="date" name="date" id ="entered_date" placeholder="01/02/2022" class="input-responsive" required> -->
                    <!-- <label>BOOKING DATE : </label> -->
            <br>
            <input type ="date" name="date"
            id="datefield" min='1899-01-01'  placeholder="ENTER THE DATE FOR BOOKING">
            <br><br>

                
                    <div class="reservation-label" style="color:white">Available Time</div>
                    <input type="time" name="Available-Time" placeholder="E.g 1.00pm" class="input-responsive" required>
                    <h1>Result</h1>
                    <script src="script.js"> </script>

                    <div class="reservation-label" style="color:white">Suggestion</div>
                    <input type="description" name="suggestion" placeholder="" class="input-responsive" required>
                    
                    <br/>
                    <br/>
                    <button><input type="submit" name="submit" value="Confirm reservation" class="btn btn-primary"></button>
                    <script src="script.js"> </script>

                    </div>
                </fieldset>  




                 
            </form>     
            
        <?php   
        

        $sql="SELECT *FROM reservation";

        //execute the query
        $res=mysqli_query($conn,$sql);

        $count=mysqli_num_rows($res);

        if($count>0)
        {
            while($row=mysqli_fetch_assoc($res))
            {
                $id=$row['id'];
            }
        }
        
        if (isset($_POST['submit'])) {
                     $restaurant=$_POST['restaurant'];
                     $price=$_POST['price'];
                     $no_of_tables=$_POST['no_of_tables'];
                     $total=$price * $no_of_tables;
                     $booking_time=$_POST['Available-Time'];
                     $booking_date=$_POST['date'];
                     $status="reservationed";//reservationed,on deleivery,delivered,cancelled
                     

	if ($no_of_tables < 6) {
		$sql2=" INSERT INTO reservation (restaurant, price, no_of_tables, total, booking_date, booking_time)
        VALUES ('$restaurant','$price', '$no_of_tables', '$total', '$booking_date', '$booking_time')";

                            
                        //echo $sql2;die();
			$result = mysqli_query($conn, $sql2);
			if ($result) {
               
                echo "<script>window.open('payment.php?reservation_id=$id','_self')</script>";
               
			} else {
				
                echo "<script>window.open('reservation.php','_self')</script>";
               
			}
		} else {
			echo "<script>alert('$no_of_tables Tables are not available')</script>";
		}
		
}

?>



        </div>
    </section>
    <!-- restaurant sEARCH Section Ends Here -->

    <script>
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
             dd = '0' + dd
        }
        if (mm < 10) {
              mm = '0' + mm
        }

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("datefield").setAttribute("min", today);

       

    </script>