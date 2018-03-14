<?php

class DatabaseConnect {

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "exercisor";

    private $myPDO = null;

    public function getPdo()
    {
        return $this->myPDO;
    }

    public function __construct()
    {
        try {
            $this->myPDO = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

            echo "Connected<p>";
        } catch (Exception $e) {
            echo "Unable to connect: " . $e->getMessage() . "<p>";
        }
    }

}




