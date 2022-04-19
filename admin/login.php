<?php include('../config/constants.php');?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN - food order system</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="login">
    <h1 class="text-center">Login</h1><br><br>

    <?php
   if(isset($_SESSION['login']))
   {
       echo $_SESSION['login'];
       unset($_SESSION['login']);

   }
    if(isset($_SESSION['no-login-message']))
    {
        echo $_SESSION['no-login-message'];
        unset($_SESSION['no-login-message']);

    }
    ?>
    <br><br>
<!--Login form Starts here-->
    <form action="" method="post" class="text-center">
        Username:<br><br>
        <input type="text" name="username" placeholder="Enter your username" required><br><br>
        Password:<br><br>
        <input type="password" name="password" placeholder="Enter your password" required><br><br>

        <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
    </form>

<!--Login form ends here-->


    <p class="text-center"> Created by -<a href="#"> Farija</a></p>
</div>
</body>
</html>
<?php

if(isset($_POST['submit']))
{
    $username=$_POST['username'];
    $password=md5($_POST['password']);
   //var_dump($_POST);


    //sql to check user with username  and password is exists or not

    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    $res=mysqli_query($conn,$sql);

    //Count rows to check whether te user exists or not
    $count=mysqli_num_rows($res);

    if($count==1)
    {
        //user available and login success
        $_SESSION['login'] = "<div class='success'>Login Successful</div>";
        $_SESSION['user'] =$username;// Check whether the user is logged in or not and logout with unset it


            header("location:index.php");
    }else
    {
        //user not available
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match</div>";
            header("location:login.php");
    }
}


?>