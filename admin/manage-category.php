<?php include("partials/menu.php");?>

<div class="main-content">
  <div class="wrapper">
      <h1>Manage Category</h1>
      <br/>
      <br/>



      <?php
      if (isset($_SESSION['add'])){
          echo $_SESSION['add'];
          unset($_SESSION['add']);
      }
      if (isset($_SESSION['remove'])){
          echo $_SESSION['remove'];
          unset($_SESSION['remove']);
      }
      if (isset($_SESSION['delete'])){
          echo $_SESSION['delete'];
          unset($_SESSION['delete']);
      }
      if (isset($_SESSION['no-category-found'])){
          echo $_SESSION['no-category-found'];
          unset($_SESSION['no-category-found']);
      }
      if (isset($_SESSION['update'])){
          echo $_SESSION['update'];
          unset($_SESSION['update']);
      }
      if (isset($_SESSION['upload'])){
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
      }
      if (isset($_SESSION['failed-remove'])){
          echo $_SESSION['failed-remove'];
          unset($_SESSION['failed-remove']);
      }
      ?>
      <br/>
      <br/>
      <!--Button to add admin-->


      <a href="add-category.php" class="btn-primary">Add Category</a>
      <br/><br/>
      <table class="tbl-full">
          <tr>
              <th>S.N.</th>
              <th>Title</th>
              <th>Image</th>
              <th>Featured</th>
              <th>Active</th>
              <th>Actions</th>
          </tr>
          <?php
          $sql="SELECT * FROM tbl_category";
            $res= mysqli_query($conn,$sql);
            //count rows
          $count=mysqli_num_rows($res);

           //Create Serial Number Variable

          $sn=1;
          //check whether we have data in database or not

          if ($count>0)
          {
                //we have data in database
                //get the data and display
              while($row=mysqli_fetch_assoc($res))
              {
                  $id=$row['id'];
                  $title=$row['title'];
                  $image_name=$row['image_name'];
                  $featured=$row['featured'];
                  $active=$row['active'];
                  ?>
                  <tr>
                  <td><?=$sn++;?></td>
                  <td><?=$title;?></td>

                  <td>
                      <?php
                      //Check whether image name is available or not
                      if ($image_name!="")
                      {
                         //display the image
                          ?>
                          <img src="../images/category/<?=$image_name;?>" alt="" width="100px">

                          <?php
                      }else{
                        //not display the message
                          echo"<div class='error'>Image not Added.</div>";
                      }
                      ?>
                  </td>

                  <td><?=$featured;?></td>
                  <td><?=$active;?></td>
                  <td>
                      <a href="update-category.php?id=<?=$id;?>" class="btn-secondary">Update Category</a>
                      <a href="delete-category.php?id=<?=$id;?>&image_name=<?=$image_name;?>" class="btn-danger">Delete Category</a>
                  </td>
                  <?php
              }

          }else {
                    //we have data in database
                    //we'll display the message inside table
              ?>
              <tr>
                 <td colspan="6"><div class="error">No Category Added.</div></td>
              </tr>
          <?php

          }

          ?>

          </tr>
      </table>
  </div>
</div>
  </div>
</div>

<?php include("partials/footer.php");?>
