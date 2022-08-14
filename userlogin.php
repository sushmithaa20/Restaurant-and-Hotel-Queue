<?php
include ('config.php');

?>

<div class="navbar">
            <!-- <div class="logo">
                <a href="#" title="Logo">
                    <img src="a1.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div> -->

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="admin/index.php">ADMIN</a>
                    </li>
                    <li>
                        <a href="index.php">HOME</a>
                    </li>
                   
                    <li>
                        <a href="userlogout.php">LOGOUT</a>
                    </li>
                    <li>
                        <a href="#contact">CONTACT</a>
                    </li>
                </ul>
            </div>
			<div>
	
	<h1 style="color:white;margin-top: 10%;size: 500px;margin-left: 5%;">Hotel And Restaurant
															<br>
														<span >Queue
														<h3 style="color:#ff6b81; margin: top 0;">Find Your destination</h3>
														</span></h1>
														<style>
															navbar spam{

															}
														</style>
														
	
</div>

            <div class="clearfix"></div>
        </div>

<?php 

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	echo $password = md5($_POST['password']);

	$sql = "SELECT * FROM `user` WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		$_SESSION['user'] = $email;
		header("Location: index.php");
	} 
    else {
		// header("Location: index.php");
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
			<a  style="color:black"href="userregister.php">New User? Register Here.</a>
		</form>
	</div>


<?php
include('partials/footer.php');
?>
       




	   <style>

/* login section */
body{
    
    background: #000116;
  }
.container {
    margin-left: 65%;
    margin-right: 100px;
	margin-top: -241px;
    margin-bottom: 100px;
    width: 328px;
    min-height: 400px;
    background: #FFF;
    border-radius: 20px;
    box-shadow: 0 0 5px rgba(0,0,0,.3);
    padding: 40px 30px;
}

.container .login-text {
    color: #111;
    font-weight: 500;
    font-size: 1.1rem;
    text-align: center;
    margin-bottom: 20px;
    display: block;
    text-transform: capitalize;
}

.container .login-social {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(50%, 1fr));
    margin-bottom: 25px;
}

.container .login-social a {
    padding: 12px;
    margin: 10px;
    border-radius: 3px;
    box-shadow: 0 0 5px rgba(0,0,0,.3);
    text-decoration: none;
    font-size: 1rem;
    text-align: center;
    color: #FFF;
    transition: .3s;
}

.container .login-social a i {
    margin-right: 5px;
}

.container .login-social a.facebook {
    background: #4267B2;
}

.container .login-social a.twitter {
    background: #1DA1F2;
}

.container .login-social a.google-plus {
    background: #db4a39;
}

.container .login-social a.linkedin {
    background: #0e76a8;
}

.container .login-social a.facebook:hover {
    background: #3d5fa3;
}

.container .login-social a.twitter:hover {
    background: #1991db;
}

.container .login-social a.google-plus:hover {
    background: #ca4334;
}

.container .login-social a.linkedin:hover {
    background: #0b5c81;
}

.container .login-email .input-group {
    width: 100%;
    height: 50px;
    margin-bottom: 25px;
}

.container .login-email .input-group input {
    width: 100%;
    height: 100%;
    border: 2px solid #e7e7e7;
    padding: 15px 20px;
    font-size: 1rem;
    border-radius: 30px;
    background: transparent;
    outline: none;
    transition: .3s;
}

.container .login-email .input-group input:focus, .container .login-email .input-group input:valid {
    border-color: #a29bfe;
}

.container .login-email .input-group .btn {
    display: block;
    width: 100%;
    padding: 15px 20px;
    text-align: center;
    border: none;
    background: #a29bfe;
    outline: none;
    border-radius: 30px;
    font-size: 1.2rem;
    color: #FFF;
    cursor: pointer;
    transition: .3s;
}

.container .login-email .input-group .btn:hover {
    transform: translateY(-5px);
    background: #6c5ce7;
}

.login-register-text {
    color: #111;
    font-weight: 600;
}

.login-register-text a {
    text-decoration: none;
    color: #6c5ce7;
}

@media (max-width: 430px) {
    .container {
        width: 300px;
    }
    .container .login-social {
        display: block;
    }
    .container .login-social a {
        display: block;
    }
}

  
  /* login section ends  */






  /* footer section */
