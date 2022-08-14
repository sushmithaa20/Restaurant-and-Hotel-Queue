<?php
    //include constants file
    include('../config.php');
    //echo "delete page";
    //check whether the id and image value is set or not
    if(isset($_GET['id']) AND isset($_GET['image']))
    {
        //get the value and delete
        //echo "get value and delete";
        $id=$_GET['id'];
        $image=$_GET['image'];
        //remove the physical image file is available
        if($image!="")
        {
            //image is available.so remove it
            $path="../images/location/".$image;
            //remove the name
            $remove=unlink($path);
            //if failed to remove image then add error message and stop the process
            if($remove==false)
            {
                //set the session message
                $_SESSION['remove']="<div class='error'>Failed to Remove location image.</div>";
                //redirect to manage location page
                header("location:".SITEURL.'admin/manage-location.php');
                //stop the process
                die();
            }
        }
        //delete data from database
        //sql query to delete data from database
        $sql="DELETE FROM `location` WHERE id=$id";

        //execute the query
        $res=mysqli_query($conn,$sql);

        //check whether the data is deleted from database or not
        if($res==true)
        {
            //set success message and redirect
            $_SESSION['delete']="<div class='success'>location Deleted Successfully.</div>";
            //redirect to manage location
            header("location:".SITEURL.'admin/manage-location.php');
        }
        else
        {
            //set fail message and redirect
            $_SESSION['delete']="<div class='error'>Failed to Delete location.</div>";
            //redirect to manage location
            header("location:".SITEURL.'admin/manage-location.php');
        }
        //redirect to manage location page with message
    }
    else
    {
        //redirect to manage location page
        header("location:".SITEURL.'admin/manage-location.php');
    }


?>