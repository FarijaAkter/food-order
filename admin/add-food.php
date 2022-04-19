<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br/>
        <br/>

        <?php
        if (isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder=" Title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder=" Add Some Description
               "></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php
                            //Create PHP Code to display categories from database
                            // 1. Create SQL to get all active categories from database
                            $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn,$sql);

                            //Count the rows to check whether we have categories or not
                            $count= mysqli_num_rows($res);

                            //If count is greater than zero ,we have categpries else we dont have categories
                            if($count>0)
                            {
                                //we have categpries
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the details of categories
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    ?>
                                    //Display on dropdown
                                    <option value="<?=$id;?>"><?=$title;?></option>

                                    <?php
                                }

                            }
                            else
                            {
                                //we dont have categories
                                ?>
                                <option value="0">No Categories Found</option>
                                <?php
                            }
                            ?>
                            <!--<option value="1">Food</option>
                            <option value="2">Snacks</option>-->
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
<?php
if(isset($_POST['submit']))
{
    //echo"clicked";

    // 1. Get the data from form
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category=$_POST['category'];

    if(isset($_POST['featured']))
    {
        $featured=$_POST['featured'];
    }else
    {
        $featured="No";
    }
    if(isset($_POST['active']))
    {
        $active=$_POST['active'];
    }else
    {
        $active="No";
    }
    // 2. Upload The Image if selected
//Check Whether the select Image is clicked or not and upload the image only if the image is selected

    if (isset($_FILES['image']['name']))
    {
      //Get the details of the selected Image
        $image_name=$_FILES['image']['name'];

        //Check whether the image is selected or not and Upload image only if selected
        if ($image_name!="")
        {
            // Image is selected
            // A. Rename the image
            // GEt the extention of the selected image ( jpg,png,gif etc) FOOD_ADD_6754.jpg
            $ext=end(explode('.',$image_name));

            // Create New Name for Image

            $image_name="Food_Name_".rand(0000,9999).".".$ext;

            // B. Upload the Image
            //Get the src path and destination path
            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/food/".$image_name;
     //Finally upload the FOOD Image
            $upload=move_uploaded_file($source_path,$destination_path);

            //Check whether Image uploaded or not

            if ($upload==false)
            {
                //Failed to upload Image
                //Redirect to add Food Page with Error message
                $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                //redirect to add category
                header("location:add-food.php");
                //stop the process
                die();
            }
        }


    }else{
        $image_name="";//Setting the default value as Blank
    }

    // 3. Insert Into Database

    //For Numerical Value ,we do not need to pass value inside quotes '',But for string value it is compulsory to addquotes ''
      $sql2="INSERT INTO tbl_food SET 
             title='$title',
             description='$description',
             price=$price,
             image_name='$image_name',
             category_id=$category,
             featured='$featured',
             active='$active'
             ";
    //4. Redirect with Message to Manage Food page
    $res2= mysqli_query($conn, $sql2);


    if($res2==TRUE){
        echo " Data inserted";
        $_SESSION['add']="<div class='success'>Food added Successfully</div>";
        header("location:manage-food.php");
    }else{
        $_SESSION['add']="<div class='error'>Failed to add Food</div>";
        header("location:manage-food.php");
    }

}
?>

    </div>
</div>


<?php include('partials/footer.php');?>