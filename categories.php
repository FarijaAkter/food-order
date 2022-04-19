<?php include('front-partials/menu.php');?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php
            //Display All the categories that are active
            //sql query
            $sql="SELECT * FROM tbl_category WHERE active='Yes'";
            $res=mysqli_query($conn,$sql);

            $count=mysqli_num_rows($res);
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];

                    ?>
                    <a href="category-foods.php">
                        <div class="box-3 float-container">
                            <?php
                            if($image_name=="")
                            {
                                //Display message
                                echo "<div class='error'>Image not Found</div>";
                            }else{
                               ?>
                                <img src="images/category/<?=$image_name;?>" alt="Pizza" class="img-responsive1
                                img-curve">
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
                echo"<div class='error'>Category are not Found.</div>";
            }



            ?>




            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


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