<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once (__DIR__ . "/../config.php");
require_once(SITE_ROOT . "/./includes/header.php");
require_once (SITE_ROOT . "/./model/db_connection.php");
require_once (SITE_ROOT . "/./model/model.php");

// Call the PDO class
$databaseConnect = new DatabaseConnect();
$pdo = $databaseConnect->getPdo();

?>
<style>
    #selectExerciseForDayContainer {
        display: none;
    }
</style>
<div>hello</div>

<!-- tomorrow i need to grab the day value from url,.
    we will need two options here:
    1. link to set exercises for this day.
    2. will be to log sets/reps for this day.

 
 -->