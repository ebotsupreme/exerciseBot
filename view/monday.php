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

$exerciseName = "Squats";

$getExercisesForDay = selectExercisesForDay($pdo);
$day ="Monday";

foreach($getExercisesForDay as $key => $value) {
    echo "<pre><br>";
    print_r($value);
    echo "</pre><br>";
}
?>

<style>
    th {
        width: 10%;
    }
</style>

<!--4 exercises per day-->



<div>Select your exercises for <?= $day ?>:</div>
<br>

<form action="../controller/controller.php" method="post" name="selectExercisesForTheDayForm">
    <label for="Exercise Select" style="display:inline-block">Select Exercise 1:</label>
    <select name="exerciseSelect" id="">
        <?php

            $getExerciseName = "";

            foreach($getExercisesForDay as $key => $value) {
                $exerciseName = $value["exerciseName"];

                ?>
                <option value="<?= $exerciseName ?>[<?= $key?>]" name="<?= $exerciseName ?>"><?= $exerciseName ?></option>
                <?php
            }
        ?>
    </select>

    // will need to do a loop here
    <input type="hidden" value="exerciseOrderOne" name="exerciseOrderNumber">
    <input type="hidden" value="monday" name="exerciseDay ">
    // end loop here

    <input type="hidden" value="legs" name="exerciseType ">
    <input type="submit" value="Submit" name="submitExerciseForDay">
</form>



<?php


$getExerciseResult =  getAllExercises($exerciseName, $pdo);
//var_dump($getExerciseResult);

echo "<pre><br>";
print_r($getExerciseResult);
echo "</pre><br>";

?>
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
