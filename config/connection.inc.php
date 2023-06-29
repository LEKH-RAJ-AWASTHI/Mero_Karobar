<?php 
    session_start();

    define('SITEURL','http://localhost/mero_karobar/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','Awasthii@123');
    define('DB_NAME','mero_karobar');
    $con=mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD,DB_NAME) or die(mysqli_error()) or die();
?>