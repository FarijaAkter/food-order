<?php include("partials/menu.php");?>

<!--Main Content section starts-->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br/>

<?php
if(isset($_SESSION['add'])){
    echo $_SESSION['add'];//Displaying session message
    unset($_SESSION['add']);//Removing session message
}
if(isset($_SESSION['delete'])){
    echo $_SESSION['delete'];//Displaying session message
    unset($_SESSION['delete']);//Removing session message
}
if(isset($_SESSION['update'])){
    echo $_SESSION['update'];//Displaying session message
    unset($_SESSION['update']);//Removing session message
}
if(isset($_SESSION['user-not-found'])){
    echo $_SESSION['user-not-found'];//Displaying session message
    unset($_SESSION['user-not-found']);//Removing session message
}
if(isset($_SESSION['password-not-match'])){
    echo $_SESSION['password-not-match'];//Displaying session message
    unset($_SESSION['password-not-match']);//Removing session message
}
if(isset($_SESSION['change-password'])){
    echo $_SESSION['change-password'];//Displaying session message
    unset($_SESSION['change-password']);//Removing session message
}
?>
        <br/>
        <br/> <br/>
        <!--Button to add admin-->


        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br/><br/>
            <table class="tbl-full">
               <tr>
                   <th>S.N.</th>
                   <th>Full Name</th>
                   <th>User Name</th>
                   <th>Actions</th>
               </tr>
                <?php
                //query to get all admin
                $sql="SELECT  * FROM tbl_admin";
                //Execute the query
                $res= mysqli_query($conn, $sql);
                //Check whether the  Query is Executed or not
                if($res==TRUE)
                {
                    //Count Rows to check whether we have data in Database or not

                    $count= mysqli_num_rows($res);//Function to get all the rows in database

                    $sn=1;//Create a variable and assign the value
                    //check the num of rows
                    if($count>0)
                    {
                        //we have data in databse
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            //Using while loop to get all the data from database
                            //And while loop will run as long as we have data in Database

                            //get individual data
                            $id=$rows['id'];
                            $full_name=$rows['fullname'];
                            $username=$rows['username'];
                            //displays the values in our table
                            ?>

                            <tr>
                                <td><?=$sn++;?></td>
                                <td><?php echo $full_name;?></td>
                                <td><?php echo $username;?></td>
                                <td>
                                    <a href="update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                                    <a href="update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                    <a href="delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else {
                        //we do not have data in databse
                    }
                }

                ?>

            </table>
    </div>
</div>
<!--Main Content section ends-->

<?php include("partials/footer.php");?>