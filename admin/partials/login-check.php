<?php
//Authorisation -Access Control
//Check whether the user logged in or not

if(!isset($_SESSION['user']))//if user session is nt set
{
  //User is not Logged in
    ////Redirect to login page with message
    $_SESSION['no-login-message']="<div class='error text-center'>Please login to Access Admin Panel. </div>";
    //redirect to login page
    header("location:login.php");
}
?>