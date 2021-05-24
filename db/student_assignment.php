<?php
include('dbConnection.php');

$assigmentId = 1; // elle girdim düzeltilecek
$assignments = "SELECT user.fName, user.lName, assignmentresults.grade 
                    FROM user INNER JOIN assignmentresults ON user.userId = assignmentresults.userId 
                    WHERE assignmentresults.assignmentId = $assigmentId ORDER BY assignmentresults.grade DESC";
$result_assignments = mysqli_query($conn, $assignments);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widt=device-width, inital-scale=1.0">
    <title> Assignments (Student)</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        body {
            color: #404E67;
            background: #F5F7FA;
            font-family: 'Open Sans', sans-serif;
        }

        .table-wrapper {
            width: 700px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 10px;
            margin: 0 0 10px;
        }

        .table-title h2 {
            margin: 6px 0 0;
            font-size: 22px;
        }

        table.table {
            table-layout: fixed;
        }
        input {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            margin-left: 23%;
            margin-bottom: 3%;
            box-sizing: border-box;
        }
        #sendButton {
            width: 15%;
            margin-left: 65%;
        }
    </style>
</head>

<body>
    <?php
    $userId = 6; // elle girdim düzeltilip session ile tutulacak
    $contents = "SELECT * FROM assignmentresults r INNER JOIN assignment a ON r.assignmentId = a.assignmentId
                                                   INNER JOIN content c ON a.contentId = c.contentId
                                                   WHERE r.userId = $userId";
    $result_contents = mysqli_query($conn, $contents);
    while ($row_contents = mysqli_fetch_assoc($result_contents)) {
        $assignmentId = $row_contents['assignmentId'];
        $grade = $row_contents['grade'];
        $deadline = $row_contents['deadline'];
        $responseText = $row_contents['responseText'];
        $responseLink = $row_contents['responseLink'];
        $publishedDate = $row_contents['publishedDate'];
        $contentTitle = $row_contents['contentTitle']; 
        $contentText = $row_contents['contentText'];
        $additionalLink = $row_contents['additionalLink'];
    }
    ?>
    <div class="container">
        <p>
        <h1 align="center">Assignment Details</h1>
        <div id="displaymessage"></div>
        </p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row"><?php echo $publishedDate ?>
                <div class="col-sm-8"><h2><b><?php echo $contentTitle ?></b></h2>
                <h4><?php echo $contentText ?></h4>
                <a href="<?php echo $additionalLink ?>"><?php echo $additionalLink ?></a><br><br>
                <div><h2><b><?php if($grade != null){
                    echo $grade." / 100";
                }else {
                    echo " - / 100"; 
                }
                    ?></b></h2></div>
                </div>
            </div>
            <div class="row"><?php echo "<b>Due Date: </b>".$deadline ?>
            <div class="col-sm-8">
                <br>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <fieldset class="fieldset">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="text" id="responseText" name="responseText" placeholder="Response text"><br><br>
                <input type="text" id="responseLink" name="responseLink" placeholder="Response link">
                <input type="submit" class="btn btn-primary" id="sendButton" name="submit" value="Send"></input>
                    </fieldset>
                </form>  
                </div>
                </div>
                <?php 
                
    if(isset($_POST['submit'])){
        
        $queryString = "SELECT * FROM ((assignmentresults INNER JOIN assignment ON assignmentresults.assignmentId = assignment.assignmentId)
                                                          INNER JOIN content ON assignment.contentId = content.contentId)
                                                          WHERE assignmentresults.userId = $userId";
        $result = mysqli_query($conn,$queryString);
        while ($row_contents = mysqli_fetch_assoc($result)) {
            $resText = $row_contents['responseText'];
            $resLink = $row_contents['responseLink'];
            $assignmentId = $row_contents['assignmentId'];
        }
        if ($resText!='' || $resLink!=''){
            echo "<p class='btn btn-info' align='center'>This assignment is already send.</p>";
           }else{
            $responseText = mysqli_real_escape_string($conn,$_POST['responseText']);
            $responseLink = mysqli_real_escape_string($conn,$_POST['responseLink']);

            $sql = "UPDATE assignment SET responseText = '".$responseText."', responseLink = '".$responseLink."' 
                            WHERE assignmentId = '".$assignmentId."'";
            echo '<script type="text/javascript">console.log("'.$sql.'");</script>';
            if ($conn->query($sql) === TRUE) {
             echo "Assignment delivered successfully";
             $responseText = "";
             $responseLink = "";
            } else {
             echo "Error delivering record: " . $conn->error;
            } 
           }
        
       }
                ?>
                </form>
        </div>
    </div>

</body>

</html>