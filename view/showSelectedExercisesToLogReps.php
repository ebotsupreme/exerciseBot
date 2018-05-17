<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once (__DIR__ . "/../config.php");
require_once(SITE_ROOT . "/./includes/header.php");
require_once (SITE_ROOT . "/./model/db_connection.php");
require_once (SITE_ROOT . "/./model/model.php");
$databaseConnect = new DatabaseConnect();
$pdo = $databaseConnect->getPdo();
//$getExerciseResult =  getAllExercises($exerciseName, $pdo);
//var_dump($getExerciseResult);
$exerciseDay = trim($_GET['exerciseDay']);
echo $exerciseDay;
$getList = getSelectedExerciseForTheWeekday($exerciseDay, $pdo);
//echo '<pre><br>';
//var_dump($getList);
//echo '</pre><br>';
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

<!--show exercises here from db-->
<form action="" method="post" id="">

</form>


