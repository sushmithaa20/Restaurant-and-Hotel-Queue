<?php include('partials/navbar.php'); ?>

<div class="main-content">
            <div class="wrapper">
                <h1>Update restaurant</h1>


                <br /><br />



                <?php
                   //check whether id is set or not
                if(isset($_GET['id']))
                {
                    $Id=$_GET['id'];
                  //create sql querry to get all detail
                  $sql2="SELECT *FROM restaurant WHERE id=$Id";
                  //execute the query
                  $res2=mysqli_query($conn,$sql2);
                  $row2=mysqli_fetch_assoc($res2);
                  //count the rows to check whether id is valid or not
                      $Title=$row2['title'];
                      $Description=$row2['description'];
                      $Price=$row2['price'];
                      $Current_Image=$row2['image'];
                      $Current_location=$row2['location_id'];
                      $Featured=$row2['featured'];
                      $Active=$row2['active'];



                }
                else {
                    //redirect to manage restaurant
                    header('location:'.SITEURL.'admin/manage-restaurant.php');
                }




                ?>
                <form action="" method="POST"  enctype="multipart/form-data">
                <table class="tbl-30">
                <tr>
                <td>Title: </td>
                    <td><input type="text" name="Title" value="<?php echo $Title;?>" > </td>
                   
                </tr>
                <tr>
                <td>Description: </td>
                    <td> <textarea name="Description" cols="30" rows="5" value="<?php echo $Description;?>" ></textarea> </td>
                   
                </tr>
                <tr>
                <td>Price: </td>
                    <td><input type="number" name="Price" value="<?php echo $Price;?>" > </td>
                   
                </tr>
                <tr>
                <td> Current Image:</td>
                <td>
               <?php
                        
                        if($Current_Image!=="")
                        {
                            //display the image
                            ?>
                            
                            <img src="<?php echo SITEURL;?>images/restaurant/<?php echo $Current_Image; ?>" width="150px">
                            <?php
                        }
                        else {
                            //display msg
                            echo "<div class='error'>Image not available</div>";
                        }



               ?>
               </td>
               </tr>

               <tr>
                <td> Select New Image:</td>
                <td>
                    <input type="file" name="image">
               </td>
               </tr>
               <tr>
               <td> location:</td>
                <td>
                    <select name="location" >
                        <?php
                               //create sql to get all active restaurant from database

                           $sql="SELECT  *FROM location   WHERE active='Yes'";
                           $res=mysqli_query($conn,$sql);//executing query
                           //count the rows to check whether we have categories or not
                           $count=mysqli_num_rows($res);
                           //if count is >0 we have categories else we donot have categories
                           if($count>0)
                           {
                               //we have categories
                               while($row=mysqli_fetch_assoc($res))
                               {
                                  //get the details of location
                                  $location_id=$row['id'];
                                  $location_Title=$row['title'];
                                  ?>    
                                  <option <?php if($Current_location==$location_id){echo "selected";} ?>      value="<?php echo $Current_Id;?>"><?php  echo $location_Title;   ?></option>
                                  <?php
                               }
                            }
                           
                           else {
                            //we donot have categories
                            ?>
                            <option value="0">No location Found</option>
                            <?php
                        }
                   

                        ?>
                        
                        
                     </select>
                     </td>
              </tr>
              
              <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($Featured=="Yes"){ echo "checked";} ?>   type="radio" name="Featured" value="Yes">Yes
                        <input <?php if($Featured=="No"){ echo "checked";} ?>  type="radio" name="Featured" value="No">No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                    <input  <?php if($Active=="Yes"){ echo "checked";} ?> type="radio" name="Active" value="Yes">Yes
                    <input   <?php if($Active=="No"){ echo "checked";} ?>  type="radio" name="Active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td >
                    <input type="hidden" name="Current_Image" value="<?php echo $Current_Image; ?>" >
                    <input type="hidden" name="Id" value="<?php echo $Id; ?>" >
                   <input type="submit" name="submit"  value="Update restaurant" class="btn-secondary">
                </td>
                </tr>



</table>
</form>
<?php
if(isset($_POST['submit']))
{
    //1.get all the details from the form 

    $Id=$_POST['Id'];
         $Title=$_POST['Title'];
         $Description=$_POST['Description'];
        $Price=$_POST['Price'];
          $Current_Image=$_POST['Current_Image'];
          $location=$_POST['location'];
          $Featured=$_POST['Featured'];
          $Active=$_POST['Active'];
    //2.upload the image if selected
    if(isset($_FILES['image']['name']))
    {
        //get image detail
        $image=$_FILES['image']['name'];
        //check whether image is available or not
        if( $image!=="")
        {
            //uploading new image
            $ext=end(explode('.',$image));
            $image="restaurant-Name-".rand(000,999).'.'.$ext;
            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/restaurant".$image;
            $upload=move_uploaded_file($source_path,$destination_path);
                   if($upload==false)
           {
              $_SESSION['upload']= "<div class='error'> failed to upload  new image</div>";
              header('location:'.SITEURL.'admin/manage-restaurant.php');
        //stop the process
             die();
           }
           //B.remove current image if available
           if($Current_Image!="")
           {
             echo $remove_path="..\images\restaurant".$Current_Image;
             $remove=unlink( $remove_path);

             //check wther image is removed or not 
             //if failed to remove display msg and stop process
             if($remove==false)
             {
                 //failed to remove image
                 $_SESSION['failed-remove'] = "<div class='error'>failed to remove current image</div>";
                 header('location:'.SITEURL.'admin/manage-restaurant.php');
                 //stop the process
                 die();

             }

           }
           

        }
        else {
            $image=$Current_Image;
          }


    }
    
        else {
            $image=$Current_Image;
          }
  
    //3.remove the image if new  image uploaded and current image exist
    //4.update the restaurant in database
    $sql3=" UPDATE `restaurant` SET `Title`='$Title',`Description`='$Description',`Price`='$Price',`image`='$image',`location_id`='$location',`Featured`='$Featured',`Active`='$Active' WHERE Id=$Id"; 
     //execute the query
     $res3=mysqli_query($conn,$sql3);

    //redirect to manage restaurant with session msg

          //check whether query executed or not
          if($res3==true)
          {
              //location updated
              $_SESSION['update1']= "<div class='success'>restaurant updated successfully.</div>";
              header("location:".SITEURL.'admin/manage-restaurant.php');
          }
          else {
              //failed to update location
              $_SESSION['update']= "<div class='error'>failed to updated restaurant</div>";
              header("location:".SITEURL.'admin/manage-restaurant.php');
          }
}




?>
</div>
</div>
<?php include('partials/footer.php'); ?>