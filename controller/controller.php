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
//    echo '<pre>Post:<br>';
//    var_dump($_POST);
//    echo '</pre><br>';

?>
    <style>
        #selectExerciseForDayContainer {display:none;}
    </style>
<?php
    // foreach loop here to loop through post variables and save order so that i can display proper sets

    foreach ($_POST["exerciseSelect"] as $key => $value) {
//        echo '<pre>exerciseSelect:<br>';
//        var_dump($_POST);
//        echo '</pre><br>';
        $exerciseType = $_POST["exerciseType"];
        $exerciseDay = $_POST["exerciseDay"];
        $exerciseName = $value;

//        echo '<pre>Order Numb:<br>';
//        var_dump($_POST["exerciseOrderNumber"]);
//        echo '</pre><br>';
//        echo 'value:';
//echo $value;

        if (!empty($_POST["exerciseSelect"])) {
//            echo $_POST["exerciseOrderNumber"][$key];
//            echo '<br>';
            $exerciseOrderNumber = $_POST["exerciseOrderNumber"][$key];

        } elseif($value == 'none') {

            $exerciseOrderNumber = '';
        } else {
            $exerciseOrderNumber = '';
        }
        setInactive($exerciseDay, $exerciseType, $exerciseName, $exerciseOrderNumber, $pdo);
//        setInactiveToNone($exerciseDay, $exerciseType, $exerciseName, $exerciseOrderNumber, $pdo);
//        exerciseForDay($exerciseDay, $exerciseType, $exerciseName, $exerciseOrderNumber, $pdo);
    }

}
exit();