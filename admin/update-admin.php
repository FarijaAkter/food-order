<?php include("partials/menu.php");?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br/>
            <br/>
<?php
//1. get the id
$id=$_GET['id'];

//2. create SQL Query

$sql="SELECT * FROM tbl_admin WHERE id=$id";
// 3. Execute the query

$res=mysqli_query($conn, $sql);
// Check whether the query is executed or not
if($res==TRUE)
{
    //Check whether the data is available or not
    $count=mysqli_num_rows($res);
    if($count==1)
    {
       //get the details
        //echo "admin available";
        $row=mysqli_fetch_assoc($res);

        $full_name=$row['fullname'];
        $username=$row['username'];
    }
    else{
        //we will Redirect to admin page
        header("location: manage-admin.php");
    }
}
?>
            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="fullname" value="<?=$full_name;?>"></td>

                    </tr>
                    <tr>
                        <td>User Name:</td>
                        <td><input type="text" name="username" value="<?=$username;?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?=$id;?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
<?php
//Check whether the submit button  is clicked or not
if(isset($_POST['submit']))
{
    //echo"button clicked";
    //get all the vales from form
    $id=$_POST['id'];
    $full_name=$_POST['fullname'];
    $username=$_POST['username'];
    //var_dump($_POST);
//Sql query to update

    $sql2="UPDATE tbl_admin SET 
          fullname='$full_name',
          username='$username'
          WHERE id=$id;
     ";

    //execute the query
    $res2=mysqli_query($conn,$sql2);

    //check whether  the query executed successfully or not
    if($res2==TRUE){
        //data inserted
        //Create a session to display Message

        $_SESSION['update']="<div class='success'>Admin Updated Successfully</div>";

        //Redirect page to manage admin
        header("location:manage-admin.php");
    }
    else{
        //failed to insert data
        //echo "Failed to insert data";
        $_SESSION['update']="<div class='error'>Failed to Update Admin , Try Again</div>";

        //Redirect page to manage admin
        header("location:update-admin.php");
    }
}
?>
<?php include("partials/footer.php");?>

