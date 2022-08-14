

<?php include('partials/navbar.php');?>

<div class="main-content">
    <div class="wrapper">
    <h1>Add Table</h1>
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
                <td>Table No:</td>
                <td>
                    <input type="text" name="table_no" placeholder="Table No">
                </td>
            </tr>
            <tr>
                <td>No Of Seats:</td>
                <td>
                    <input type="number" name="no_of_seats">
                </td>
            </tr>
            
            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>

            <tr>
                <td>Size:</td>
                <td>
                <input type="number" name="size" placeholder="Ex:Small,Large,Medium">
                </td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                

            <tr>
                
                <td colspan="2" >
                    <input type="submit" name="submit" value="Add table" class="btn-secondary">
                  
                </td>
            </tr>

        </table>



    </form>

    <?php
        //check whether submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //add the table in database
	        
            //1.get the data from form
            $table_no = $_POST['table_no'];
            $no_of_seats = $_POST['no_of_seats'];
            $price = $_POST['price'];
           
            $size = $_POST['size'];
           //for radio input,we need to check whether button is selected or not
           
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
               //Get the extension of our image(jpg,png,gif,etc)e.g "table1.jpg
               $ext=end(explode('.',$image));

                   //rename the image
                   $image="table_NAME_".rand(000,1000).'.'.$ext;//e,g table_NAME_834.jpg

                   $source_path=$_FILES['image']['tmp_name'];

                   $destination_path="../images/tables/".$image;

                   //finally upload the image 
                   $upload=move_uploaded_file($source_path,$destination_path);

                   //check whether the image is uploaded or not
                   //And if the image is not uploaded then we will stop the process and redirect with error mmessage
                   if($upload==false)
                   {
                       //set message
                       $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                       //redirect ti add-size page
                       header("size:".SITEURL.'admin/add-table.php');
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
            $sql2="INSERT INTO `table` SET
                    table_no='$table_no',
                    no_of_seats='$no_of_seats',
                    price=$price,
                    size=$size,
                    image='$image',
                    ";
                    //execute the query and save into database
                    $res2=mysqli_query($conn,$sql2);

                    //check whether the query executed or not and data added or not
                    if($res2==true)
                    {
                        //query executed and size added
                        $_SESSION['add'] = "<div class='success'>table added successfully.</div>";
                        //Redirecting page manage admin
                        header("size:".SITEURL.'admin/manage-table.php');
                    }
                    else
                    {
                        //failed to add size
                        $_SESSION['add'] = "<div class='error'>Failed to add table/Hotel.</div>";
                        //Redirecting page manage admin
                        header("size:".SITEURL.'admin/add-table.php');
                    }
            //4.redirect with message to manage table page





        }
    ?>

    </div>
</div>




<?php include('partials/footer.php');?>