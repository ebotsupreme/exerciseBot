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

// get exercise name from url
$exerciseName = trim($_GET["exerciseDay"]);

?>
<style>
    #selectExerciseForDayContainer {
        display: none;
    }
</style>
<div><?= $exerciseName ?></div>
<br>
<div>
    <a href="//localhost:80/exercise_generator/view/selectedExercisesForTheDay.php?exerciseDay=<?= $exerciseName ?>">
        Set Exercise for <?= $exerciseName ?>
    </a>
</div>
<br>
<!--<div>-->
<!--    <a href="//localhost:80/exercise_generator/view/monday.php?exerciseDay=--><?//= $exerciseName ?><!--">-->
<!--        Log Sets & Reps for --><?//= $exerciseName ?>
<!--    </a>-->
<!--</div>-->
<div>
    <a href="//localhost:80/exercise_generator/view/showSelectedExercisesForTheDay.php?exerciseDay=<?= $exerciseName ?>">
        Log Sets & Reps for <?= $exerciseName ?>
    </a>
</div>
<br>
<div>
    <a href="//localhost:80/exercise_generator/">
        Select another day
    </a>
</div>

<!-- tomorrow i need to grab the day value from url,.
    we will need two options here:
    1. link to set exercises for this day.
    2. will be to log sets/reps for this day.


 -->