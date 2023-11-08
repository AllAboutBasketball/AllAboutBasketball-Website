<?php

    $host = 'localhost';
    $username ='u992665783_aabofficial';
    $password = 'oATnan?3$';
    $database = 'u992665783_aab';  

    $con = mysqli_connect($host, $username, $password, $database);

    if(!$con)
    {
        die("Connection Failed: " .mysqli_connect_error());
    }
    else
    {
       // echo "Connected Successfully";
    }
?>