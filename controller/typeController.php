<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once (__DIR__ . "/../config.php");
require_once (SITE_ROOT . "/./model/db_connection.php");

//require_once(SITE_ROOT . "/./includes/header.php");
//require_once (SITE_ROOT . "/./view/logExercise.php");
//require_once (SITE_ROOT . "/./model/model.php");
//require_once(SITE_ROOT . "./view/selectedExercisesForTheDay.php");

// Call the PDO class
$databaseConnect = new DatabaseConnect();
$pdo = $databaseConnect->getPdo();

$query = $_GET['query'];

function selectExerciseType($pdo, $query)
{
    // Selecting exercise type
    try {
        $statement = $pdo->prepare("SELECT *
                                    FROM exercise_select
                                    WHERE exerciseType = :exerciseType;
                                  ");
        $statement->bindParam("exerciseType", $query);
        $statement->execute();
        $exerciseTypeResultAr = $statement->fetchAll();

        ?>
        <option id="none" name="none" value="none" selected="selected">No Exercise</option>
        <?php
        foreach ($exerciseTypeResultAr as $value) {

            $exerciseName = $value["exerciseName"];
            $exerciseId = $value["id"];
            $exerciseNumberValue = $value["exerciseNumberValue"];

            $selected = $exerciseId == $exerciseNumberValue? 'selected' : '';


            ?>

            <option id="<?= $exerciseId ?>" name="<?= $exerciseName ?>" value="<?= $exerciseName ?>"><?= $exerciseName ?></option>
            <?php
        }

        return true;

    } catch (PDOException $e) {
        $dbError = $e->getMessage();
        echo 'Caught exception' . $dbError, "\n";
    }
}
selectExerciseType($pdo, $query);
