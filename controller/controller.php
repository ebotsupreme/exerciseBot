<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//ob_flush();
require_once (__DIR__ . "/../config.php");
require_once(SITE_ROOT . "/./view/logExercise.php");
require_once(SITE_ROOT . "/./view/showSelectedExercisesToLogReps.php");
require_once (SITE_ROOT . "/./model/db_connection.php");
require_once (SITE_ROOT . "/./model/model.php");

// Call the PDO class
$databaseConnect = new DatabaseConnect();
$pdo = $databaseConnect->getPdo();

function setInactive ($exerciseDay, $exerciseType, $pdo)
{
    // check by day, to see if there are exercises active first and set it to inactive
    try {

        $statement = $pdo->prepare("UPDATE exercise_day 
                                       SET status = 'inactive'
                                       WHERE exerciseDay = :exerciseDay AND exerciseType = :exerciseType And status = 'active';
                                       ");
        $statement->bindParam("exerciseDay", $exerciseDay);
        $statement->bindParam("exerciseType", $exerciseType);
        $statement->execute();
    } catch (PDOException $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
}

if (null !== (filter_input(INPUT_POST,"submitExerciseDay"))) {

    $exerciseName   = $_POST["exerciseName"];
    $weightOne      = $_POST["weight1"];
    $setOne         = $_POST["rep1"];
    $weightTwo      = $_POST["weight2"];
    $setTwo         = $_POST["rep2"];
    $weightThree    = $_POST["weight3"];
    $setThree       = $_POST["rep3"];
    $weightFour     = $_POST["weight4"];
    $setFour        = $_POST["rep4"];

    exerciseLogCreate($exerciseName, $weightOne, $setOne, $weightTwo, $setTwo, $weightThree, $setThree, $weightFour, $setFour, $pdo);


}
// $exerciseName, $weightOne, $setOne, $weightTwo, $setTwo, $weightThree, $setThree, $weightFour, $setFour


if (null !== filter_input(INPUT_POST, "submitExerciseForDay")) {
    // with the post variables now i need to set up the rest below
//    echo '<pre>Post:<br>';
//    var_dump($_POST);
//    echo '</pre><br>';

?>
    <style>
        #selectExerciseForDayContainer {display:none;}
    </style>
<?php


    echo '<pre>POST::<br><hr>';
    print_r($_POST);
    echo '</pre><br><hr>';

    // get post variables
    foreach ($_POST["exerciseSelect"] as $key => $value) {
        $exerciseType = $_POST["exerciseType"];
        $exerciseDay = $_POST["exerciseDay"];

        // selecting active exercises
        try {
            $statement = $pdo->prepare("
                                      SELECT * FROM exercise_day 
                                       WHERE status = 'active'
                                       AND exerciseType = :exerciseType And exerciseDay = :exerciseDay;
                                       ");
            $statement->bindParam("exerciseDay", $exerciseDay);
            $statement->bindParam("exerciseType", $exerciseType);
            $statement->execute();
            $active_exercise_Ar = $statement->fetchAll();



        } catch (PDOException $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }
//    echo '<pre>$active_exercise_Ar::<br><hr>';
//    print_r($active_exercise_Ar);
//    echo '</pre><br><hr>';
//
    if (!empty($active_exercise_Ar)) {
        foreach ($active_exercise_Ar as $activeExercise) {
            echo '<pre>$activeExercise::<br><hr>';
            print_r($activeExercise);
            echo '</pre><br><hr>';

            $exerciseDay = $activeExercise["exerciseDay"];
            $exerciseType = $activeExercise["exerciseType"];
            $exerciseStatus = $activeExercise["status"];

            // set active exercises to inactive here
            try {
                $statement = $pdo->prepare("UPDATE exercise_day 
                                       SET status = 'inactive'
                                       WHERE exerciseDay = :exerciseDay AND exerciseType = :exerciseType AND status = :status
                                       ");
                $statement->bindParam("exerciseDay", $exerciseDay);
                $statement->bindParam("exerciseType", $exerciseType);
                $statement->bindParam("status", $exerciseStatus);
                $statement->execute();
            } catch (PDOException $e) {
                echo 'Caught exception: ', $e->getMessage(), "\n";
            }

        }
    }



    // foreach loop here to loop through post variables and save order so that i can display proper sets
    foreach ($_POST["exerciseSelect"] as $key => $value) {


        $exerciseType = $_POST["exerciseType"];
        $exerciseDay = $_POST["exerciseDay"];
        $exerciseName = $value;
        $active = $_POST['active'][$key];


        if (!empty($_POST["exerciseSelect"])) {
//            echo $_POST["exerciseOrderNumber"][$key];
//            echo '<br>';
            $exerciseOrderNumber = $_POST["exerciseOrderNumber"][$key];
//            setInactive($exerciseDay, $exerciseType, $pdo);

            echo $exerciseOrderNumber;
        } else {
            $exerciseOrderNumber = '';
        }

        if($value == 'none') {
            $exerciseOrderNumber = '';
            $active = $_POST['active'][$key] = 'inactive';
            echo '<pre>active::<br>';
            var_dump($_POST['active']);
            echo '</pre><br>';
        }
//        setInactive($exerciseDay, $exerciseType, $pdo);
//        setInactiveToNone($exerciseDay, $exerciseType, $exerciseOrderNumber, $pdo);
        exerciseForDay($exerciseDay, $exerciseType, $exerciseName, $exerciseOrderNumber, $active, $pdo);
    }

}
exit();