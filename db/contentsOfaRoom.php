<?php include('dbConnection.php'); 
session_start();
 ?>
<!DOCTYPE html>
<?php 
//$id = intval($_GET['roomId']);
$result=mysqli_query($conn,"SELECT * FROM content");
$rows=mysqli_fetch_assoc($result);
$roomID = $rows['roomId'];
$result3 = mysqli_query($conn,"SELECT * FROM room WHERE roomId = $roomID");
$rows3=mysqli_fetch_assoc($result3);
?>
<head> 
<style>
<?php include "contentsOfaRoom.css" ?>
</style>
<title><?php echo $rows3['roomName'] ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
<ul class="nav nav-tabs">

<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#"><?php echo $rows3['roomName'] ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="descriptionOfRoom.php">Description of the room</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="addAnAssign.php">Add a new assignment</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="addApost.php">Add a new post</a>
  </li>
  </ul>
<?php 
$commentOwnerId= 1;

if (isset($_POST['submit']) ) {
  if (empty($_POST["comment"])) {
     echo "null comment";
  } else {
    $comment = $_POST["comment"];
  }
  date_default_timezone_set('Europe/Istanbul');
  $commentDate = date("Y-m-d h:i:sa");
  
  $stmt = $conn->prepare("INSERT INTO comment(postId,commentOwnerId,commentText,commentDate) VALUES (?,?,?,?)");
  
  if ($stmt != false ) {
    if($password != ""){
    $stmt->bind_param('ssss',$postId,$commentOwnerId,$comment,$commentDate);
    if($stmt->execute()){
      ?> <p class="success"><?php echo "added." ?></p> <?php
   }else{
      ?> <p class="fail"><?php echo "Registiration failed"; ?></p> <?php
   }
    $stmt->close();
  }} else {
    die('prepare() failed: ' . htmlspecialchars($conn->error));
  }
}
$myId = 1;
$result=mysqli_query($conn,"SELECT * FROM content");

while($rows=mysqli_fetch_assoc($result)){
?>

<br><br>

  <div class="card">
  <?php
  if($rows['postOwnerId']== $myId ){ ?>
    <a href="deletePost.php?contentId=<?php echo $rows['contentId']; ?>" class="btn btn-secondary">Delete</a>
    <?php
  }
  ?>
  <div class="card-header">
  <a href="#" >
  <?php  echo $rows['contentTitle']; ?> </a> - 
<?php if($rows['typeId'] == 0) { echo "Assignment";}
else if($rows['typeId'] == 1) {echo "Post";} ?> - <?php echo $rows['publishedDate'] ?> <?php
$postOwnerId = $rows['postOwnerId'];
?>
  </div>
 <?php $result2=mysqli_query($conn,"SELECT * FROM user WHERE userId = $postOwnerId"); 
    while($rows2 = mysqli_fetch_assoc($result2)){
   
 ?>
  <div class="card-title"><?php echo $rows2['fName']?><?php echo " "?><?php echo $rows2['lName']?> </div>
  <div class="card-body">
    <p class="card-text"> <?php 
echo $rows['contentText']; ?></p>
    
  </div>
  </div>

  <?php 
if($rows['typeId'] == 1){ ?>
<form method="POST" >
  <div class="input-group mb-3">
  <input type="text" class="form-control" name="comment" placeholder="Give a comment" aria-label="Recipient's username" aria-describedby="button-addon2">
  <button class="btn btn-outline-secondary" name="submit" type="submit" id="button-addon2">Share</button>
</div>
</form>
<?php
}
}} 



?>
</div>

</body>
</html>


<?php ?>