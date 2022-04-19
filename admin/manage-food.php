<?php include("partials/menu.php");?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>
            <br/>
            <br/>
            <br/>

            <?php
            if (isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if (isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if (isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if (isset($_SESSION['unauthorize']))
            {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }
            if (isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if (isset($_SESSION['no-food-found']))
            {
                echo $_SESSION['no-food-found'];
                unset($_SESSION['no-food-found']);
            }
            if (isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if (isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }

            ?>
            <br/><br/>
            <!--Button to add admin-->


            <a href="add-food.php" class="btn-primary">Add Food</a>
            <br/><br/>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                <?php
                //Create sql to get all the food
                $sql="SELECT * FROM tbl_food";
                $res = mysqli_query($conn,$sql);

                //Count the rows to check whether we have foods or not

                $count = mysqli_num_rows($res);

                $sn=1;
                if ($count>0)
                {
                    //we have food in database
                    //get the foods from database and display
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];
                        ?>
                        <tr>
                            <td><?=$sn++;?></td>
                            <td><?=$title;?></td>
                            <td>$<?=$price;?></td>
                            <td>
                                <?php
                                if ($image_name=="")
                                {
                                    //we do not have image,display error message
                                   echo "<div class='error'>Image not added</div>";

                                }else{
                               ?>
                                  <img src="../images/food/<?=$image_name;?>" width="100px">

                                    <?php
                                }


                                ?>
                            </td>
                            <td><?=$featured;?></td>
                            <td><?=$active;?></td>
                            <td>
                                <a href="update-food.php?id=<?=$id;?>" class="btn-secondary">Update Food</a>
                                <a href="delete-food.php?id=<?=$id;?>&image_name=<?=$image_name;?>" class="btn-danger">Delete
                                    Food</a>
                            </td>
                        </tr>

                        <?php
                    }

                }else{
                    //Food not added in Database
                    echo"<tr><td colspan='7' class='error'>Food not added yet.</td></tr>";
                }

                ?>


            </table>
        </div>
    </div>
        </div>
    </div>

<?php include("partials/footer.php");?>