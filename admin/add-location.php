<?php
include('partials/navbar.php');

?>
      
      <div class="main-content">
        <div class="wrapper">
        <h1>Add Location</h1>

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
    <!-- add location starts here -->
    <form action="" method="POST" enctype="multipart/form-data">
        <table class=tbl-30>
            <tr>
                <td>Location:</td>
                <td>
                    <input type="text" name="location" placeholder="location">
                </td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            

            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                </td>
            </tr>

            <tr>
                
                <td colspan="2" >
                    <input type="submit" name="submit" value="Add location" class="btn-secondary">
                  
                </td>
            </tr>
        </table>
    </form>
    <!-- add location ends here -->

    <?php
        //check whether submit button is clicked or not
        if(isset($_POST['submit']))
        {
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
                        header("location:".SITEURL.'admin/add-location.php');
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

            //creatye sql query to insert location into database
            $sql="INSERT INTO `location` SET
                    location='$location',
                    image='$image',
                    featured='$featured',
                    active='$active'
                    ";
                    //execute the query and save into database
                    $res=mysqli_query($conn,$sql);

                    //check whether the query executed or not and data added or not
                    if($res==true)
                    {
                        //query executed and location added
                        $_SESSION['add'] = "<div class='success'>location added successfully.</div>";
                        //Redirecting page manage admin
                        header("location:".SITEURL.'admin/manage-location.php');
                    }
                    else
                    {
                        //failed to add location
                        $_SESSION['add'] = "<div class='error'>Failed to add location.</div>";
                        //Redirecting page manage admin
                        header("location:".SITEURL.'admin/add-location.php');
                    }
	        
	       
        }
	
    ?>
        

        </div>
    </div>

    

      

<?php
include('partials/footer.php');
?>




