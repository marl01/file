<?php

define("start", true);

require_once("lib/functions.php");

$user = false;

$error = false;

$action = false;

// Check if user logged in and redirect if needed
if(isset($_SESSION['user'])){

  $user = $_SESSION['user'];

} else {

  header("Location: http://flyfile.space/index.php");
  die();

}

// Check if there were some action
if(isset($_SESSION['action'])){

  // Get that session
  $action = $_SESSION['action'];

  // Clear that session
  $_SESSION['action'] = false;

}


// Check if validation is correct
if($user > 0){

  // Get fileshare functions
  $fs = new Fileshare();

  // Show files
  $result = $fs->show_files ($user);

  // If no results show error
  if(!$result){

    $error = "Dosyalar bulunamadı! Istediğin kadar yükle!";

  }


}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--<link rel="icon" href="../../favicon.ico">-->

    <title>Fly File Space - Dosyalarım</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">

    <link rel="stylesheet" href="css/rrssb.css">
    
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
                <?php if($user){ ?>
                <a class="nav-link active" href="file.php">Dosyalarım</a>
                <a class="nav-link" href="logout.php">Çıkış</a>
                <?php } else { ?>
                <a class="nav-link" href="login.php">Giriş</a>
                <a class="nav-link" href="signup.php">Kayıt ol</a>
                <?php } ?>
              </nav>
            </div>
          </div>

<!-- Content -->
          <h1 class="cover-heading">Dosyalarım</h1>

          <div class="inner cover">
            
            <!-- Action -->
            <?php if($action) { ?>
            <br>
              <div class="alert alert-success" role="alert">
                <?php echo $action; ?>
              </div>
            <?php } ?>
            <!-- Action end -->

            <!-- Error -->
            <?php if($error) { ?>
            <br>
              <div class="alert alert-info" role="alert">
                <?php echo $error; ?>
              </div>
            <?php } ?>
            <!-- Error end -->
            <br>
            <br>
            
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>#ID</th>
                  <th>Isim</th>
                  <th>Boyut</th>
                  <th>Tarih</th>
                  <th>Tür</th>
                  <th>Sil</th>
                  <th>Indir</th>
                  <th>Paylaş</th>
                </tr>
              </thead>
              <tbody>

              <?php if($result) {

                foreach ($result as $result_one) {

                ?>

                  <tr>
                    <th scope="row"><?php echo $result_one['id']; ?></th>
                    <td><?php echo $result_one['name']; ?></td>
                    <td><?php echo $result_one['size']; ?></td>
                    <td><?php echo $result_one['date']; ?></td>
                    <td><?php echo $result_one['type']; ?></td>
                    <td><a href="delete.php?id=<?php echo $result_one['id']; ?>" onclick="return confirm('Silinsinmi?')" target="self">Sil</a></td>
                    <td><a href="download.php?id=<?php echo $result_one['id']; ?>" target="_blank">Indir</a></td>
                    <td>
                    <a href="share.php?id=<?php echo $result_one['id']; ?>" onclick='window.open (this.href,"sare","width=300,height=50"); return false;'>Paylaş</a></td>

                  </tr>

                <?php } ?>


              <?php } ?>
              </tbody>
            </table>

          </div>

<!-- Content end -->

<!---Footer-->

          <div>
            <div class="mastfoot inner">
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
    <script src="js/rrssb.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>