<?php
function myFunction(...$args) {
    $numArgs = count($args);
    if ($numArgs === 1) {
        echo 'This function takes one argument.';
        echo $args[0];
    } elseif ($numArgs === 2) {
        echo 'This function takes two arguments.';
        echo $args[0];
        echo $args[1];

    } else {
        echo 'This function takes more than two arguments.';
        echo $args[0];
        echo $args[1];
        echo $args[2];

    }
}


// myFunction(1, 2, 3); // This function takes more than two arguments.
// myFunction(1, 2); // This function takes two arguments.
// myFunction(1); // This function takes one argument.
?>
<form action="">
    Name=<input type="text" name="name" id="name">
    <br>
    <input type="submit">
</form>
<?php
$name2=null;
$id=1;
if($_GET['name']==$name2){
    echo "equal";
}
else{

    echo "not equal";
}


// echo $_GET['name'];
// echo $id++;?><br><?php
// echo $_REQUEST['name'];
// echo $id++;?><br><?php
// echo $_SERVER['PHP_SELF'];
// echo $id++;?><br><?php
// echo $_SERVER['SERVER_NAME'];
// echo $id++;?><br><?php
// echo $_SERVER['HTTP_HOST'];
// echo $id++;?><br><?php
// echo $_SERVER['HTTP_USER_AGENT'];
// echo $id++;?><br><?php
// echo $_SERVER['SCRIPT_NAME'];
// echo $id++;?><br><?php
// echo $_SERVER['REMOTE_ADDR'];
// echo $id++;?><br><?php
// echo $_SERVER['SERVER_ADDR'];
// echo $id++;?><br><?php
// echo $_SERVER['SERVER_PORT'];
// echo $id++;?><br><?php
// echo $_SERVER['SERVER_PROTOCOL'];
// echo $id++;?><br><?php
// echo $_SERVER['REQUEST_METHOD'];
// echo $id++;?><br><?php
// echo $_SERVER['REQUEST_TIME'];
// echo $id++;?><br><?php
// echo $_SERVER['QUERY_STRING'];
// echo $id++;?><br><?php
// echo $_SERVER['HTTP_REFERER'];
// echo $id++;?><br><?php
// echo $_SERVER['HTTP_ACCEPT'];
// echo $id++;?><br><?php
// echo $_SERVER['HTTP_ACCEPT_ENCODING'];
// echo $id++;?><br><?php
// echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];
// echo $id++;?><br><?php
// echo $_SERVER['HTTP_CONNECTION'];
// echo $id++;?><br><?php
// echo $_SERVER['HTTP_HOST'];
// echo $id++;?><br><?php
// echo $_SERVER['HTTP_REFERER'];
// echo $id++;?><br><?php
// echo $_SERVER['HTTP_USER_AGENT'];
// echo $id++;?><br><?php
// echo $_SERVER['REMOTE_ADDR'];
// echo $id++;?><br><?php
// echo $_SERVER['REMOTE_PORT'];
// echo $id++;?><br><?php
// echo $_SERVER['SCRIPT_FILENAME'];
// echo $id++;?><br><?php
// echo $_SERVER['SERVER_ADMIN'];
// echo $id++;?><br><?php
// echo $_SERVER['SERVER_PORT'];
// echo $id++;?><br><?php
// echo $_SERVER['SERVER_SIGNATURE'];
// echo $id++;?><br><?php
// echo $_SERVER['DOCUMENT_ROOT'];
// echo $id++;?><br><?php
// echo $_SERVER['SERVER_SOFTWARE'];
// echo $id++;?><br><?php
// echo $_SERVER['GATEWAY_INTERFACE'];
// echo $id++;?><br><?php
// echo $_SERVER['SERVER_PROTOCOL'];
// echo $id++;?><br><?php
// echo $_SERVER['REQUEST_METHOD'];
// echo $id++;?><br><?php
// echo $_SERVER['QUERY_STRING'];
// echo $id++;?><br><?php
// echo $_SERVER['REQUEST_URI'];
// echo $id++;?><br><?php
// echo $_SERVER['SCRIPT_NAME'];
?>

// echo $_SERVER['PHP_SELF'];
// echo $_SERVER['REQUEST_TIME'];
