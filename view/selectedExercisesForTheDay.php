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
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->

<script>
//   var siteRoot = <?//= SITE_ROOT ?>//;
</script>

<div>Select your exercises for <?= $day ?>:</div>
<br>

<form action="../controller/controller.php" method="post" name="selectExercisesForTheDayForm">


    <!--     will need to do a loop here-->
    <!--    This needs to be another drop down select option-->
    <!--        <input type="hidden" value="legs" name="exerciseType">-->
    <select name="exerciseType" onchange="showExerciseType(this.value)">
        <option value="" selected >--Select exercise type--</option>
        <option value="legs">legs</option>
        <option value="chest">chest</option>
        <option value="arms">arms</option>
        <option value="shoulder">shoulder</option>
        <option value="back">back</option>
    </select>

    <!--        Temporary storage for types-->
<!--    <select name="" id="populateExercises">-->
<!--        <option value="" selected>--Select exercise--</option>-->
<!--        <option value=""></option>-->
<!--    </select>-->

    <select name="exerciseSelect" id="txtHint">
        <option value="">--Select--</option>

    </select>

<!--    <div id="txtHint">-->
<!---->
<!--    </div>-->
    <br>
    <br>
    <br>
    <br>
    <br>


    <!--  I could pass the day value through the url when user selects day to here  -->
    <input type="hidden" value="<?= $day ?>" name="exerciseDay">


<!--    Ill need to change the controller after all the above are completed or possibly make a new input filter action in the controller-->
    <input type="submit" value="Submit" name="submitExerciseForDay">
</form>

<script>
    // Ajax call to show exercise type selection.
    // This will populate the exercise options to choose from.
    function showExerciseType(str) {
//        var xmlhttp = '';
//        if (str == "") {
//            document.getElementById("txtHint").innerHTML = "";
//            return;
//        } else {
//
//            if (window.XMLHttpRequest) {
//                xmlhttp = new XMLHttpRequest();
//
//            } else {
//                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//
//            }
//            xmlhttp.onreadystatechange = function ()
//            {
//                if (this.readyState == 4 && this.status == 200) {
//
//                    console.log(this.responseText);
////                    throw new Error("my error message");
//
//                    document.getElementById("txtHint").innerHTML = this.responseText;
//
//                }
//            };
//
//            xmlhttp.open("GET", "../controller/typeController.php?query="+str+"&format=fragment",true);
//            xmlhttp.send();
//        }

        if (str === "") {
            document.getElementById("txtHint").innerHTML = "";
            return true;
        } else {
            var display = document.getElementById("txtHint");
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.open("GET", "../controller/typeController.php?query=" + str, true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send();

            xmlhttp.onreadystatechange = function ()
            {
                if (this.readyState === 4 && this.status === 200) {

                    document.getElementById("txtHint").innerHTML = this.responseText;

                } else {
                    display.innerHTML = "Something went wrong...";
                }
            };
        }
    }
</script>