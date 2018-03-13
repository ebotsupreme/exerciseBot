<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once (__DIR__ . "/../config.php");
require (SITE_ROOT . "/./view/monday.php");
require_once(SITE_ROOT . "/./model/db_connection.php");

if (null !== (filter_input(INPUT_POST,"submitSquats"))) {

}
