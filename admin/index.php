<?php
include('partials/navbar.php');

?>

<?php 

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: manage-location.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM `admin` WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		$_SESSION['user'] = $email;
		header("Location: manage-location.php");
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}



// if(isset($_SESSION['no-login-message']))
// {
// 	echo $_SESSION['no-login-message'];
// 	unset($_SESSION['no-login-message']);
// }
?>

<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
			
		</form>
	</div>


<?php
include('partials/footer.php');
?>
       