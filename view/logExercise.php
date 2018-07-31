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



// day comes from the options page h ref
$exerciseDay = trim($_GET['exerciseDay']);
echo $exerciseDay;

// pass the day from original link to this page to get active exercises for the day
$getList = getSelectedExerciseForTheWeekday($exerciseDay, $pdo);
//echo '<pre><br>';
//print_r($getList);
//echo '</pre><br>';

//$exerciseConnect = new Exercise($pdo);
//$exercise_select_Ar = $exerciseConnect->exercise_select();
//echo '<pre>result<br>';
//print_r($exercise_select_Ar);
//echo '</pre><br>';


function queryExerciseSelect()
{
    global $pdo;
    // selecting active exercises
    try {
        $statement = $pdo->prepare("SELECT exerciseName FROM exercise_select");
        $statement->execute();
        $exerciseSelect_Ar2 = $statement->fetchAll();

        return $exerciseSelect_Ar2;
    } catch (PDOException $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
        echo '<pre><br>';
        print_r($e);
        echo '</pre><br>';
    }
}

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

<br>

<form action="../controller/controller.php" method="post" name="exerciseForm">
    <!-- Drop down of exercise here that will trigger table below -->
    <select name="selectLogExercise" id="selectLogExercise">
        <option value="">--Select an exercise to log--</option>
        <?php



        // loop through getList ar and select active exercises for this day
        foreach ($getList as $activeExercises) {

            $activeExerciseName = $activeExercises["exerciseName"];
            $exerciseID = $activeExercises["id"];


            // do a query to exerciseSelect table to grab all available exercises.
            $res = queryExerciseSelect();
            echo '<pre><br>';
            print_r($res);
            echo '</pre><br>';

            $exerciseResult = $res[0]["exerciseName"];

            // then do an if test here to compare the exercise name from that query to the $exerciseName here.
            if ($exerciseResult == $activeExerciseName) {

                // if true, mark as selected. else leave selected as blank.
        ?>
            <option id="<?= $exerciseID ?>" value="<?= $activeExerciseName ?>" selected="selected"><?= $activeExerciseName ?></option>
        <?php
            } else {
                ?>
                <option id="<?= $exerciseID ?>" value="<?= $activeExerciseName ?>" selected=""><?= $activeExerciseName ?></option>
                <?php
            }
        }

        //todo: need to do ajax call. When exercise is selected, bring correct form out
        ?>

    </select>
    <input type="hidden" name="exerciseName" value="<?= $activeExerciseName ?>">
    <div style="font-weight: 600;">Set 1:</div>
    <div style="display: inline-block;">
        <label for="weight1">Weight: </label>
        <input type="number" name="weight1" value="" placeholder="Weight 1">
    </div>
    <div style="display: inline-block;">
        <label for="rep1">Rep: </label>
        <input type="number" name="rep1" value="" placeholder="Rep 1">
    </div>
    <br><br>
    <div style="font-weight: 600;">Set 2:</div>
    <div style="display: inline-block;">
        <label for="weight2">Weight: </label>
        <input type="number" name="weight2" value="" placeholder="Weight 2">
    </div>
    <div style="display: inline-block;">
        <label for="rep2">Rep: </label>
        <input type="number" name="rep2" value="" placeholder="Rep 2">
    </div>
    <br><br>
    <div style="font-weight: 600;">Set 3:</div>
    <div style="display: inline-block;">
        <label for="weight3">Weight: </label>
        <input type="number" name="weight3" value="" placeholder="Weight 3">
    </div>
    <div style="display: inline-block;">
        <label for="rep3">Rep: </label>
        <input type="number" name="rep3" value="" placeholder="Rep 3">
    </div>
    <br><br>
    <div style="font-weight: 600;">Set 4:</div>
    <div style="display: inline-block;">
        <label for="weight4">Weight: </label>
        <input type="number" name="weight4" value="" placeholder="Weight 4">
    </div>
    <div style="display: inline-block;">
        <label for="rep4">Rep: </label>
        <input type="number" name="rep4" value="" placeholder="Rep 4">
    </div>
    <br><br>
    <input type="submit" value="Submit" name="submitExerciseDay">
</form>

<?php

?>
<!----       May do this in another page          ----->
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

    // this brings up all exercises for 1 type of exercise
echo '<br>';
echo 'exercise name is: ';
echo $activeExerciseName;
echo '<br>';
    $getExerciseResult =  getAllExercises($activeExerciseName, $pdo);

        foreach ($getExerciseResult as $result) {
            echo '<pre><br>';
            print_r($result);
            echo '</pre><br>';
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
<!------     End May do this in another page -------->

<br>
