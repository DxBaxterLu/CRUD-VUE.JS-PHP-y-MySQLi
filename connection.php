<?php
    $conn = new mysqli("localhost","root","","crud_vue");
    if($conn->connect_error){
        die("Connection failed!".$conn->connect_error);
    }
    echo("success");
?>