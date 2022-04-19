<?php
ob_start();
include("partials/menu.php");
?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
            <br/>
            <br/>
            <?php
            //CHeck whether the id is set or not
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
                //echo"geting id";
            }else{
                //redirect to manage food
                header("location:manage-food.php");
            }


            $sql2="SELECT * FROM tbl_food WHERE id=$id";
            $res2=mysqli_query($conn,$sql2);
            //count the rows whether the id is valid or not
            //count the rows whether the id is valid or not
            If($res2==TRUE){
                $count= mysqli_num_rows($res2);

                if($count==1)
                {

                    //get all the data
                    $row2= mysqli_fetch_assoc($res2);
                    $title=$row2['title'];
                    $description=$row2['description'];
                    $price=$row2['price'];
                    $current_image=$row2['image_name'];
                    $current_category=$row2['category_id'];
                    $featured=$row2['featured'];
                    $active=$row2['active'];

                }else{
                    //redirect and session message
                    $_SESSION['no-food-found']="<div class='error'>Food not found</div>";
                    header("location:manage-food.php");
                }
            }

            ?>
            <br/>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" value="<?=$title;?>"></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td>
                        <textarea name="description" cols="30" rows="5"><?=$description;?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td><input type="number" name="price" value="<?=$price;?>"></td>
                    </tr>
                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php

                            if($current_image!="")
                            {
                                //display the Image
                                ?>
                                <img src="../images/food/<?=$current_image;?>" width="150px">
                                <?php
                            }
                            else{
                                //dispaly error message
                                echo"<div class='error'>IMAGE NOT ADDED</div>";
                            }

                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Select New Image:</td>
                        <td><input type="file" name="image" value=""></td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category">

                                <?php
                                $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn,$sql);

                                //Count the rows to check whether we have categories or not
                                $count= mysqli_num_rows($res);
                                //If count is greater than zero ,we have categpries else we dont have categories
                                if($count>0)
                                {
                                    //we have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $category_id=$row['id'];
                                        $category_title=$row['title'];
                                        ?>
                                        //Display on dropdown
                                        <option<?php if($current_category==$category_id){echo"selected";}?>
                                        value="<?=$category_id;
                                        ?>"><?=$category_title;?></option>

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
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured"  value="Yes">Yes

                            <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active"
                                                                            value="Yes">Yes

                            <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?=$current_image;?>">
                            <input type="hidden" name="id" value="<?=$id;?>">
                            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
<?php
if (isset($_POST['submit'])) {
    //echo "clicked";
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    //var_dump($_POST);
    //die();
    // 2. Updating New image if selected
    //Check whether the image is selected or not
    if (isset($_FILES['image']['name'])) {
        //Get the image details

        $image_name = $_FILES['image']['name'];

        //Check Whether the file is available or not

        if ($image_name!="")
        {
            //image available
            //Rename the image
            $parts = explode('.', $image_name);
            $ext = end($parts);
            //$ext=end(explode('.',$image_name));
            $image_name="Food_Name_".rand(0000,9999).'.'.$ext;

            //Get the source and destination path

            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/food/".$image_name;

            $upload=move_uploaded_file($source_path,$destination_path);

            if($upload==false)
            {
                //Failed to upload
                $_SESSION['upload']="<div class='error'>Failed to upload new image</div>";
                header("location:manage-food.php");
                die();
            }
            if ($current_image!="")
            {
                $remove_path="../images/food/".$current_image;
                $remove = unlink($remove_path);

                //check whether the image is removed ot not
                //if failed to remove then display message and stop the process

                if ($remove==false)
                {
                    //failed to remove the image
                    $_SESSION['failed-remove']="<div class='error'>Failed to remove current image</div>";
                    //redirect to add category
                    header("location:manage-food.php");
                    die();//stop the process
                }
            }


        }else
        {
            $image_name = $current_image;
        }

    }else{
        $image_name = $current_image;
    }




    //SQL QUERY
    $sql3="UPDATE tbl_food SET 
              title='$title',
              description='$description',
              price=$price,
              image_name='$image_name',
              category_id=$category,
              featured='$featured',
              active='$active'
              WHERE id=$id
              ";
    $res3=mysqli_query($conn,$sql3);

    if($res3==true)
    {
        $_SESSION['update']="<div class='success'>Food updated successfully.</div>";
        header("location:manage-food.php");
    }else{
        $_SESSION['update']="<div class='error'>Failed to  update food.</div>";
        header("location:manage-food.php");
    }



}
?>
        </div>
    </div>
<?php include("partials/footer.php");?>