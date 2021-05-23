<?php

include('dbConnection.php');


$date = date('Y-m-d H:i:s');
$roomName = $_POST['roomName'];
$description = $_POST['description'];


$query = "INSERT INTO room (roomName,description,launchDate,isArchived,roomPhoto) VALUES ('$roomName','$description','$date','0','$roomPhoto')";


mysqli_query($conn,$query);

echo "Room is Created!"

?>