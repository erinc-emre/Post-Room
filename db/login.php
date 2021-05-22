<?php include('dbConnection.php'); 
session_start();
 ?>

<!DOCTYPE html>
<head> 
<style>
<?php include "register.css"
?>
</style>
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>
<body>
<?php 
  $unameErr = $pwdErr = "";

  if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["email"]) || empty($_POST["password"])){
   echo "All fields are required.";
    }
    else{
          $email =$_REQUEST['email'];
          $password = md5($_REQUEST['password']);
          $sql="SELECT * FROM user ";
          $result= mysqli_query($conn,$sql);
         
        if(mysqli_num_rows($result) !=0){
         
         while( $row=mysqli_fetch_assoc($result)){
              $dbEmail = $row['email'];
              $dbPassword = $row['password'];
              
         
              if($email == $dbEmail && $password == $dbPassword){
  
                $_SESSION['email']= $dbEmail;
                $_SESSION['password']= $dbPassword;
               
                $_SESSION['loggedIn'] = true;
  
                  header("Location: homepage_rooms.php");  
                  
                }
          }
        
          if("Location: login.php"){
              echo "Invalid username or password.";
          }
        }
     }
      }  
  
?>
<div class="container">
<br>
<h1 >SIGN IN</h1>
<form method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>

  <button type="submit" class="btn btn-primary">Sign In</button>
  <br><br>
  <a href="register.php">Don't you have an account? Click here to sign up.</a>
</form>

</body>
</html>

