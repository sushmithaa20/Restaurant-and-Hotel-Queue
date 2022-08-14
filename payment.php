<?php 
include('config.php');


if(isset($_GET['reservation_id']))
{
    //get the restaurant id and details of selected restaurant
    $reservation_id=$_GET['reservation_id'];

    $sql="SELECT *FROM reservation WHERE id=$reservation_id";

    $res=mysqli_query($conn,$sql);

   

    $count=mysqli_num_rows($res);

    if($count==1)
    {
        $row=mysqli_fetch_assoc($res);
        $customer_email=$row['customer_email'];
        $total=$row['total'];
       
        
    }
    
}



    



?>

<?php 
if(isset($_SESSION['table']))//checking whether the ssion is set or not
{
    echo $_SESSION['table'];//displaying session message
    unset($_SESSION['table']);//removing session message
}
?>

<form action="#" method="POST">
<div class="container">
        <h1>Confirm Your Payment</h1>
        <h3> Total Amount: <?php echo $total; ?> </h3>
        <div class="first-row">
            <div class="owner">
                <h3>Owner</h3>
                <div class="input-field">
                    <input type="text">
                </div>
            </div>
            <div class="cvv">
                <h3>CVV</h3>
                <div class="input-field">
                    <input type="password" name="cvv">
                </div>
            </div>
        </div>
        <div class="second-row">
            <div class="card-number" >
                <h3>Card Number</h3>
                <div class="input-field">
                    <input type="text" name="card_no">
                </div>
            </div>
        </div>
        <div class="third-row">
            <h3>Exp-Date</h3>
            <div class="selection">
            <input type="date" name="exp_date">
                <!-- <div class="cards">
                    <img src="mc.png" alt="">
                    <img src="vi.png" alt="">
                    <img src="pp.png" alt="">
                </div> -->
            </div>    
        </div>
        <div class="input-group">
				<button name="submit" class="btn">Confirm</button>
			</div>
        <!-- <a href="">Confirm</a> -->
    </div>
</form>



<?php

if (isset($_POST['submit'])) {
	$rid = $reservation_id;
	$card_no = $_POST['card_no'];
	$exp_date = md5($_POST['exp_date']);
	$cvv = md5($_POST['cvv']);
    $price = $total;

    $sql = "INSERT INTO payment (rid, card_no, exp_date, cvv, price)
					VALUES ('$rid', '$price', '$card_no', '$exp_date', '$cvv')";
   
                        //echo $sql2;die();
			$result = mysqli_query($conn, $sql);


	
    if ($result) {
               
        echo "<script>alert('Payment is succesfull.')</script>";
        echo "<script>window.open('index.php','_self')</script>";
               
	} 
    else {
		echo "<script>alert('Payment was Failed.')</script>";
	}

}
// else{
//     echo "<script>alert('Something went wrong.')</script>";
// }


?>








	<style>

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body{
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #000116;
}

.container{
    width: 750px;
    height: 500px;
    border: 1px solid;
    background-color: white;
    display: flex;
    flex-direction: column;
    padding: 40px;
    justify-content:space-around;
}

.container h1{
    text-align: center;
}

.first-row{
     display: flex;
}

.owner{
    width: 100%;
    margin-right: 40px;
}

.input-field{
    border: 1px solid #999;
}

.input-field input{
    width: 100%;
    border:none;
    outline: none;
    padding: 10px;
}

.selection{
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.selection select{
    padding: 10px 20px;
}

.a{
    background-color:#000115;
    color: white;
    text-align: center;
    text-transform: uppercase;
    text-decoration: none;
    padding: 10px;
    font-size: 18px;
    transition: 0.5s;
}

.a:hover{
    background-color: dodgerblue;
}

.cards img{
    width: 100px;
}
</style>


