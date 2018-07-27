<?php

class Exercise {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function exercise_select()
    {
        try {
            $statement = $this->pdo->prepare("SELECT exerciseName 
                                        FROM exercise_select");
            $exercise_select_Ar = $statement->fetchAll();
            return $exercise_select_Ar;
        } catch (PDOException $e) {
            echo 'Caught exception: ' . $e->getMessage();
        }
    }


}