<?php
    $dsn="mysql:dbname=niveau;host=localhost";
    $password = "";
    $user = "root";

    $connect = new PDO($dsn,$user,$password,[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ]);

    if (!$connect) 
    {
        return new \Exception("Database cannot connect");
    }
    else
    {   
        return $connect;
    }
?>