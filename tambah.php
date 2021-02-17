<?php

    //Variabel database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_sensor";

    $conn = mysqli_connect("$servername", "$username", "$password","$dbname");

    // Prepare the SQL statement
    
    $result = mysqli_query ($conn,"INSERT INTO tbl_sensor(berat) VALUES ('".$_GET["berat"]."')");    
    
    if (!$result) 
        {
            die ('Invalid query: '.mysqli_error($conn));
        }  
?>