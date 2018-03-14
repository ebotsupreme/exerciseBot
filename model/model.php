<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once (__DIR__ . "/../config.php");
//include(SITE_ROOT . "./model/db_connection.php");

function first($int, $string){ //function parameters, two variables.
    return $string;  //returns the second argument passed into the function
}

function getAllExercises($exerciseName)
{
    try {
        $statement = $myPDO->prepare("SELECT * 
                                            FROM exercises
                                            WHERE exerciseName = :exerciseName");
        $statement->bindParam("exerciseName", $exerciseName);
        $statement->execute();
        $exercise_Ar = $statement->fetchAll();

        echo "<pre><br>";
        print_r($exercise_Ar);
        echo "</pre><br>";
    } catch (Exception $e) {
        $dbError = $e->getMessage();
    }
}


function exerciseLogCreate($exerciseName, $weightOne, $setOne, $weightTwo, $setTwo, $weightThree, $setThree, $weightFour, $setFour)
{
    // Call the PDO class
    $databaseConnect = new DatabaseConnect();
    $pdo = $databaseConnect->getPdo();

    //// Insert exercise data into DB
    try {
        $statement = $pdo->prepare("INSERT INTO exercises (dateCreated, exerciseName, WeightOne, SetOne, WeightTwo, SetTwo, WeightThree, SetThree, WeightFour, SetFour)
                                     VALUES (:dateCreated, :exerciseName, :WeightOne, :SetOne, :WeightTwo, :SetTwo, :WeightThree, :SetThree, :WeightFour, :SetFour)
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

    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
}
