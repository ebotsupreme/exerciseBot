<?php

require_once("../includes/header.php");
require_once("../model/db_connection.php");

$exerciseName = "Squats";
try {
    $statement = $myPDO->prepare("SELECT * 
                                            FROM exercises
                                            WHERE exerciseName = :exerciseName");
    $statement->bindParam("exerciseName", $exerciseName);
    $statement->execute();
    $exercise_Ar = $statement->fetchAll();

    echo "<pre><br>";
    print_r($exercise_Ar);
    echo "</pre><br>";
} catch (Exception $e) {
    $dbError = $e->getMessage();
}

//// Insert exercise data into DB
try{
    $statement = $myPDO->prepare("INSERT INTO exercises (dateCreated, exerciseName, WeightOne, SetOne, WeightTwo, SetTwo, WeightThree, SetThree, WeightFour, SetFour)
                                     VALUES (:dateCreated, :exerciseName, :WeightOne, :SetOne, :WeightTwo, :SetTwo, :WeightThree, :SetThree, :WeightFour, :SetFour)
                                     ");
    $statement->bindParam("exerciseName", $exerciseName);
    $statement->bindParam("WeightOne", $weightOne);
    $statement->bindParam("SetOne", $setOne);
    $statement->bindParam("WeightTwo", $weightTwo);
    $statement->bindParam("SetTwo", $setTwo);
    $statement->bindParam("WeightThree", $weightThree);
    $statement->bindParam("SetThree", $setThree);
    $statement->bindParam("WeightFour", $weightFour);
    $statement->bindParam("SetFour", $setFour);
    $statement->execute();

} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
}



?>

<!--4 exercises per day-->

<div>Leg Day</div>
<br>
<div>E1 - Squats</div>
<br>
<form action="../calls.php" method="post" name="enterSquats">
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
    <input type="submit" value="Submit" name="submitSquats">
</form>