textarea {
    resize: none;
  }
  
  .text {
    color: white;
    font-size: 20px;
    position: absolute;
    border: solid;
    margin-top: 100px;
    margin-left: 10px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    white-space: nowrap;
  }
  
  
  
  .svg-inline--fa {
  vertical-align: -0.200em;
  }
  
  .rounded-social-buttons {
  text-align: center;
  background-color: rgb(207, 155, 124);
  }
  
  .rounded-social-buttons .social-button {
  display: inline-block;
  position: relative;
  cursor: pointer;
  width: 3.125rem;
  height: 50px;
  border: 0.125rem solid transparent;
  padding: 0;
  text-decoration: none;
  text-align: center;
  color: #fefefe;
  font-size: 1.5625rem;
  font-weight: normal;
  line-height: 2em;
  border-radius: 1.6875rem;
  transition: all 0.5s ease;
  margin-right: 0.25rem;
  margin-bottom: 0.25rem;
  margin-top: 10px;
  
  
  }
  
  .rounded-social-buttons .social-button:hover, .rounded-social-buttons .social-button:focus {
  -webkit-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
          transform: rotate(360deg);
  }
  
  .rounded-social-buttons .fa-twitter, .fa-facebook-f, .fa-linkedin, .fa-youtube, .fa-instagram {
  font-size: 25px;
  }
  
  .rounded-social-buttons .social-button.facebook {
  background: #3b5998;
  }
  
  .rounded-social-buttons .social-button.facebook:hover, .rounded-social-buttons .social-button.facebook:focus {
  color: #3b5998;
  background: #fefefe;
  border-color: #3b5998;
  }
  
  .rounded-social-buttons .social-button.twitter {
  background: #55acee;
  }
  
  .rounded-social-buttons .social-button.twitter:hover, .rounded-social-buttons .social-button.twitter:focus {
  color: #55acee;
  background: #fefefe;
  border-color: #55acee;
  }
  
  .rounded-social-buttons .social-button.linkedin {
  background: #007bb5;
  }
  
  .rounded-social-buttons .social-button.linkedin:hover, .rounded-social-buttons .social-button.linkedin:focus {
  color: #007bb5;
  background: #fefefe;
  border-color: #007bb5;
  }
  
  .rounded-social-buttons .social-button.youtube {
  background: #bb0000;
  }
  
  .rounded-social-buttons .social-button.youtube:hover, .rounded-social-buttons .social-button.youtube:focus {
  color: #bb0000;
  background: #fefefe;
  border-color: #bb0000;
  }
  
  .rounded-social-buttons .social-button.instagram {
  background: #125688;
  }
  
  .rounded-social-buttons .social-button.instagram:hover, .rounded-social-buttons .social-button.instagram:focus {
  color: #125688;
  background: #fefefe;
  border-color: #125688;
  }
  h3:hover{
  color:rgb(218, 89, 15);
  }
  
  /* footer section close */








  body{
    
    background: #000116;
  }
.navbar{
    width: 100%;
    margin: 0 auto;
    padding: 1%;
}
.img-responsive{
    width: 100%;
}
.img-curve{
    border-radius: 19px;
}

.text-right{
    text-align: left;
}
.text-center{
    text-align: center;
}
.text-left{
    text-align: left;
}
.text-white{
    color: white;
}

.clearfix{
    clear: both;
    float: none;
}

a{
    color: #ff6b81;
    text-decoration: none;
}
a:hover{
    color: #ff4757;
}

.btn{
    padding: 1%;
    border: none;
    font-size: 1rem;
    border-radius: 5px;
}
.btn-primary{
    background-color: #ff6b81;
    color: white;
    cursor: pointer;
}
.btn-primary:hover{
    color: white;
    background-color: #ff4757;
}
h2{
    color: #2f3542;
    font-size: 2rem;
    margin-bottom: 2%;
}
h3{
    font-size: 1.5rem;
}
.float-navbar{
    position: relative;
}
.float-text{
    position: absolute;
    bottom: 50px;
    left: 40%;
}
fieldset{
    border: 1px solid white;
    margin: 5%;
    padding: 3%;
    border-radius: 5px;
}


/* CSSS for navbar section */

.logo{
    width: 10%;
    float: left;
}
.menu{
    line-height: 60px;
}
.menu ul{
    list-style-type: none;
}

.menu ul li{
    display: inline;
    padding: 1%;
    font-weight: bold;
}


/* CSS for restaurant SEarch Section */

.restaurant-search{
    margin-left: 30%;
    margin-right: 30%;
    margin-top:0;
    background-image: url(../images/a1.jpeg);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    padding: 7% 0;
}

.restaurant-search {
    margin-left: auto;
    margin-right: auto;
    height: 150px;
    margin-top: 0;
    background-image: url(../images/a1.jpeg);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    padding: 8% 0;
}



</style>