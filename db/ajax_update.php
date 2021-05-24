<?php
include"dbConnection.php"; 
$string  = $_POST['string'];
$txtfName  = $_POST['txtfName'];
$txtlName  = $_POST['txtlName'];
$txtgrade  = $_POST['txtgrade'];
if ($txtfName==''){
 echo "<p class='btn btn-info' align='center'>Please Insert YOUr name</p>";
}else{
 $sql = "UPDATE assignmentresults SET grade='$txtgrade'WHERE id = '$string' ";
 if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
 } else {
  echo "Error updating record: " . $conn->error;
 } 
}
?>     