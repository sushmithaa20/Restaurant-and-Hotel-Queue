<?php
include('partials/navbar.php');

?>

<?php
    //include constants.php for SITEURL
    include('../config');
    //1.destroy the session
    session_destroy();//unsets $_SESSION['user']

    //2.redirect to login page
    header("location:index.php");
    echo "<script>alert('User Logout Succesfuly.')</script>";
        

?>