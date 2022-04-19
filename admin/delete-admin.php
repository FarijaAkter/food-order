<?php
include('../config/constants.php');
//1.Get the id of the admin to be deleted
 $id= $_GET['id'];

//2.Create sql Query to delete Admin
$sql="DELETE FROM tbl_admin WHERE id=$id";

//Execute the query
$res=mysqli_query($conn, $sql);
//Check whether the query executed successfully or not
if($res==TRUE)
{
    //echo "Admin deleted successfully";
    //Create session variable to show message
    $_SESSION['delete']="<div class='success'>Admin deleted successfully</div>";
    header("location: manage-admin.php");
}
else
{
    //echo "Failed to delete admin";
    $_SESSION['delete']="<div class='error'>Failed to delete.Try again Later..</div>";
    header("location: manage-admin.php");
}
//3.Redirect to Manage Admin page with message(sussess / error)

?>