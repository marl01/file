<?php

define("start", true);

require_once("lib/functions.php");

$user = false;


if(isset($_SESSION['user'])){
	$user = $_SESSION['user'];
} else {
	$user = 0;
}

if(isset($_POST)) {

	// Can't check this for post value
	//if(isset($_POST['dosya'])){

		// Create random folder id
		$folder 	= uniqid();


		// Create folder location
		$location 	= "files/"  . $folder . "/" ;


		// Create folder on server
		mkdir($location, 0755);


		// Upload location
		$upload = $location . basename($_FILES['dosya']['name']);

		// Check type
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$type = finfo_file($finfo, $_FILES['dosya']['tmp_name']);
		finfo_close($finfo);

		// Upload process
		if (move_uploaded_file($_FILES['dosya']['tmp_name'], $upload)) {

			// Get name
			$name = $_FILES['dosya']['name'];

			// Get size
			$size = $_FILES['dosya']['size'];

			// Get fileshare functions
		    $fs = new Fileshare();

		    // Insert to database
		    $result = $fs->upload_file ($name, $size, $user, $upload, $folder, $type);

		    if($result){

		        // Uploade done
		        // Now redirect
		        header("Location: http://flyfile.space/download.php?id=" . $result);
		        die();

		    } else {

		        // Error uploading return back;
			    $_SESSION['error'] = "Dosya yüklenmedi bir hata oluştu (veritabanına eklenmedi)";
			    header("Location: http://flyfile.space/index.php");
			    die();

		    }

		} else {

		    // Error uploading return back;
		    $_SESSION['error'] = "Dosya yüklenmedi bir hata oluştu (dosya klasöre taşınamadı)";
		    header("Location: http://flyfile.space/index.php");
		    die();



		}



	//} else {

 		// Error uploading return back;
		//$_SESSION['error'] = "Dosya yüklenmedi bir hata oluştu";
		//header("Location: http://flyfile.space/index.php");
		//die();

	//}

} else {
	// Error uploading return back;
	$_SESSION['error'] = "Dosya yüklenmedi bir hata oluştu (kod 3)";
	header("Location: http://flyfile.space/index.php");
	die();
}

?>