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

//$exerciseName = "Squats";

$getExercisesForDay = selectExercisesForDay($pdo);

echo "getExercisesForDay :<pre><br>";
print_r($getExercisesForDay);
echo "</pre><br>";

$day ="Monday";

?>
<div>Select your exercises for <?= $day ?>:</div>
<br>

<form action="../controller/controller.php" method="post" name="selectExercisesForTheDayForm">
    <label for="Exercise Select" style="display:inline-block">Select Exercise 1:</label>
    <select name="exerciseSelect" id="">
        <?php

        $getExerciseName = "";

        foreach($getExercisesForDay as $value) {
            $exerciseName = $value["exerciseName"];
            $exerciseId = $value["id"];
            $exerciseNumberValue = $value["exerciseNumberValue"];


            echo "value var:<pre><br>";
            print_r($value);
            echo "</pre><br>";

            $selected = $exerciseId == $exerciseNumberValue? 'selected' : '';
//            echo "<option value='1' $selected>1</option>";

            ?>
            <option value="<?= $exerciseId ?>" name="<?= $exerciseName ?>" <?= $selected ?>><?= $exerciseName ?></option>
            <?php
        }
        ?>
    </select>

    <!--     will need to do a loop here-->
    <input type="hidden" value="exerciseOrderOne" name="exerciseOrderNumber">
    <input type="hidden" value="monday" name="exerciseDay ">
    <!--     end loop here-->

    <input type="hidden" value="legs" name="exerciseType ">
    <input type="submit" value="Submit" name="submitExerciseForDay">
</form>