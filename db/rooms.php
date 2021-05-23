<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widt=device-width, inital-scale=1.0">
    <title> Create New Room </title>


    
</head>
<body>  
    <section class="main">
        <nav>
        <a href="#" class="logo">
            <img src="images/logo1.png"/>
            </a>
            
            <ul class="menu">
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#" >Account Settings</a></li>
                <li><a href="#" >Exit</a></li>
            </ul>
        </nav> 
        <div class="main-heading">
            <h1>Your Rooms</h1>
   
            </div>

    </section>
</body>









<?php

include('dbConnection.php');


$query = "SELECT roomName FROM room";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "id: " . $row["roomName"]. "<br>";
}
} else {
  echo "0 results";
}

mysqli_close($conn);
?>