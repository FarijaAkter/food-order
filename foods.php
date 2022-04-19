<?php include('front-partials/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            $sql2="SELECT * FROM tbl_food WHERE active='Yes'";
            $res2= mysqli_query($conn,$sql2);

            $count2=mysqli_num_rows($res2);

            if($count2>0)
            {
                while($row=mysqli_fetch_assoc($res2))
                {
                    $id=$row['id'];
                    $title=$row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            //Check whether Image available or not
                            if($image_name=="")
                            {
                                //Display message
                                echo "<div class='error'>Image not available</div>";
                            }else
                            {
                                ?>
                                <img src="images/food/<?=$image_name;?>" alt="Chicken Hawain Pizza"
                                     class="img-responsive img-curve">
                                <?php
                            }

                            ?>
                        </div>
                        <div class="food-menu-desc">
                            <h4><?=$title;?></h4>
                            <p class="food-price">$<?=$price;?></p>
                            <p class="food-detail">
                                <?=$description;?>
                            </p>
                            <br>

                            <a href="order.php" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                            <?php
                        }
                    }else{
                        //food not available
                        echo"<div class='error'>Food are not Found.</div>";
                    }

               ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->
<?php include('front-partials/footer.php');?>