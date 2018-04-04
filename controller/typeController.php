<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once (__DIR__ . "/../config.php");
require_once (SITE_ROOT . "/./model/db_connection.php");

//require_once(SITE_ROOT . "/./includes/header.php");
//require_once (SITE_ROOT . "/./view/monday.php");
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

        foreach ($exerciseTypeResultAr as $exercise) {
//            echo $exercise['exerciseName'];
//            return $exercise['exerciseName'];
//            echo '<pre><br>';
//            print_r($exercise);
//            echo '</pre><br>';
            echo $exercise['exerciseName'];

            if ($_GET["query"] == $exercise['exerciseName']) {
                echo $exercise['exerciseName'];
            }

        }

        return true;
//        return $exerciseTypeResultAr;

//        echo "<table>
//                <tr>
//                <th>Exercise Name</th>
//            ";
//        while($row = $exerciseTypeResultAr) {
//            echo "<tr>";
//            echo "<td>" . $row['exerciseName'] . "</td>";
//            echo "</tr>";
//        }
//        echo "</table>";


    } catch (PDOException $e) {
        $dbError = $e->getMessage();
        echo 'Caught exception' . $dbError, "\n";
    }
}
selectExerciseType($pdo, $query);
