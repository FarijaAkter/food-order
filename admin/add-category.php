<?php include("partials/menu.php");?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br/>
        <br/>

        <?php
        if (isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>
        <br/>
        <br/>
        <!--ADD CATEGORY FORM STARTS-->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder=" Category title" ></td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td><input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No</td>

                </tr>
                <tr>
                    <td>Active:</td>
                    <td><input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!--ADD CATEGORY FORM ENDS-->
    </div>
</div>
<?php
//Check whether the submit button is clicked or not
if (isset($_POST['submit'])){
    //echo "button clicked";

    //Get the value from form\
    $title=$_POST['title'];
    //for radio input type we need to check whether the button is selected or not

    if (isset($_POST['featured'])){
        //get the vale from form
        $featured=$_POST['featured'];
    }else{
        $featured= "No";
    }

    if (isset($_POST['active'])){
        $active=$_POST['active'];
    }else{
        $active="No";
    }

    //check whether the  image is selected or not and set the value for image name accordingly

    //print_r($_FILES['image']);
    if (isset($_FILES['image']['name']))
    {
    //upload the image
    //to upload image we need image name,source path and direction path

        $image_name=$_FILES['image']['name'];

        //UPLOAD IMAGE only if image is selected

        if( $image_name!= ""){


            //Auto Rename image
            //Get extension of our image(jpg,png,gif etc) e.g. "food1.jpg"
            $ext=end(explode('.',$image_name));

            //rename the image
            $image_name="Food_Category_".rand(000,999).'.'.$ext;//e.g. Food_Category_834.jpg
            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/category/".$image_name;


            //finally upload the image
            $upload=move_uploaded_file($source_path,$destination_path);

            //check whether the image uploaded or not
            //and if image is not uploaded then we will
            if ($upload==false)
            {
            //set message
                $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                //redirect to add category
                header("location:add-category.php");
                //stop the process
                die();
            }
        }
    }else{
            //don't upload and set the image_name value as blank

        $image_name="";
    }
    //die();
//var_dump($_POST);
    //die();
    //2.create sql
    $sql="INSERT INTO tbl_category SET 
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";

    $res= mysqli_query($conn, $sql)  or die(mysqli_error($conn));


    if($res==TRUE){
        echo " Data inserted";
        $_SESSION['add']="<div class='success'>Category added Successfully</div>";
        header("location:manage-category.php");
    }else{
        $_SESSION['add']="<div class='error'>Failed to add Category</div>";
        header("location:manage-category.php");
    }
}

?>
<?php include("partials/footer.php");?>