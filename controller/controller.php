<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once (__DIR__ . "/../config.php");
require_once (SITE_ROOT . "/./view/monday.php");
require_once (SITE_ROOT . "/./model/db_connection.php");
include (SITE_ROOT . "/./model/model.php");

echo first(1,"omg lol"); //returns omg lol;

if (null !== (filter_input(INPUT_POST,"submitSquats"))) {
    echo 'Starting..';
    $exerciseName   = "";
    $exerciseName   = $_POST["squats"];
    $weightOne      = $_POST["squatWeight1"];
    $setOne         = $_POST["squatRep1"];
    $weightTwo      = $_POST["squatWeight2"];
    $setTwo         = $_POST["squatRep2"];
    $weightThree    = $_POST["squatWeight3"];
    $setThree       = $_POST["squatRep3"];
    $weightFour     = $_POST["squatWeight4"];
    $setFour        = $_POST["squatRep4"];
 echo 'Middle';
    exerciseLogCreate($exerciseName, $weightOne, $setOne, $weightTwo, $setTwo, $weightThree, $setThree, $weightFour, $setFour);
    echo 'function called';
}
// $exerciseName, $weightOne, $setOne, $weightTwo, $setTwo, $weightThree, $setThree, $weightFour, $setFour