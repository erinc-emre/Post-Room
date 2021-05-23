<?php include('dbConnection.php'); 
session_start();

$id=$_GET['contentId'];
$sql="DELETE FROM content WHERE contentId='$id'" ;
$query=mysqli_query($conn,$sql);
$sql1="SELECT typeId FROM content WHERE contentId='$id'";
$query1 = mysqli_query($conn,$sql1);
$rows = mysqli_fetch_assoc($query1);
if($rows==0){
    $deleteAssing = "DELETE FROM assignment WHERE contentId='$id'";
    if($query=mysqli_query($conn,$deleteAssing)){
        header("Location:contentsOfaRoom.php?roomId=<?php echo $_SESSION['ROOMID']; ?>");
        exit;
    }
}else if($rows ==1){
    $deletePost = "DELETE FROM post WHERE contentId='$id'";
    if($query=mysqli_query($conn,$deletePost)){
        header("Location:contentsOfaRoom.php");
        exit;
}
}


?>