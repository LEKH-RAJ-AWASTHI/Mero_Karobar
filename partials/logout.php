<?php
    include('../partials/header.inc.php');
    //  include('login-check.inc.php');
    // error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

    //destroy the session
    session_destroy();//unsets $_SESSION['user']
    //redirect to login page
    header('location:'.SITEURL.'sites/login.php');
?> 