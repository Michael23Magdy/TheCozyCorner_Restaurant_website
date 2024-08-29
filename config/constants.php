<?php
    session_start();

    
    const LOCALHOST = "localhost";
    const DB_USERNAME = "root";  
    const DB_PASSWORD = "";      
    const DB_NAME = "thecozycorner";  
    const SITE_URL = "http://localhost/TheCozyCorner/";

    // Create a connection
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
?>