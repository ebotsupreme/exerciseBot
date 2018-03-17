<?php

class DatabaseConnect {

    private $host;
    private $user;
    private $pass;
    private $db;

    private $myPDO = null;

    public function getPdo()
    {
        return $this->myPDO;
    }

    public function __construct()
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->db = "exercisor";
        try {
            $this->myPDO = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);

            echo "Connected<p>";
        } catch (PDOException $e) {
            echo "Unable to connect: " . $e->getMessage() . "<p>";
        }

    }

}




