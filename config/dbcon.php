<?php

    $host = 'localhost';
    $username ='root';
    $password = '';
    $database = 'db_aab';  

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