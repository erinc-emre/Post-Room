<!DOCTYPE html>
<head>
<title>Join A Room</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>

<body>
<form method="POST" enctype="multipart/form-data">
<br>
                <label class="form-label" for="roomName">Sharable Code</label><br>
                <br>
                <input style="width: 400px;" type="text" class="form-control" name="code" placehoder ="Name of the Room"><br>
               <br>
                <button class="main-btn newroom-btn" name="submit" type="submit">JOIN</button>
            </form>


<?php 
include('dbConnection.php');
session_start();


if (isset($_POST['submit'])) {
    if (empty($_POST["code"])) {
    echo "Error";
    } else {
      $code = $_POST["code"];
    } 
    $sql_code = "SELECT * FROM room WHERE sharebleCode ='$code' ";
    $result_code = mysqli_query($conn, $sql_code);
    $rows_code = mysqli_fetch_assoc($result_code);
    $roomId = $rows_code['roomId'];
    $role = "Member";
    date_default_timezone_set('Europe/Istanbul');
    $date = date("Y-m-d h:i:sa");
    $userId = $_SESSION['loginId'];



    $stmt = $conn->prepare("INSERT INTO registration (roomId,userId,role,registrationDate) VALUES (?,?,?,?)");
    if ($stmt != false ) {
        $stmt->bind_param('ssss',$roomId,$userId,$role ,$date);
        if($stmt->execute()){
          ?> <p class="success"><?php echo "added" ?></p> <?php
       }else{
          ?> <p class="fail"><?php echo "failed"; ?></p> <?php
       }
        $stmt->close();
      } else {
        die('prepare() failed: ' . htmlspecialchars($conn->error));
      }
}
    
    
    ?>
</body>
            </html>