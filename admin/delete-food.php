<?php
include('../config/constants.php');

if (isset($_GET['id']) && isset($_GET['image_name']))
{
    //Process to delete
  // echo"Process to delete";

    // 1. Get Id and Image Name
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //2. Remove the Image if Available
    //Check Whether the image is available or not and Delete only if available
   if ($image_name!="")
   {
      //Get the Image path
       $path="../images/food/".$image_name;
       //Remove Image file form folder

       $remove= unlink($path);
       // IF failed to remove image then add an error message and stop the process
       if ($remove==false)
       {
           //set the session message
           $_SESSION['remove']="<div class='error'>Failed to remove food image</div>";
           // //redirect to manage category page
           header("location: manage-food.php");
           // // stop the process
           die();
       }
   }

    // 3. Delete food from database
    $sql="DELETE FROM tbl_food WHERE id=$id";

    $res=mysqli_query($conn,$sql);
    //check whether the data is deleted from database or not
    //4. Redirect to manage foor with message
    if($res==true)
    {
        //set success message and re direct
        $_SESSION['delete']="<div class='success'>Food Deleted successfully</div>";
        header("location:manage-food.php");
    }else{
        //set error message and re direct
        $_SESSION['delete']="<div class='error'>Failed to delete Food</div>";
        header("location:manage-food.php");
    }


}else{
   //Redirect to manage food page
   // echo"redirect";
    $_SESSION['unauthorize']="<div class='error'>UnAuthorised access</div>";
    header("location: manage-food.php");
}

?>