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
$getExerciseName = "";


?>
<div>Select your exercises for <?= $day ?>:</div>
<br>

<form action="../controller/controller.php" method="post" name="selectExercisesForTheDayForm">
    <?php

    $count = 1;
    do {
        ?>


        <!--     will need to do a loop here-->
        <!--    This needs to be another drop down select option-->
        <input type="hidden" value="legs" name="exerciseType">


        <label for="Exercise Select" style="display:inline-block">
            Select Exercise <?= $count ?>:
        </label>
        <?php
        $count ++;
        ?>


        <select name="" id="populateExercises">
            <option value=""></option>
        </select>

    <select name="exerciseSelect" id="">
        <option value="">--Select--</option>
        <?php
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

            <option id="<?= $exerciseId ?>" name="<?= $exerciseName ?>" value="<?= $exerciseName ?>" <?= $selected ?>><?= $exerciseName ?></option>
            <?php
        }
        ?>
    </select>
    <input type="hidden" value="<?= $count ?>" name="exerciseOrderNumber">
    <?php

    } while ($count <= 5);

    ?>

    <!--  I could pass the day value through the url when user selects day to here  -->
    <input type="hidden" value="<?= $day ?>" name="exerciseDay">


<!--    Ill need to change the controller after all the above are completed or possibly make a new input filter action in the controller-->
    <input type="submit" value="Submit" name="submitExerciseForDay">
</form>

<script>
    // Ajax call to show exercise type selection.
    // This will populate the exercise options to choose from.
    function showExerciseType(str)
    {
        if (str == "") {
            document.getElementById("populateExercises").innerHTML = "";
            return;
        } else {
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("populateExercises").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getExerciseType.php?q="+str,true);
            xmlhttp.send();
        }
    }
</script>