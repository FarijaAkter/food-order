<?php
include('../config/constants.php');
//delete all the session and redirect to login page
session_destroy();// UNSETS $_SESSION['user']

header("location:login.php");
?>