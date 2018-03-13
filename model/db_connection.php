<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "exercisor";

    try {
        $myPDO = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

        echo "Connected<p>";
    } catch (Exception $e) {
        echo "Unable to connect: " . $e->getMessage() . "<p>";
    }


