<?php
include('../partials/header.inc.php');
?>
<div class="add-admin">
    <?php
    if(isset($_SESSION['change-pwd'])){
      echo $_SESSION['change-pwd']; //Displaying session message
      unset($_SESSION['change-pwd']); //removing session message
    }
    if(isset($_SESSION['pwd-not-matched'])){
        echo $_SESSION['pwd-not-matched']; //Displaying session message
        unset($_SESSION['pwd-not-matched']); //removing session message
    }
    if(isset($_SESSION['sql-error'])){
        echo $_SESSION['sql-error']; //Displaying session message
        unset($_SESSION['sql-error']); //removing session message
    }

    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }
    else  if($_SESSION['id']!=$_GET['id'] && $_SESSION['privilege']!="superadmin"){
        $_SESSION['unauthorized']='
        <div id="access-denied" class="alert alert-danger" role="alert">
        Access Denied </div>
        ';        
        header("location:".SITEURL."sites/login.php");
    }
    else{
        $_SESSION['unauthorized']='
        <div id="access-denied" class="alert alert-danger" role="alert">
        Access Denied </div>
        ';        
        header("location:".SITEURL."sites/login.php");
    }
    ?>
    <?php
    if($_SESSION['id']!=$_GET['id'] && $_SESSION['privilege']!="superadmin"){
        $_SESSION['unauthorized']='
        <div id="access-denied" class="alert alert-danger" role="alert">
        Access Denied </div>
        ';        
        header("location:".SITEURL."sites/login.php");
    }
    ?>

<?php
    if(isset($_POST['submit']))
    {

        $newPwd=md5(get_safe_value($con, $_POST['newPwd']));
        $conPwd=md5(get_safe_value($con, $_POST['conPwd']));
        $id=get_safe_value($con, $_POST['id']);
        if($_SESSION['id']!=$id){
            $_SESSION['unauthorized']="You are not authorized to change password of that user";
            header("location:".SITEURL."sites/login.php");
        }

        if($conPwd!=$newPwd){
            $_SESSION['pwd-not-matched']="New Password and Confirm Password mismatch";
            header("location:".SITEURL."forms/change-user-pwd.php");

        }
        $sql="UPDATE users SET 
                password='$newPwd'
                WHERE uid='$id'";
        $res=mysqli_query($con, $sql) or die(mysqli_error($con)." ");
        
        if($res)
        {
            $_SESSION['add']='
        
            <div id="add" class="alert alert-success" role="alert">
            Password Changed Successfully
            
            </div>';
            header("location:".SITEURL."sites/index.php");
        }

        else
        {
            $_SESSION['add']="Failed to change password";
            header("location:".SITEURL."forms/change-user-pwd.php");
        }
    }
?>
<div class="container-fluid d-flex justify-content-center mt-4 ">
    <h2>Change Password</h2>
</div>
<div class="container">
    <form action="" method="POST">
    <div class="form-group" id="password-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password" name="newPwd"
                placeholder="Enter password of 8 length" pattern=".{8,}" required>
        </div>

        <div class="form-group" id="confirm_password-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="text" class="form-control" id="confirm_password" name="conPwd"
                placeholder="Confirm password" oninput="checkPasswordMatch()" required>
            <p id="confirm_password_message" class="text-danger"></p>
        </div>
        <div class="container-fluid d-flex justify-content-center m-3">
            <input type="hidden" class="form-control" name="id" value="<?php echo $id;?>">
            <input type="submit" name="submit" class="btn btn-primary">
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

<?php include('../partials/footer.inc.php'); ?>

    
 