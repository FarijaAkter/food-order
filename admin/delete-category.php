<?php
//include constants file

include('../config/constants.php');
 //echo "delete page";
//check whether id and inage_name value is set or not

if (isset($_GET['id']) AND isset($_GET['image_name']))
{
    //get the vale and delete
        //echo "get value";
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //Remove the physical image file is available
    if ($image_name!="")
    {
        //  Image is available . so remove it.
        $path = "../images/category/".$image_name;
        //Remove the Image
        $remove= unlink($path);
        // IF failed to remove image then add an error message and stop the process
        if ($remove==false)
        {
          //set the session message
            $_SESSION['remove']="<div class='error'>Failed to remove category image</div>";
            // //redirect to manage category page
            header("location: manage-category.php");
            // // stop the process
            die();
        }
    }
    // Delete Data from DATABASE
     $sql="DELETE FROM tbl_category WHERE id=$id";

    $res=mysqli_query($conn,$sql);

    //check whether the data is deleted from database or not
    if($res==true)
    {
       //set success message and re direct
        $_SESSION['delete']="<div class='success'>Category Deleted successfully</div>";
        header("location:manage-category.php");
    }else{
      //set error message and re direct
        $_SESSION['delete']="<div class='error'>Failed to delete Category</div>";
        header("location:manage-category.php");
    }

    //Redirect to Manage Category page wih massage
}else{
    //redirect to manage category page
    header("location: manage-category.php");
}
?>