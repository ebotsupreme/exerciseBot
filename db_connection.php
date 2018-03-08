<?php

function OpenCon()
{
//    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db     = "excerice_generator";

//    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn->error);

    $myPDO = new PDO("mysql:host=localhost;dbname=" . $db, $dbuser, $dbpass);

    return $myPDO;
}

//function CloseCon($myPDO)
//{
//    $myPDO->close();
//}