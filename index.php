<?php include('front-partials/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center" xmlns="http://www.w3.org/1999/html">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            //Create sql query to display Categories from Database
            $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //execute the query
            $res=mysqli_query($conn,$sql);
            //Count rows  to check whether the category is available or not
            $count=mysqli_num_rows($res);
            if($count>0)
            {
         //Category available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the values like title ,image_name_id
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];

                ?>
                <a href="category-foods.php">
                    <div class="box-3 float-container">
                        <?php
                        //Check whether Image is available or not
                        if($image_name=="")
                        {
                            //Display message
                            echo "<div class='error'>Image not available</div>";
                        }else{
                            //Image Available
                            ?>
                            <img src="images/category/<?=$image_name;?>" alt="Pizza" class="img-responsive1 img-curve">
                            <?php
                        }
                            ?>

                        <h3 class="float-text text-white"><?=$title;?></h3>
                    </div>
                </a>

            <?php
                }

            }else{
          //categories not available
              echo"<div class='error'>Category are not Added.</div>";
            }

            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
               <?php
               $sql2="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
               $res2= mysqli_query($conn,$sql2);

               $count2=mysqli_num_rows($res2);

               if($count2>0)
               {
                  while($row=mysqli_fetch_assoc($res2))
                  {
                     $id=$row['id'];
                     $title=$row['title'];
                     $price=$row['price'];
                     $description=$row['description'];
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
                                  <img src="images/food/<?=$image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
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
