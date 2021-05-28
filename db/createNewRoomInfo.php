<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widt=device-width, inital-scale=1.0">
    <title> Create New Room </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>
<body>  
<?php

include('dbConnection.php');
session_start();

if (isset($_POST['submit']) && $_FILES['fileName']['size'] > 0) {
    $fileName = $_FILES['fileName']['name'];
    $picture = file_get_contents($fileName);
    if (empty($_POST["roomName"])) {
    
    } else {
      $roomName = $_POST["roomName"];
    }
    if (empty($_POST["description"])) {
    
    } else {
      $desc = $_POST["description"];
    }
   
    date_default_timezone_set('Europe/Istanbul');
    $date = date("Y-m-d h:i:sa");
    function getRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
    
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
    
        return $string;
    }
$isArchived= 0;
$sharableCode=getRandomString();

    $stmt = $conn->prepare("INSERT INTO room (roomName,description,launchDate,isArchived,sharebleCode,roomPhoto) VALUES (?,?,?,?,?,?)");
    if ($stmt != false ) {
        $stmt->bind_param('ssssss',$roomName,$desc,$date,$isArchived,$sharableCode,$picture);
        if($stmt->execute()){
          ?> <p class="success"><?php echo "added." ?></p> <?php
       }else{
          ?> <p class="fail"><?php echo " failed"; ?></p> <?php
       }
        $stmt->close();
      } else {
        die('prepare() failed: ' . htmlspecialchars($conn->error));
      }
    }

?>
    <section class="main">
        <nav>
        <a href="#" class="logo">
            <img style="width: 100px;height:100px;" src="images/logo1.png"/>
            </a>
        
        </nav> 
        <div class="main-heading">
            <h1 style="color:blue">Create New Room</h1><br>
            <form method="POST" enctype="multipart/form-data">
                <label class="form-label" for="roomName">Room Name</label><br>
                <input style="width: 400px;" type="text" class="form-control" name="roomName" placehoder ="Name of the Room"><br>
                <label class="form-label" for="descripton">Description</label><br>
                <textarea style="width: 400px;" class="form-control" name="description" placehoder ="Description of the Room"></textarea><br>
                <input type="file" id="myFile" name="fileName"><br><br>
                <button class="main-btn newroom-btn" name="submit" type="submit">Create</button>
            </form>
            </div>

    </section>


 </body>
 </html>