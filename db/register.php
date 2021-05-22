<?php
include('dbConnection.php'); 

?>
<!DOCTYPE html>
<head> 
<title>Register</title>
<style>
  <?php include "register.css";
      ?>
      </style>
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
  $fNameErr = $lNameErr = $emailErr = $passwordErr = $claimPasswordErr = $telephoneErr=$genderErr = "";
  $departmentErr = $instErr = $differentPasswordErr = $telephoneErr2 = $pictureErr =$birthErr= "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fName"])) {
      $fNameErr = "*First name is required.";
    } else {
      $fName = test_input($_POST["fName"]);
    }
    if (empty($_POST["lName"])) {
      $lNameErr = "*Last name is required.";
    } else {
      $lName = test_input($_POST["lName"]);
    }
    if (empty($_POST["email"])) {
      $emailErr = "*Email address is required.";
    } else {
      $email = test_input($_POST["email"]);
    }
    if (empty($_POST["password"])) {
      $passwordErr = "*Password is required.";
    } 
    if (empty($_POST["claimPassword"])) {
      $claimPasswordErr = "*Claim password is required.";
    } 
    if($_POST["password"] != $_POST["claimPassword"]){
      $differentPasswordErr = "*Passwords must be same";
    }else{
      $claimPassword = md5(test_input($_POST["claimPassword"]));
      $password = md5(test_input($_POST["password"]));
    }
    if (empty($_POST["telephone"])) {
      $telephoneErr = "*Phone number is required.";
    } else if (!filter_var($_POST["telephone"], FILTER_VALIDATE_INT)) {
      $telephoneErr2 = "Phone number should be a number.";
    }else {
      $telephone = test_input($_POST["telephone"]);
    }
    if (empty($_POST["department"])) {
      $departmentErr = "*Department is required.";
    } else {
      $department = test_input($_POST["department"]);
    }
    if (empty($_POST["institution"])) {
      $instErr = "*Institution is required.";
    } else {
      $inst = test_input($_POST["institution"]);
    }
    if (empty($_POST["picture"])) {
      $pictureErr = "*Picture is required.";
    } 
    if (empty($_POST["gender"]) && empty($_POST["gender2"]) && empty($_POST["gender3"])) {
      $genderErr = "*Gender is required.";
    } else if(empty($_POST["gender"]) && empty($_POST["gender2"])) {
      $gender = test_input($_POST["gender3"]);
    }else if(empty($_POST["gender"]) && empty($_POST["gender3"])) {
      $gender = test_input($_POST["gender2"]);
    }else if(empty($_POST["gender3"]) && empty($_POST["gender2"])) {
      $gender = test_input($_POST["gender1"]);
    }
    if (empty($_POST["birth"])) {
      $birthErr = "*Date of birth is required.";
    } else {
      $birth = test_input($_POST["birth"]);
    }

  }
  $fileName = $_FILES['fileName']['picture'];
  $picture = file_get_contents($fileName);
  $status = "member";
  date_default_timezone_set('Europe/Istanbul');
  $registerDate = date("Y-m-d h:i:sa");
  
  $stmt = $conn->prepare("INSERT INTO user(fName,lName,email,phone,password,sex,registerDate,status,profilePhoto, institution, department, DOB) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
  
  if ($stmt != false) {
    $stmt->bind_param('ssssssssssss',$fName, $lName, $email, $telephone, $password,$gender,$registerDate, $status, $picture, $inst, $department, $birth);
    if($stmt->execute()){
      ?> <p class="success"><?php echo "Registiration successful"; ?></p> <?php
   }else{
      ?> <p class="fail"><?php echo "Registiration failed"; ?></p> <?php
   }
    $stmt->close();
  } else {
    die('prepare() failed: ' . htmlspecialchars($conn->error));
  }

  ?>


<div class="container">
<br>
<h1 >SIGN UP</h1>

<form method="POST" enctype="multipart/form-data">
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">First Name</label>
  <textarea class="form-control" name="fName" rows="1" required></textarea>
  <span class="error"> <?php echo $fNameErr; ?></span>
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Last Name</label>
  <textarea class="form-control" name="lName" rows="1"></textarea>
  <span class="error"> <?php echo $lNameErr; ?></span>
</div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    <span class="error"> <?php echo $emailErr; ?></span>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
    <span class="error"> <?php echo $passwordErr; ?></span>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Claim Password</label>
    <input type="password" class="form-control" name="claimPassword">
    <span class="error"> <?php echo $claimPasswordErr; ?></span>
    <span class="error"> <?php echo $differentPasswordErr; ?></span>
  </div>

  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Phone Number</label>
    <textarea class="form-control" value="1-(555)-555-5555" name="telephone" rows="1"></textarea>
    <span class="error"> <?php echo $telephoneErr; ?></span>
    <span class="error"> <?php echo $telephoneErr2; ?></span>
  </div>
  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Department</label>
  <textarea class="form-control" name="department" rows="1"></textarea>
  <span class="error"> <?php echo $departmentErr; ?></span>
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Institution</label>
  <textarea class="form-control" name="institution" rows="1"></textarea>
  <span class="error"> <?php echo $instErr; ?></span>
</div>
 
  <div class="mb-3">
  <label for="formFile" class="form-label">Pick a profile picture</label>
  <input class="form-control" type="file" placeholder="Name" name="picture" required><br><br>
    <input name="fileName" type="file" class="form-control-file" id="exampleFormControlFile1" ><br><br>
  <span class="error"> <?php echo $pictureErr; ?></span>
</div>
<div class="exampleFormControlTextarea1">
  <label for="example-date-input" class="form-label">Date of birth</label>
  <span class="error"> <?php echo $birthErr; ?></span>
  <div class="col-10">
    <input class="form-control" type="date" value="2021-01-01" name="birth">
  </div>
</div>
<br>
<label for="exampleFormControlTextarea1" class="form-label">Gender</label>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" name="gender">
  <label class="form-check-label" for="flexRadioDefault1">
    Female
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" name="gender2" >
  <label class="form-check-label" for="flexRadioDefault2">
   Male
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" name="gender3" >
  <label class="form-check-label" for="flexRadioDefault2">
   I do not want to say
  </label>
  <span class="error"> <?php echo $genderErr; ?></span>
</div>

</div>

<br>

  <button type="submit" class="btn btn-primary">Sign Up</button>
  <br><br>
  <a href="login.php">Do you have an account? Click here to sign in.</a>

</form>
</div>
  
</div>

</body>
</html>