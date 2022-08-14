<?php include('partials/navbar.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update admin</h1>

        <br /><br />

        <?php
            //check whether the id is set or not
            if(isset($_GET['id']))
            {
                //get the id and all other details
                $id=$_GET['id'];
                $sql="SELECT * FROM `location` WHERE id=$id";

                 //execute the query
                $res=mysqli_query($conn,$sql);

                //count the rows to check whether the id is valid or not
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    //get all the data
                    $row=mysqli_fetch_assoc($res);
                    $location=$row['location'];
                    $current_image=$row['image'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                }
                else
                {
                    //redirect to manage location with session message
                    $_SESSION['no-location-found'] = "<div class='error'>location not found.</div>";
                    //Redirecting page manage admin
                     header("location:".SITEURL.'admin/manage-location.php');
                }

            }
            else
            {
                //redirect to manage location page
                header("location:".SITEURL.'admin/manage-location.php');
            }
           ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>location:</td>
                    <td>
                        <input type="text" name="location" value="<?php echo $location; ?>">
                    </td>


                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image!="")
                            {
                                //display the image
                                ?>
                                <img src="<?php echo SITEURL;?>images/location/<?php echo $current_image;?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //display message
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                    <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                    <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                    <input  <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                    <input  <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                    <input  <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Update location" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>


        <?php
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //1.get all the value fro  the form
                $id=$_POST['id'];
                $location=$_POST['location'];
                $current_image=$_POST['current_image'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                //2.updating the image if selected
                //check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //get the image details
                    $image=$_FILES['image']['name'];

                    //check whether image is available or not
                    if($image!="")
                    {
                        //image available
                        //upload the new image



                        
                                    //auto rename our image
                                //Get the extension of our image(jpg,png,gif,etc)e.g "restaurant1.jpg
                                $ext=end(explode('.',$image));

                                //rename the image
                                $image="restaurant_location_".rand(000,999).'.'.$ext;//e,g restaurant_location_834.jpg

                                $source_path=$_FILES['image']['tmp_name'];

                                $destination_path="../images/location/".$image;

                                //finally upload the image 
                                $upload=move_uploaded_file($source_path,$destination_path);

                                //check whether the image is uploaded or not
                                //And if the image is not uploaded then we will stop the process and redirect with error mmessage
                                if($upload==false)
                                {
                                    //set message
                                    $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                                    //redirect ti add-location page
                                    header("location:".SITEURL.'admin/manage-location.php');
                                    //stop the process
                                    die();
                                    
                                }
                        //remove the current image if available
                        if($current_image!="")
                        {
                            $remove_path="../images/location/".$current_image;

                            $remove=unlink($remove_path);
                            //check whether the image is removed or not
                            //if failed to remove display the image and stop the process
                            if($remove==false)
                            {
                                $_SESSION['failed remove']="<div class='error'>Failed to remove current image.</div>";
                                header("location:".SITEURL.'admin/manage-location.php');
                                die();//stop the process
                            }
                        }
                    }
                    else
                    {
                        $image=$current_image;
                    }
                }
                else
                {
                    $image=$current_image;
                }

                //3.update the database
                $sql2="UPDATE location SET 
                        location='$location',
                        image='$image',
                        featured='$featured',
                        active='$active'
                        WHERE id=$id
                        "; 
                
                //execute the query
                $res2=mysqli_query($conn,$sql2);


                //4.redirect to manage with message
                //check whether executed or not
                if($res2==true)
                {
                    //location updated
                    $_SESSION['update']="<div class='success'>location Updated Successfully.</div>";
                    header("location:".SITEURL.'admin/manage-location.php');
                }
                else
                {
                    //failed to update location
                    $_SESSION['update']="<div class='error'>Failed to Update location.</div>";
                    header("location:".SITEURL.'admin/manage-location.php');
                }

            }
        
        
        ?>

</div>
</div>

<?php include('partials/footer.php')?>