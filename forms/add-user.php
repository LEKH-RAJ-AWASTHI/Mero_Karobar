<?php
    include('../partials/header.inc.php');
?>
<?php
    if(isset($_SESSION['add'])){
      echo $_SESSION['add']; //Displaying session message
      unset($_SESSION['add']); //removing session message
    }
    if(isset($_SESSION['user_already_exist'])){
      echo $_SESSION['user_already_exist']; //Displaying session message
      unset($_SESSION['user_already_exist']); //removing session message
    }
    if(isset($_SESSION['password_not_match'])){
      echo $_SESSION['password_not_match']; //Displaying session message
      unset($_SESSION['password_not_match']); //removing session message
    }
    if(isset($_SESSION['sql-error'])){
      echo $_SESSION['sql-error']; //Displaying session message
      unset($_SESSION['sql-error']); //removing session message
    }

    ?>
<?php
if(isset($_POST['submit']))
{
  $username=get_safe_value($con,$_POST['username']);
  $password=md5(get_safe_value($con,$_POST['password']));
  $con_password=md5(get_safe_value($con,$_POST['confirm_password'])); //password is encrypted with md5

  // echo "$full_name , $username, $password";
    if($con_password!=$password){
        $_SESSION['password_not_match']='
  
        <div id="add" class="alert alert-danger" role="alert">
        Passwords do not match
        
      </div>
      ';
      header("location:".SITEURL."forms/add-user.php");
      die();
    }

  $check_existing_sql="select user_name from users where user_name='$username'";

  $res=mysqli_query($con, $check_existing_sql) or die(mysqli_error($con));
  if($res)
  {
    $count_rows=mysqli_num_rows($res);
    if($count_rows)
    {
      $_SESSION['user_already_exist']='
  
        <div id="add" class="alert alert-success" role="alert">
        Username already exists please select another username
        
      </div>
      ';
      header("location:".SITEURL."forms/add-user.php");
      die();

    }
    else
    {
      $sql="INSERT INTO users (user_name, password) VALUES('$username', '$password')";

      $res= mysqli_query($con, $sql) or die(mysqli_error($con));
    
  
      if ($res) {
        // data insertion successful
        // echo "<script>showRibbon();</script>";
  
        //create a session varible to display message
        $_SESSION['add']='
  
        <div id="add" class="alert alert-success" role="alert">
        Data Inserted Successfully
        
      </div>
      ';
  
  
        // REDIRECT TO MANAGE ADMIN 
        header("location:".SITEURL."sites/index.php");
  
      }
      
  
      else{
        $_SESSION['add']="Failed to add data";
        header("location:".SITEURL."sites/index.php");
      }
  
    }
  }

  else
  {
    $_SESSION['sql-error']='<div id="add" class="alert alert-danger" role="alert">
    Database error: command not executed.
    
    </div>';
    header("location:".SITEURL."sites/index.php");

  }
}

?>
<div class="container-fluid d-flex justify-content-center mt-4 ">
    <h2>Add User</h2>
</div>
<div class="container mb-5" id="bill_form">
    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" pattern="[a-zA-Z0-9]+" placeholder="Enter username eg: abc123" required>
        </div>

        <div class="form-group" id="password-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password"
                placeholder="Enter password" pattern=".{8,}" required>
        </div>

        <div class="form-group" id="confirm_password-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                placeholder="Confirm password" oninput="checkPasswordMatch()" required>
            <p id="confirm_password_message" class="text-danger"></p>
        </div>

        <!-- ... submit button ... -->
        <div class="container-fluid d-flex justify-content-center m-3">
        <input type="submit" class="btn btn-primary" name="submit">
    </div>
    </form>
</div>

<script>
    const passwordField = document.getElementById("password");
    const confirmPasswordField = document.getElementById("confirm_password");
    const confirmMessage = document.getElementById("confirm_password_message");

    function checkPasswordMatch() {
        if (passwordField.value !== confirmPasswordField.value) {
            confirmMessage.textContent = "Confirm password does not match";
        } else {
            confirmMessage.textContent = "";
        }
    }

    confirmPasswordField.addEventListener("input", checkPasswordMatch);
</script>