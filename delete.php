<?php

define("start", true);

require_once("lib/functions.php");

$user = false;

$action = false;

if(isset($_SESSION['user'])){

  $user = intval($_SESSION['user']);

} else {

  // Redirect
  header("Location: http://flyfile.space/file.php");
  die();

}


// Basic check for get
if(isset($_GET)){

  // Check if get id exists
  if(isset($_GET['id'])){


    $id = intval($_GET['id']);

    // Validate id
    if ($id > 0) {
      // Correct
      // Continue

      if($user > 0){

        // Get fileshare functions
        $fs = new Fileshare();

        $result = $fs->check_file ($id, $user);

        $folder_delete = 'files/' . $result['folder'] . '/';

        if(!$result){
          
          $action = "Boyle bir dosya yok verıtabanda yok (dosya id -> " . $id . " )";

        } else {

          $result = unlink($result['link']);

          rmdir($folder_delete);

          if($result){

            // Delete from db
            $fs->delete_file ($id, $user);

            $action = "Dosya silindi id -> (" . $id . " )";

          } else {

            // Bir hata olustu
            $action = "Dosya silinmedi!";

          }


        }
      } else {

        $action = "Yetkiniz yok (dosya id -> " . $id . " )";

      }


    } else {

      $action = "Dosya id hatalı! (sıfır)";

    }

  } else {

    $action = "Dosya id hatalı! (get yok)";

  }


} else {

  $action = "Dosya id yok";

}

$_SESSION['action'] = $action;

header("Location: http://flyfile.space/file.php");

die();



?>