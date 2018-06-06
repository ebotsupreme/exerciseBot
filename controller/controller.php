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
//    echo '<pre>Post:<br>';
//    var_dump($_POST);
//    echo '</pre><br>';

?>
    <style>
        #selectExerciseForDayContainer {display:none;}
    </style>
<?php

    try {
        $statement = $pdo->prepare("
                                      SELECT * FROM exercise_day 
                                       WHERE status = 'active'
                                       AND exerciseType = :exerciseType And exerciseDay = :exerciseDay;
                                       ");
        $statement->bindParam("exerciseDay", $exerciseDay);
        $statement->bindParam("exerciseType", $exerciseType);
        $active_exercise_Ar = $statement->fetchAll();

        echo '<pre>$active_exercise_Ar::<br><hr>';
        print_r($active_exercise_Ar);
        echo '</pre><br><hr>';

    } catch (PDOException $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }

    // foreach loop here to loop through post variables and save order so that i can display proper sets
    foreach ($_POST["exerciseSelect"] as $key => $value) {

        // check to see if there are active exercises set previously


//        echo '<pre>$active_exercise_Ar::<br><hr>';
//        print_r($active_exercise_Ar);
//        echo '</pre><br><hr>';

        echo '<pre>exerciseSelect:<br>';
        var_dump($_POST);
        echo '</pre><br>';
        $exerciseType = $_POST["exerciseType"];
        $exerciseDay = $_POST["exerciseDay"];
        $exerciseName = $value;
        $active = $_POST['active'][$key];
//        echo '<pre>Order Numb:<br>';
//        var_dump($_POST["exerciseOrderNumber"]);
//        echo '</pre><br>';
        echo '<br>';
        echo 'value: ';
        echo $value;
        echo '<br>';


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
//        exerciseForDay($exerciseDay, $exerciseType, $exerciseName, $exerciseOrderNumber, $active, $pdo);
    }

}
exit();