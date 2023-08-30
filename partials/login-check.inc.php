<?php
//authorization: access control
//check whether user is logged in or not
if(!isset($_SESSION['user']))//user session not set i.e. user is not logged in
{ 
    $_SESSION['no-login']='
    
    <div id="add" class="alert alert-danger" role="alert">
    You are not logged in. please login to access enter your record keeping system
    
  </div>
  ';
    header('location:'.SITEURL.'sites/login.php');
}
?>