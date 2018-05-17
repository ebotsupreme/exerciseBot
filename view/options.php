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
$exerciseDay = trim($_GET["exerciseDay"]);

?>
<style>
    #selectExerciseForDayContainer {
        display: none;
    }
</style>
<div><?= $exerciseDay ?></div>
<br>
<div>
    <a href="//localhost:80/exercise_generator/view/selectedExercisesForTheDay.php?exerciseDay=<?= $exerciseDay ?>">
        Set Exercise for <?= $exerciseDay ?>
    </a>
</div>
<br>
<!--<div>-->
<!--    <a href="//localhost:80/exercise_generator/view/monday.php?exerciseDay=--><?//= $exerciseName ?><!--">-->
<!--        Log Sets & Reps for --><?//= $exerciseName ?>
<!--    </a>-->
<!--</div>-->
<div>
    <a href="//localhost:80/exercise_generator/view/showSelectedExercisesToLogReps.php?exerciseDay=<?= $exerciseDay ?>">
        Log Sets & Reps for <?= $exerciseDay ?>
    </a>
</div>
<br>
<div>
    <a href="//localhost:80/exercise_generator/">
        Select another day
    </a>
</div>

<!-- tomorrow i need to figure out how to:
    we will need two options here:

    3. on set exercise for monday i need to fix the order number and active status so it records it in phpmyadmin.
    -->

