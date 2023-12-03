<?php
    
    //connect to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "faccount";

    $conn = new mysqli($servername, $username, $password, $dbname);

    //check connection
    if($conn->connect_error) {
        die("Connection failed: ");
    }
    else{
        echo'';
    }