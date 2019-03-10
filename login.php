<?php

define("start", true);

require_once("lib/functions.php");

$user = false;

$error = false;

if(isset($_SESSION['user'])){
  header("Location: http://flyfile.space/index.php");
  die();
}

// Basic check for post
if(isset($_POST)){

  // Check if email and password exists
  if(isset($_POST['email']) && isset($_POST['password'])){

    // Validate email
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      // Correct
      // Continue

      // Validate password
      if(ctype_alnum($_POST['password'])) {
        // Correct
        // Continue

        $email = $_POST['email'];
        $pass = $_POST['password'];



        // Get fileshare functions
        $fs = new Fileshare();

        // Login
        $result = $fs->login ($email, $pass);

        if($result){

          $id = $result['id'];
          $admin = $result['admin'];

          if($admin == 1){
            $_SESSION['admin'] = true;
          }

          // Set user session
          $_SESSION['user'] = $id;
          
          // Login done
          // Now redirect
          header("Location: http://flyfile.space/index.php");
          die();

        } else {

          $error = "Hatalı giriş! Tekrar deneyiniz!";

        }

      } else {

        $error = "Şifre hatalı girildi! Tekrar deneyiniz!";

      }


    } else {

      $error = "E-posta hatalı girildi! Tekrar deneyiniz!";

    }

  }
  /* else {

    $error = "Hiç bir veri girilmedi! Tekrar deneyiniz!";

  } */


}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--<link rel="icon" href="../../favicon.ico">-->

    <title>Fly File Space - Kayıt ol</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">
  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Fly File Space</h3>
              <nav class="nav nav-masthead">
                <a class="nav-link" href="index.php">Ana Sayfa</a>
                <a class="nav-link active" href="login.php">Giriş</a>
                <a class="nav-link" href="signup.php">Kayıt ol</a>
              </nav>
            </div>
          </div>

<!-- Content -->



          <h1 class="cover-heading">Giriş</h1>

          <div class="inner cover">

<!-- Error -->
            <?php if($error) { ?>
            <br>
              <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
              </div>
            <?php } ?>

<!-- Error end -->

            <form method="post" action="login.php">

              <br>
              <br>

              <div class="form-group">
                <label for="email">E-posta</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="E-posta adresini giriniz..." required>
              </div>
              <div class="form-group">
                <label for="password">Şifre</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Şifreyi giriniz..." required>
              </div>

              <br>

            <button type="submit" class="btn btn-lg btn-secondary btn-block">Giriş</button>

            </form>

          </div>

<!-- Content end -->

<!---Footer-->

          <div class="mastfoot">
            <div class="inner">
              <p>Developed by Numbered</p>
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
