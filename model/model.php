<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once(__DIR__ . "/../config.php");
require_once(SITE_ROOT . "./model/db_connection.php");

$dbError = "";

function getAllExercises($exerciseName, $pdo)
{
    try {

        $statement = $pdo->prepare("SELECT * 
                                    FROM exercises
                                    WHERE exerciseName = :exerciseName 
                                    ORDER BY dateCreated DESC LIMIT 4");
        $statement->bindParam("exerciseName", $exerciseName);
        $statement->execute();
        $exercise_Ar = $statement->fetchAll();

        return $exercise_Ar;
    } catch (PDOException $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
}


function exerciseLogCreate($exerciseName, $weightOne, $setOne, $weightTwo, $setTwo, $weightThree, $setThree, $weightFour, $setFour, $pdo)
{

    //// Insert exercise data into DB
    try {

        $statement = $pdo->prepare("INSERT INTO exercises (dateCreated, exerciseName, WeightOne, SetOne, WeightTwo, SetTwo, WeightThree, SetThree, WeightFour, SetFour)
                                     VALUES (NOW(), :exerciseName, :WeightOne, :SetOne, :WeightTwo, :SetTwo, :WeightThree, :SetThree, :WeightFour, :SetFour)
                                     ");
        $statement->bindParam("exerciseName", $exerciseName);
        $statement->bindParam("WeightOne", $weightOne);
        $statement->bindParam("SetOne", $setOne);
        $statement->bindParam("WeightTwo", $weightTwo);
        $statement->bindParam("SetTwo", $setTwo);
        $statement->bindParam("WeightThree", $weightThree);
        $statement->bindParam("SetThree", $setThree);
        $statement->bindParam("WeightFour", $weightFour);
        $statement->bindParam("SetFour", $setFour);
        $statement->execute();

        $message = "Your exercise has been saved!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } catch (PDOException $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
}

function selectExercisesForDay($pdo)
{
    // Selecting exercises from day
    try {
        $statement = $pdo->prepare("SELECT exerciseName, exerciseImage 
                                    FROM exercise_select
                                    ORDER BY exerciseName ASC
                                    ");
        $statement->execute();
        $exerciseList_Ar = $statement->fetchAll();

        return $exerciseList_Ar;

    } catch (PDOException $e) {
        $dbError = $e->getMessage();
        echo 'Caught exception' . $dbError, "\n";
    }

}

function exerciseForDay ($selectedExerciseOne)
{
    $statement = $pdo->prepare("INSERT INTO exercise_day (exerciseDay, exerciseType, exerciseName)
                               VALUES(:exercise_day, :exerciseType, :exerciseName)
                               ");
    $statement->bindParam("exerciseDay", );
}
