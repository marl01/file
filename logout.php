<?php

//define("start", true);

//require_once("lib/functions.php");

session_start();

session_destroy();

header("Location: http://flyfile.space/index.php");

die();