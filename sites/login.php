<?php
include('../config/connection.inc.php');
include('../config/functions.inc.php');
?>
<?php
if (isset($_SESSION['login'])) {
  echo $_SESSION['login']; //Displaying session message
  unset($_SESSION['login']); //removing session message
}
if (isset($_SESSION['no-login'])) {
  echo $_SESSION['no-login']; //Displaying session message
  unset($_SESSION['no-login']); //removing session message
}

?>
<?php
if (isset($_POST['submit'])) {
  // echo "hello ";
  $username = get_safe_value($con, $_POST['username']);
  $password = md5(get_safe_value($con, $_POST['password']));

  $sql = "select * from users where user_name='$username' and password='$password'";
  $res = mysqli_query($con, $sql) or die(mysqli_error($con));
  $count = mysqli_num_rows($res);
  if ($count == 1) {
    $_SESSION['login'] = '
    <div id="add" class="alert alert-success" role="alert">
    Login Successful ' . $username .
      ' </div>
    ';
    $_SESSION['user'] = $username; //to check if user is logged in or not and logout will unset this session
    header("location:" . SITEURL . "sites/index.php");
  } else {
    $_SESSION['login'] = '
    <div id="add" class="alert alert-danger" role="alert">
    Sorry credentials did not match. Please try again
    </div>
    ';
    header("location:" . SITEURL . "sites/login.php");
    die();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
    <title>Document</title>
  </head>

  <body>

    <section class="h-100 gradient-form" style="background-color: #eee;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-xl-10">
            <div class="card rounded-3 text-black">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="card-body p-md-5 mx-md-4 mt-5">

                    <div class="text-center">
                      <h3>Mero Karobar</h3>
                      <span class="mt-1 mb-5 pb-1"><strong>To Enter your record keeping Please login to your
                          account</strong></span>
                    </div>

                    <form action="" method="POST">
                      <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example11">Username</label>
                        <input type="text" id="form2Example11" name="username" class="form-control"
                          placeholder="Enter Username"  required/>
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example22">Password</label>
                        <input type="password" name="password" id="form2Example22" class="form-control" required />
                      </div>

                      <div class="text-center pt-1 mb-5 pb-1">
                        <input class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="submit"
                          value="submit">
                      </div>

                    </form>

                  </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                  <div class=" px-3 py-4 p-md-5 mx-md-4 mb-5">
                    <h4 class="mb-4">I am Mero Karobar</h4>
                    <p class="small mb-0" id="typed-text"> </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script>
      const textElement = document.getElementById('typed-text');
      const textToType = "I am a dynamic web application designed to elevate business management. Offering features such as financial tracking, inventory management, and empowers businesses to optimize operations";
      let index = 0;

      function typeText() {
        if (index <  textToType.length) {
          textElement.textContent += textToType.charAt(index);
          index++;
          setTimeout(typeText, 10); // Adjust the typing speed here
        }
      }

      typeText();
    </script>
  </body>

</html>