<?php include("partials/menu.php");?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br/>
        <br/>
<?php
if(isset($_GET['id']))
{
    $id=$_GET['id'];
}

?>
        <form action="" method="post">
          <table class="tbl-30">
              <tr>
                  <td>Current Password: </td>
                  <td><input type="password" name="current_password" placeholder="current password"></td>
              </tr>
              <tr>
                  <td>New Password:</td>
                  <td><input type="password" name="new_password" placeholder="New password"></td>
              </tr>
              <tr>
                  <td>Confirm Password:</td>
                  <td><input type="password" name="confirm_password" placeholder="Confirm password"></td>
              </tr>
              <tr>
                  <td colspan="2">
                      <input type="hidden" name="id" value="<?=$id;?>">
                      <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                  </td>
              </tr>
          </table>
        </form>
    </div>
</div>
<?php
//check whether the submit button is checked or not
if(isset($_POST['submit'])) {
//button clicked
    //echo "Button Clicked";

//1.get data from form
    $id=$_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
//var_dump($_POST);
// die();

//2.sql query to save the data from database
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

//execute the query
    $res = mysqli_query($conn, $sql);
    // Check whether the query is executed or not
    if ($res==TRUE) {
        //Check whether the data is available or not
        $count = mysqli_num_rows($res);
        if ($count==1) {
            //get the details
            //USER EXISTS AND PASSWORD CAN BE CHANGED
            //echo "User found";

            if($new_password == $confirm_password)
            {
  //echo"password matched";
                $sql2="UPDATE tbl_admin SET
                       password='$new_password'
                       WHERE id=$id";

                $res=mysqli_query($conn, $sql2);
                if($res==TRUE)
                {
                    $_SESSION['change-password'] = "<div class='success'>Password Changed Successfully.</div>";
                    header("location: manage-admin.php");
                }
                else{
                    $_SESSION['change-password'] = "<div class='error'>Failed to change Password.</div>";
                    header("location: manage-admin.php");
                }
            }else{
                $_SESSION['password-not-match'] = "<div class='error'>Password did not matched.</div>";
                header("location: manage-admin.php");
            }
        } else {
            //USER does not exists Set Message and Redirect
            $_SESSION['user-not-found'] = "<div class='error'>User not found.</div>";
            header("location: manage-admin.php");
        }

    }
}
?>
<?php include("partials/footer.php");?>
