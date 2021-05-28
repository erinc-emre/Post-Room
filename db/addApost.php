<?php include('dbConnection.php'); 
session_start();
 ?>
<!DOCTYPE html>
<?php 
//$id = intval($_GET['roomId']);
$result=mysqli_query($conn,"SELECT * FROM content");
$rows=mysqli_fetch_assoc($result);
$roomID =$_SESSION['ROOMID'];
$result3 = mysqli_query($conn,"SELECT * FROM room WHERE roomId = $roomID");
$rows3=mysqli_fetch_assoc($result3);
?>
<head> 
<title>Add a new post</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>
<body>
<?php
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
} 
$titleErr = $descErr = "";
if (isset($_POST['submit']) ) {
    if (empty($_POST["title"])) {
      $titleErr = "*Title is required.";
    } else {
      $title = test_input($_POST["title"]);
    }
    if (empty($_POST["desc"])) {
      $descErr = "*Description is required.";
    } else {
      $desc = test_input($_POST["desc"]);
    }
    if (empty($_POST["link"])) {
      $link = "";
    } else {
      $link = test_input($_POST["link"]);
    }

    $sql="SELECT contentId FROM content ORDER BY contentId DESC LIMIT 1";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
     
    date_default_timezone_set('Europe/Istanbul');
    $publishedDate = date("Y-m-d h:i:sa");
    $roomID = $rows3['roomId'];
    $postOwnerId=$_SESSION['loginId'] ;
    $typeId=1;
    $null = " ";
    $contentId = 1 +$row['contentId'];

    $stmt = $conn->prepare("INSERT INTO content(roomId,publishedDate,contentTitle,contentText,additionalLink,postOwnerId,typeId) VALUES (?,?,?,?,?,?,?)");
  $stmt2 = $conn->prepare("INSERT INTO post(contentId) VALUES (?)");
  if ($stmt != false ) {
    if($stmt2 != false){
    $stmt->bind_param('sssssss',$roomID, $publishedDate, $title, $desc, $link,$postOwnerId,$typeId);
    $stmt2->bind_param('s', $contentId);
    if($stmt->execute()){
      if($stmt2->execute()){
      ?> <p class="success"><?php echo " successful"; ?></p> <?php
   }}else{
      ?> <p class="fail"><?php echo " failed"; ?></p> <?php
   }
  }
    $stmt->close();
    $stmt2->close();
  } else {
    die('prepare() failed: ' . htmlspecialchars($conn->error));
  }

}

?>

<div class="container">
<ul class="nav nav-tabs">

<li class="nav-item">
    <a class="nav-link" aria-current="page" href="contentsOfaRoom.php?roomId=<?php echo $_SESSION['ROOMID']; ?>"><?php echo $_SESSION['ROOMID'] ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="descriptionOfRoom.php">Description of the room</a>
  </li>
  <?php    if($_SESSION['loginId'] == $rows3['roomOwnerId']){ ?>
  <li class="nav-item">
    <a class="nav-link" href="addAnAssign.php">Add a new assignment</a>
  </li>
  <?php } ?>
  <li class="nav-item">
    <a class="nav-link active" href="addApost.php">Add a new post</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="logout.php">Logout</a>
  </li>
  </ul>

  <br><br>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" >
  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Title</label>
  <textarea class="form-control" name="title" rows="1"></textarea>
  
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Description</label>
  <textarea class="form-control" name="desc" rows="3"></textarea>
 
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Additional Link</label>
  <textarea class="form-control" name="link" rows="1"></textarea>

</div>
<br>
<button id="button" type="submit" name= "submit" class="btn btn-primary">Submit</button>
</form>

</div>

</body>
</html>