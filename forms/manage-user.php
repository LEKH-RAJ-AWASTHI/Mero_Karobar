<?php include('../partials/header.inc.php'); ?>

<?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];//Displaying session message
                unset($_SESSION['add']);// removing session message
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];//Displaying session message
                unset($_SESSION['delete']);// removing session message
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];//Displaying session message
                unset($_SESSION['update']);// removing session message
            }
            if(isset($_SESSION['change_password']))
            {
                echo $_SESSION['change_password'];//Displaying session message
                unset($_SESSION['change_password']);// removing session message
            }
            if(isset($_SESSION['change-pwd'])){
                echo $_SESSION['change-pwd']; //Displaying session message
                unset($_SESSION['change-pwd']); //removing session message
              }
              if(isset($_SESSION['user-not-found'])){
                  echo $_SESSION['user-not-found']; //Displaying session message
                  unset($_SESSION['user-not-found']); //removing session message
              }
              if(isset($_SESSION['pwd-not-matched'])){
                  echo $_SESSION['pwd-not-matched']; //Displaying session message
                  unset($_SESSION['pwd-not-matched']); //removing session message
              }
              if(isset($_SESSION['sql-error'])){
                  echo $_SESSION['sql-error']; //Displaying session message
                  unset($_SESSION['sql-error']); //removing session message
              }
            //   if(isset($_SESSION['user_already_exist'])){
            //       echo $_SESSION['user_already_exist']; //Displaying session message
            //       unset($_SESSION['user_already_exist']); //removing session message
            //   }

        ?>

    <div class="container-fluid d-flex justify-content-center mt-4 ">
        <h2>Manage User</h2>
    </div>
    <div class="container my-3">
        <div class="buttons" style="width: 300px;">

            <a href="<?php echo SITEURL; ?>forms/add-user.php"> 
                <button class="btn btn-primary mt-3" >Add User</button>
            </a>
            
            <br>
        </div>
    </div>

<?php //search button ?>
    <!-- <div class="container">
        <div class="container search-box pb-3 p-0 fs-5">

            <input style="width: 800px" class="p-2" type="search" name="" id="">
            <button class="p-2 px-5" type="submit">Search</button>
        </div> -->
        <div class="container mb-5"> 


            <table class="table table-bordered">
                <thead>
                    
                        <th>S.No</th>
                        <th>Username</th>
                        <th>Action</th>

                </thead>
                <tbody>
                <?php
                $sql="SELECT * FROM users";
                $res= mysqli_query($con,$sql);

                if($res){
                    //count rows
                    $count=mysqli_num_rows($res);// function to show the number of rows
                    if($count>0)
                    {
                        $sn=1;
                       while($rows=mysqli_fetch_assoc($res))
                       {
                            $id= $rows['uid'];
                            $name=$rows['user_name'];
                            $privilege=$rows['privilege'];
                           
                            //for address
                           
                            // displaying the value in table
                            ?>
                            <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $name; ?></td>


                            <td>
                                <a href="<?php echo SITEURL; ?>forms/change-user-pwd.php?id=<?php echo $id ?>" class="btn btn-secondary btn-sm m-1" <?php if($privilege=='superadmin') echo 'style="display:none;"' ?>>Change Passoword</a>
                                <a href="<?php echo SITEURL; ?>forms/delete-user.php?id=<?php echo $id ?>" class="btn btn-danger btn-sm m-1" <?php if($privilege=='superadmin') echo 'style="display:none;"' ?>>Remove User</a>
                            </td>
                         </tr>
                            <?php 
                        }
                    }
                    else
                    {
                        // echo "We donot have data in database";
                    }
                }
            ?>
                </tbody>
            </table>
        </div>
        

       

<?php include('../partials/footer.inc.php'); ?>
