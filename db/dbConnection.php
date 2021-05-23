<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "db";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    mysqli_select_db($conn,'db') or die(mysqli_connect_error());
    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
 
   
   
    
    ?>