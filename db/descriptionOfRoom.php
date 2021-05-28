<?php include('dbConnection.php'); 
session_start();
 ?>
<!DOCTYPE html>
<?php 
//$id = intval($_GET['roomId']);
$result=mysqli_query($conn,"SELECT * FROM content");
$rows=mysqli_fetch_assoc($result);
$roomID = $_SESSION['ROOMID'];
$result3 = mysqli_query($conn,"SELECT * FROM room WHERE roomId = $roomID");
$rows3=mysqli_fetch_assoc($result3);
?>
<head> 
<title>Description of the room</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
<ul class="nav nav-tabs">

<li class="nav-item">
    <a class="nav-link" aria-current="page" href="contentsOfaRoom.php?roomId=<?php echo $_SESSION['ROOMID']; ?>"><?php echo $_SESSION['ROOMID'] ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="descriptionOfRoom.php">Description of the room</a>
  </li>
  <?php    if($_SESSION['loginId'] == $rows3['roomOwnerId']){ ?>
  <li class="nav-item">
    <a class="nav-link" href="addAnAssign.php">Add a new assignment</a>
  </li>
  <?php } ?>
  <li class="nav-item">
    <a class="nav-link" href="addApost.php">Add a new post</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="logout.php">Logout</a>
  </li>
  </ul>
<br>
<h5><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($rows3['roomPhoto']) . '" style="height:150px;width:150px;" id="image"/>'; ?></h5>
<h5 id="name">Room name: <?php echo $rows3['roomName'] ?></h5>
<h5 id="desc" >Room description: <?php echo $rows3['description'] ?></h5>
<h5 id="date" >Launch date: <?php echo $rows3['launchDate'] ?></h5>
<h5 id="code" >Sharable code: <?php echo $rows3['sharebleCode'] ?></h5>



</div>

</body>
</html>