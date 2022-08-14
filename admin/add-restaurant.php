

<?php include('partials/navbar.php');?>

<div class="main-content">
    <div class="wrapper">
    <h1>Add restaurant</h1>
    <br /><br />
    <?php
                    if(isset($_SESSION['add']))//checking whether the ssion is set or not
                    {
                        echo $_SESSION['add'];//displaying session message
                        unset($_SESSION['add']);//removing session message
                    }
                    if(isset($_SESSION['upload']))//checking whether the ssion is set or not
                    {
                        echo $_SESSION['upload'];//displaying session message
                        unset($_SESSION['upload']);//removing session message
                    }

                ?>

                <br />
                <br />

    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" placeholder="Title of the restaurant">
                </td>
            </tr>
            
            <tr>
                <td>Opening time:</td>
                <td>
                    <input type="time" name="opening_timing">
                </td>
            </tr>
            
            <tr>
                <td>Closing Time:</td>
                <td>
                    <input type="time" name="closing_timing">
                </td>
            </tr>
            
            <tr>
                <td>Price for one Person:</td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>

            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" cols="30" rows="5" placeholder="Description of the restaurant"></textarea>
                </td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>location:</td>
                <td>
                    <select name="location"><!--drop down-->
                        <?php 
                            //create php code to display location from database
                            //1.Create sql to get active location from database
                        
                            $sql="SELECT *FROM `location` WHERE active='Yes'";

                            //execute th query
                            $res=mysqli_query($conn,$sql);

                            //count rows to check whether we have location or not
                            $count=mysqli_num_rows($res);
                            //if count is greater than zero,we have location else we donot have location 
                            if($count>0)
                            {
                                //we have location
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the details of location
                                    $id=$row['id'];
                                    $location =$row['location'];
                                    ?>
                                          <option value="<?php echo $id;?>"><?php echo $location;?></option>
                                    <?php
                                }
                    
                            }
                            else
                            {
                                //we donot have location
                                ?>
                                     <option value="0">No location Found</option>
                                <?php
                            }
                           //2.display on drop down

                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                   <input type="radio"  name="featured" value="Yes">Yes
                   <input type="radio"  name="featured" value="No">No
                </td>
            </tr>

            <tr>
                <td>Acive:</td>
                <td>
                   <input type="radio"  name="active" value="Yes">Yes
                   <input type="radio"  name="active" value="No">No
                </td>
            </tr>

           
            <a href="<?php echo SITEURL;?>admin/add-restaurant.php" class="btn-primary">Add Table</a>
                            <br>
                            <br>
            <tr>
                
                <td colspan="2" >
                    <input type="submit" name="submit" value="Add restaurant" class="btn-secondary">
                  
                </td>
            </tr>

        </table>



    </form>

    <?php
        //check whether submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //add the restaurant in database
	        
            //1.get the data from form
            $title = $_POST['title'];
            $price = $_POST['price'];
            $opening_timing = $_POST['opening_timing'];
            $closing_timing = $_POST['closing_timing'];
            $description = $_POST['description'];
            $location = $_POST['location'];
           //for radio input,we need to check whether button is selected or not
           if(isset($_POST['featured']))
           {
               //get the value from form
               $featured = $_POST['featured'];
           }
           else
           {
               //set the default value
               $featured = "No";
           }

           if(isset($_POST['active']))
           {
               //get the value from form
               $active = $_POST['active'];
           }
           else
           {
               //set the default value
               $active = "No";
           }
            //2.upload the image if selected
              //check whether the choose image is selected or not and set the value for image name accordingly
            //print_r($_FILES['image']);//to print array

            //die();//break the code here

           if(isset($_FILES['image']['name']))
           {
               //upload image
               //to upload image name,source path and destination path
               $image=$_FILES['image']['name'];
               //upload the image only if image is selected
               if($image!="")
               {
                   //auto rename our image
               //Get the extension of our image(jpg,png,gif,etc)e.g "restaurant1.jpg
               $ext=end(explode('.',$image));

                   //rename the image
                   $image="restaurant_NAME_".rand(000,1000).'.'.$ext;//e,g restaurant_NAME_834.jpg

                   $source_path=$_FILES['image']['tmp_name'];

                   $destination_path="../images/restaurant/".$image;

                   //finally upload the image 
                   $upload=move_uploaded_file($source_path,$destination_path);

                   //check whether the image is uploaded or not
                   //And if the image is not uploaded then we will stop the process and redirect with error mmessage
                   if($upload==false)
                   {
                       //set message
                       $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                       //redirect ti add-location page
                       header("location:".SITEURL.'admin/add-restaurant.php');
                       //stop the process
                       die();
                       
                   }
               }
           }
           else
           {
               //dont upload image and set image name value as blank
               $image="";
           }
            //3.insert into database
            //for numerical value we donot need to pass value inside quotes '' But for string it is compulsary to add quotes ''
            $sql2="INSERT INTO restaurant SET
                    title='$title',
                    price=$price,
                    opening_timing='$opening_timing',
                    closing_timing='$closing_timing',
                    description='$description',
                    image='$image',
                    location_id=$location,
                    featured='$featured',
                    active='$active'
                    ";
                    //execute the query and save into database
                    $res2=mysqli_query($conn,$sql2);

                    //check whether the query executed or not and data added or not
                    if($res2==true)
                    {
                        //query executed and location added
                        $_SESSION['add'] = "<div class='success'>restaurant added successfully.</div>";
                        //Redirecting page manage admin
                        header("location:".SITEURL.'admin/manage-restaurant.php');
                    }
                    else
                    {
                        //failed to add location
                        $_SESSION['add'] = "<div class='error'>Failed to add Restaurant/Hotel.</div>";
                        //Redirecting page manage admin
                        header("location:".SITEURL.'admin/add-restaurant.php');
                    }
            //4.redirect with message to manage restaurant page





        }
    ?>

    </div>
</div>




<?php include('partials/footer.php');?>