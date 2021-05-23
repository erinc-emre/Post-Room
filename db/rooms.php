<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widt=device-width, inital-scale=1.0">
    <title> Create New Room </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<style>
<?php include "room.css" ?>
    </style>
</head>
<body>  

    <section class="main">
        <nav>
        <a href="#" class="logo">
            <img src="images/logo1.png"/>
            </a>
          
        </nav> 
        <div class="main-heading">
            <h1>Your Rooms</h1>
   
            </div>

    </section>
</body>


<?php

include('dbConnection.php');


$query = "SELECT * FROM room";
$result = mysqli_query($conn, $query); ?>
<div class="card-deck">
  <?php
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
      ?>

<div class="card" style="">
<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['roomPhoto']) . '" style="height:200px;width:200px;" id="image"/>'; ?>
      <div class="card-body">
        <h5 class="card-title"><a href="contentsOfaRoom.php?roomId=<?php echo $row['roomId']; ?>"><?php echo $row['roomName'] ?></a></h5>
    
      </div>


 
      <?php
}
} else {
  echo "0 results";
}

mysqli_close($conn);
?>
</div>
