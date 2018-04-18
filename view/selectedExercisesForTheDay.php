<?php
session_start();
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

//echo "getExercisesForDay :<pre><br>";
//print_r($getExercisesForDay);
//echo "</pre><br>";

$day ="Monday";
$getExerciseName = "";

//print_r($exerciseTypeResultAr);



?>

<script>
//   var siteRoot = <?//= SITE_ROOT ?>//;
</script>

<div>Select your exercises for <?= $day ?>:</div>
<br>

<form action="../controller/controller.php" method="post" name="selectExercisesForTheDayForm">



    <select name="exerciseType" onchange="showExerciseType(this.value)" style="display:block;">
        <option value="" selected >--Select exercise type--</option>
        <option value="legs">legs</option>
        <option value="chest">chest</option>
        <option value="arms">arms</option>
        <option value="shoulder">shoulder</option>
        <option value="back">back</option>
    </select>

    <br>

    <?php
    $count = 1;
    do {
    ?>
    <script>var count = <?= $count ?></script>

    <label for="Exercise Select" style="display:inline-block">
        Select Exercise <?= $count ?>:
    </label>

    <select name="exerciseSelect<?= $count ?>" id="txtHint_<?= $count ?>">
        <option value="" selected="selected">--Select--</option>
    </select>

    <br>
    <br>

    <input type="hidden" value="<?= $count ?>" name="exerciseOrderNumber<?= $count ?>">
    <?php
    $count ++;

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
        if (str === "") {
            document.getElementById("txtHint_1").innerHTML = "";
            document.getElementById("txtHint_2").innerHTML = "";
            document.getElementById("txtHint_3").innerHTML = "";
            document.getElementById("txtHint_4").innerHTML = "";
            document.getElementById("txtHint_5").innerHTML = "";
            return true;
        } else {
//            var display = document.getElementById("txtHint");
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "../controller/typeController.php?query=" + str, true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send();

            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState === 4 && this.status === 200) {

                        document.getElementById("txtHint_1").innerHTML = this.responseText;
                        document.getElementById("txtHint_2").innerHTML = this.responseText;
                        document.getElementById("txtHint_3").innerHTML = this.responseText;
                        document.getElementById("txtHint_4").innerHTML = this.responseText;
                        document.getElementById("txtHint_5").innerHTML = this.responseText;
                        // adding count to txthint and trying to loop but not working


                } else {
                    document.getElementById("txtHint_1").innerHTML = "Something went wrong...";
                    document.getElementById("txtHint_2").innerHTML = "Something went wrong...";
                    document.getElementById("txtHint_3").innerHTML = "Something went wrong...";
                    document.getElementById("txtHint_4").innerHTML = "Something went wrong...";
                    document.getElementById("txtHint_5").innerHTML = "Something went wrong...";
                }
            };
        }
    }
</script>