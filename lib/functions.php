<?php
if(!defined('start')){die('Direkt dosya ulasimi yasak');}

require_once("config.php");

// Why it's here?
// Need to rewrite a bit
session_start();

class Fileshare {

	private $db;

	public function __construct()  {

		$this->db = $this->db_connect();

    }

    private function db_connect() {
        global $db_host, $db_user, $db_pass, $db_base;

        $connection = new mysqli(
            $db_host,
            $db_user,
            $db_pass,
            $db_base
        );
        if(!$connection){
            die("Veritabanina baglanamadi");
        } else {
            return $connection;
        }
    }

	public function create ($email, $pass) {

		$pass = md5($pass);

		$sql = "INSERT INTO users (username, password) VALUES ('" . $email . "', '" . $pass . "');";
		
		$result = $this->db->query($sql);

        if($result){

            return $this->db->insert_id;

        } else {

            return false;

        }
		
	}

	public function login ($email, $pass) {

		$pass = md5($pass);

		$sql = "SELECT id FROM users WHERE username = '" . $email . "' AND password = '" . $pass . "'; ";

		$result = $this->db->query($sql);
		$rows 	= $result->num_rows;
		if($rows){

			$row = $result->fetch_assoc();

			return $row['id'];

        } else {

            return false;

        }

	}

	public function upload_file ($name, $size, $user, $link, $folder, $type) {
		
		$id = mt_rand();
		$sql = "INSERT INTO files (id, name, size, date, user, link, folder, type) VALUES ('" . $id . "', '" . $name . "', '" . $size . "', CURRENT_TIMESTAMP, '" . $user . "', '" . $link . "',  '" . $folder . "', '" . $type . "');";

		$result = $this->db->query($sql);

		if($result){

            return $id;

        } else {

        	return false;
            

        }

	}

	public function download_file ($id) {

		$sql = "SELECT * FROM files WHERE id = '" . $id . "';";

		$result = $this->db->query($sql);

		$rows 	= $result->num_rows;

		if($rows){

			$row = $result->fetch_assoc();

			return $row;

        } else {

            return false;

        }

	}
	public function check_file ($id, $user) {

		$sql = "SELECT * FROM files WHERE id = '" . $id . "' AND user = '" . $user . "';";

		$result = $this->db->query($sql);

		$rows 	= $result->num_rows;

		if($rows){

			$row = $result->fetch_assoc();

			return $row;

        } else {

            return false;

        }

	}
	public function delete_file ($id, $user, $admin = 0){

		if($admin){

			$sql = "DELETE FROM files WHERE id = '" . $id . "';";

		} else {

			$sql = "DELETE FROM files WHERE id = '" . $id . "' AND user = '" . $user . "';";

		}

		$result = $this->db->query($sql);

		if($result){

			return true;

		} else {

			return false;
		}

	}

	public function show_files ($user, $admin = 0){

		if($admin){

			$sql = "SELECT * FROM files;";

		} else {

			$sql = "SELECT * FROM files WHERE user = '" . $user . "';";

		}

		$result = $this->db->query($sql);

		$rows 	= $result->num_rows;

		if($rows > 0 ){


			while($result_array_one = $result->fetch_array())
			{
				$result_array[] = $result_array_one;
			}

			return $result_array;

        } else {

            return false;

        }

	}

}

?>