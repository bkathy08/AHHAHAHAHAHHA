<?php
    //Establish a connection to the database
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "kath_db";

    //COMBINE ALL VARIABLES TO CONNECT THE DATABASE
    $conn = new mysqli($host, $user, $pass, $dbname);

    //CHECK IF CONNECTION IS FAILED
    if($conn->connect_error)
    {
        die("Connection failed: ". $conn->connect_error);
    }

?>