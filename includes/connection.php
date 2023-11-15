<?php 
    $con = mysqli_connect(host: "localhost", user: "root", password: "", database: "Assignment-Website");

    if(!$con) {
        echo "Connection Failed!";
        exit();
    }