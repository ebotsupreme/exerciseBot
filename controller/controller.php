<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once (__DIR__ . "/../config.php");
require_once (SITE_ROOT . "/./view/monday.php");
require_once (SITE_ROOT . "/./model/db_connection.php");
require_once (SITE_ROOT . "/./model/model.php");

// Call the PDO class
$databaseConnect = new DatabaseConnect();
$pdo = $databaseConnect->getPdo();
//echo '<pre>Post:<br>';
//var_dump($_POST);
//echo '</pre><br>';
//echo '<pre>Request:<br>';
//var_dump($_REQUEST);
//echo '</pre><br>';
//die('ded');
if (null !== (filter_input(INPUT_POST,"submitExerciseDay"))) {

    $exerciseName   = $_POST["squats"];
    $weightOne      = $_POST["squatWeight1"];
    $setOne         = $_POST["squatRep1"];
    $weightTwo      = $_POST["squatWeight2"];
    $setTwo         = $_POST["squatRep2"];
    $weightThree    = $_POST["squatWeight3"];
    $setThree       = $_POST["squatRep3"];
    $weightFour     = $_POST["squatWeight4"];
    $setFour        = $_POST["squatRep4"];

    exerciseLogCreate($exerciseName, $weightOne, $setOne, $weightTwo, $setTwo, $weightThree, $setThree, $weightFour, $setFour, $pdo);


}
// $exerciseName, $weightOne, $setOne, $weightTwo, $setTwo, $weightThree, $setThree, $weightFour, $setFour


if (null !== filter_input(INPUT_POST, "submitExerciseForDay")) {
    // with the post variables now i need to set up the rest below
    echo '<pre>Post:<br>';
    var_dump($_POST);
    echo '</pre><br>';

    foreach()

    $exerciseName1 = $_POST["exerciseSelect1"];
    echo 'exerciseName is:'.$exerciseName.'<br>';
    $exerciseOrderNumber = $_POST["exerciseOrderNumber"];
    echo 'exerciseOrderNumber is:'.$exerciseOrderNumber.'<br>';
    $exerciseDay = $_POST["exerciseDay"];
    echo 'exerciseDay is:'.$exerciseDay.'<br>';
    $exerciseType = $_POST["exerciseType"];
    echo 'exerciseType is:'.$exerciseType.'<br>';

    exerciseForDay($exerciseDay, $exerciseType, $exerciseName, $exerciseOrderNumber, $pdo);
}

