<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once (__DIR__ . "/../config.php");
require_once(SITE_ROOT . "/./includes/header.php");
require_once (SITE_ROOT . "/./model/db_connection.php");
require_once (SITE_ROOT . "/./model/model.php");
require_once (SITE_ROOT . "/./classes/Exercise.php");
$databaseConnect = new DatabaseConnect();
$pdo = $databaseConnect->getPdo();

// this brings up all exercises for 1 type of exercise
$exerciseName = "Squats";
$getExerciseResult =  getAllExercises($exerciseName, $pdo);

// day comes from the options page h ref
$exerciseDay = trim($_GET['exerciseDay']);
echo $exerciseDay;

// pass the day from original link to this page to get active exercises for the day
$getList = getSelectedExerciseForTheWeekday($exerciseDay, $pdo);
//echo '<pre><br>';
//print_r($getList);
//echo '</pre><br>';
var_dump($pdo);
$exerciseConnect = new Exercise($pdo);
var_dump($exerciseConnect);
$result = $exerciseConnect->exercise_select();

echo '<pre>result<br>';
print_r($result);
echo '</pre><br>';

foreach ($getList as $activeExercises) {
    echo '<pre><br>';
    print_r($activeExercises);
    echo '</pre><br>';
}

?>
<style>
    th{
        width: 10%;
    }
    #selectExerciseForDayContainer {
        display: none;
    }
</style>
<div>
    Select your exercise to log:
</div>

<!-- Drop down of exercise here that will trigger table below -->
<select name="selectLogExercise" id="selectLogExercise">
    <?php



    // loop through getList ar and select active exercises for this day
    foreach ($getList as $activeExercises) {

        $exerciseName = $activeExercises["exerciseName"];
        $exerciseID = $activeExercises["id"];

        // here to do //
        // do a query to exerciseSelect table to grab all available exercises.
        // then do an if test here to compare the exercis name from that query to the $exerciseName here.
        // if true, mark as selected. else leave selected as blank.

    ?>
        <option id="<?= $exerciseID ?>" value="<?= $exerciseName ?>"><?= $exerciseName ?></option>
    <?php

    }
    ?>


</select>

<!-- This table will show your exercise history depending on what you pick -->
<table>
    <tr>
        <th>Date</th>
        <th>Exercise Name</th>
        <th>Weight One</th>
        <th>Rep One</th>
        <th>Weight Two</th>
        <th>Rep Two</th>
        <th>Weight Three</th>
        <th>Rep Three</th>
        <th>Weight Four</th>
        <th>Rep Four</th>
    </tr>
    <?php
        foreach ($getExerciseResult as $result) {
    ?>
    <tr>
        <td><?= date("n/j/Y" ,strtotime($result["dateCreated"])); ?></td>
        <td><?= $result["exerciseName"]; ?></td>
        <td><?= $result["WeightOne"]; ?></td>
        <td><?= $result["SetOne"]; ?></td>
        <td><?= $result["WeightTwo"]; ?></td>
        <td><?= $result["SetTwo"]; ?></td>
        <td><?= $result["WeightThree"]; ?></td>
        <td><?= $result["SetThree"]; ?></td>
        <td><?= $result["WeightFour"]; ?></td>
        <td><?= $result["SetFour"]; ?></td>
    </tr>
    <?php
        }
    ?>
</table>


<br>
<form action="../controller/controller.php" method="post" name="exerciseForm">
    <input type="hidden" name="squats" value="Squats">
    <div style="font-weight: 600;">Set 1:</div>
    <div style="display: inline-block;">
        <label for="squatWeight1">Weight: </label>
        <input type="number" name="squatWeight1" value="" placeholder="Weight 1">
    </div>
    <div style="display: inline-block;">
        <label for="squatRep1">Rep: </label>
        <input type="number" name="squatRep1" value="" placeholder="Rep 1">
    </div>
    <br><br>
    <div style="font-weight: 600;">Set 2:</div>
    <div style="display: inline-block;">
        <label for="squatWeight2">Weight: </label>
        <input type="number" name="squatWeight2" value="" placeholder="Weight 2">
    </div>
    <div style="display: inline-block;">
        <label for="squatRep2">Rep: </label>
        <input type="number" name="squatRep2" value="" placeholder="Rep 2">
    </div>
    <br><br>
    <div style="font-weight: 600;">Set 3:</div>
    <div style="display: inline-block;">
        <label for="squatWeight3">Weight: </label>
        <input type="number" name="squatWeight3" value="" placeholder="Weight 3">
    </div>
    <div style="display: inline-block;">
        <label for="squatRep3">Rep: </label>
        <input type="number" name="squatRep3" value="" placeholder="Rep 3">
    </div>
    <br><br>
    <div style="font-weight: 600;">Set 4:</div>
    <div style="display: inline-block;">
        <label for="squatWeight4">Weight: </label>
        <input type="number" name="squatWeight4" value="" placeholder="Weight 4">
    </div>
    <div style="display: inline-block;">
        <label for="squatRep4">Rep: </label>
        <input type="number" name="squatRep4" value="" placeholder="Rep 4">
    </div>
    <br><br>
    <input type="submit" value="Submit" name="submitExerciseDay">
</form>