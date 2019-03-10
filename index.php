<?php

define("start", true);

require_once("lib/functions.php");

$user = false;


if(isset($_SESSION['user'])){
  $user = true;

  //var_dump($_SESSION['user']);

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--<link rel="icon" href="../../favicon.ico">-->

    <title>Fly File Space</title>

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
                <a class="nav-link active" href="index.php">Ana Sayfa</a>
                <?php if($user){ ?>
                <a class="nav-link" href="file.php">Dosyalarım</a>
                <a class="nav-link" href="logout.php">Çıkış</a>
                <?php } else { ?>
                <a class="nav-link" href="login.php">Giriş</a>
                <a class="nav-link" href="signup.php">Kayıt ol</a>
                <?php } ?>
              </nav>
            </div>
          </div>

<!-- Content -->

          <div class="inner cover">

            <h1 class="cover-heading">Dosya yükle</h1>
            <br>
            <br>
            <br>
            <form name="yukle" method="post" action="upload.php" enctype="multipart/form-data">

              <p class="lead push-rıght">
                <div id="loading" class="sr-only">
                  <img src="loading.gif" />
                </div>
                <div id="file" class="">
                  <input type="file" name="dosya">
                </div>
              </p>
              
              <br>
              <br>
              <button type="submit" id="submit" class="btn btn-lg btn-secondary btn-block" onclick="loading()">Yükle</button>

            </form>

          </div>


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

    <script>
    function loading(){

      // Remove hidden class from loading
      $('#loading').removeClass('sr-only');

      // Add hidden class to file input
      $('#file').addClass('sr-only');

      // Disable submit and change text
      $('#submit').addClass('disabled');

      // Change text to uploading
      $("#submit").html('Yükleniyor....');
    }
    </script>
  </body>
</html>