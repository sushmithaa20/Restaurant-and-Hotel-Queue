<?php include('partials/navbar.php'); ?>
<div class="main-content">
    <div class="wrapper">
    <h1>Update reservation</h1>

    <br /><br />


    <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];

            $sql="SELECT *FROM reservation WHERE id=$id";

            $res=mysqli_query($conn,$sql);

            $count=mysqli_num_rows($res);

            if($count==1)
            {
                $row=mysqli_fetch_assoc($res);

                $food=$row['food'];
                $price=$row['price'];
                $no_of_tables=$row['no_of_tables'];
                $status=$row['status'];
                $customer_name=$row['customer_name'];
                $customer_contact=$row['customer_contact'];
                $customer_email=$row['customer_email'];
                
            }
            else {
                header('location:'.SITEURL.'admin/manage-reservation.php');
            }
        }
        else {
            header('location:'.SITEURL.'admin/manage-reservation.php');
        }
    
    
    ?>

    <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Food Name</td>
                <td><b><?php echo $food;?></b></td>
            </tr>

            <tr>
                <td>Price</td>
                <td><b><?php echo $price;?></b></td>
            </tr>

            <tr>
                <td>no_of_tables</td>
                <td>
                    <input type="number" name="no_of_tables" value="<?php echo $no_of_tables;?>">
                </td>
            </tr>

            <tr>
                <td>Status</td>
                <td>
                   <select name="status">
                       <option <?php if($status=="reservationed"){echo "Selected";}?> value="reservationed">reservationed</option>
                       <option <?php if($status=="On success"){echo "Selected";}?> value="On success">On success</option>
                       <option <?php if($status=="reserved"){echo "Selected";}?> value="reserved">reserved</option>
                       <option <?php if($status=="Cancelled"){echo "Selected";}?> value="Cancelled">Cancelled</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Customer Name</td>
                <td>
                    <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                </td>      
            </tr>

            <tr>
                <td>Customer Contact</td>
                <td>
                    <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                </td>      
            </tr>

            <tr>
                <td>Customer Email</td>
                <td>
                    <input type="text" name="customer_email" value="<?php echo $customer_email;?>">
                </td>      
            </tr>



            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="price" value="<?php echo $price;?>">
                    <input type="submit" name="submit" value="Update reservation" class="btn-secondary">
                </td>
            </tr>
</table>
</form>

<?php
    if(isset($_POST['submit']))
    {
        $id=$_POST['id'];
        $price=$_POST['price'];
        $total=$price *$no_of_tables;
        $status=$_POST['status'];
        $customer_name=$_POST['customer_name'];
        $customer_contact=$_POST['customer_contact'];
        $customer_email=$_POST['customer_email'];

        $sql2="UPDATE tbl_reservation SET
                no_of_tables=$no_of_tables,
                total=$total,
                status='$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email'
                WHERE id=$id";

        $res2=mysqli_query($conn,$sql2);

        if($res2==true)
        {
            $_SESSION['update']="<div class='success'>reservation Updated Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-reservation.php');
        }
        else {
            $_SESSION['update']="<div class='error'>Failed to Update reservation.</div>";
            header('location:'.SITEURL.'admin/manage-reservation.php');
        }

    }
    

?>
</div>
</div>

<?php include('partials/footer.php'); ?>