<?php include("partials/menu.php");?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/>
        <?php
        if(isset($_SESSION['add']))//Checking whether the session is set or not
        {
            echo $_SESSION['add'];//Displaying session message if set
            unset($_SESSION['add']);//Removing session message
        }
        ?>
        <form action="" method="post">

            <table class="tbl-30">

                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="fullname" placeholder="Enter your full name"></td>

                </tr>
                <tr>
                    <td>User Name:</td>
                    <td><input type="text" name="username" placeholder="Enter your user name"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>

                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>
<?php include("partials/footer.php");?>
<?php
//.peocess the value from form and save it to darabase

//.check whether the submit button is clicked or not

if(isset($_POST['submit'])) {
    //button clicked
    //echo "Button Clicked";

    //1.get data from form

    $full_name= $_POST['fullname'];
    $username= $_POST['username'];
    $password= md5($_POST['password']);
//var_dump($_POST);
// die();
    //2.sql query to save the data from database

    $sql="INSERT INTO tbl_admin SET
            fullname= '$full_name',
             username= '$username',
             password= '$password'         
 ";
   // echo $sql;
    //3.Execute  query and save data in database
    $res= mysqli_query($conn, $sql) or die(mysqli_error($conn));

    //4. check whether the (query is executed) data is inserted or not and display appropriate message
   if($res==TRUE){
      //data inserted
        //echo " Data inserted";
       //Create a session to display Message

       $_SESSION['add']="<div class='success'>Admin Added Successfully</div>";

       //Redirect page to manage admin
       header("location:manage-admin.php");
    }
    else{
        //failed to insert data
        //echo "Failed to insert data";
        $_SESSION['add']="<div class='error'>Failed to Add Admin,Try Again</div>";

        //Redirect page to manage admin
        header("location:add-admin.php");
    }

}

?>

