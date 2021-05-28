
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widt=device-width, inital-scale=1.0">
    <title> Assignments (Admin)</title>

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
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
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
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table th:last-child {
        width: 100px;
    }
    table.table td a {
  cursor: pointer;
        display: inline-block;
        margin: 0 5px;
  min-width: 24px;
    }   
 table.table td a.add {
        color: #27C46B;
    }
    table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #E34724;
    }
    table.table td i {
        font-size: 19px;
    }
 table.table td a.add i {
        font-size: 24px;
     margin-right: -1px;
        position: relative;
        top: 3px;
    }    
    table.table .form-control {
        height: 32px;
        line-height: 32px;
        box-shadow: none;
        border-radius: 2px;
    }
 table.table .form-control.error {
  border-color: #f50000;
 }
 table.table td .add {
  display: none;
 }
 th, td {
    text-align:center;
 }
</style>
<script type="text/javascript">
$(document).ready(function(){
 $('[data-toggle="tooltip"]').tooltip();
 var actions = $("table td:last-child").html();

 // Add row on add button click
 $(document).on("click", ".add", function(){
  var empty = false;
  var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
   if(!$(this).val()){
    $(this).addClass("error");
    empty = true;
   } else{
                $(this).removeClass("error");
            }
  });
  var txtname = $("#txtfName").val();
  var txtdepartment = $("#txtlName").val();
  var txtphone = $("#txtgrade").val();
  $.post("ajax_add.php", { txtfName: txtfName, txtlName: txtlName, txtgrade: txtgrade}, function(data) {
   $("#displaymessage").html(data);
  });
  $(this).parents("tr").find(".error").first().focus();
  if(!empty){
   input.each(function(){
    $(this).parent("td").html($(this).val());
   });   
   $(this).parents("tr").find(".add, .edit").toggle();
   $(".add-new").removeAttr("disabled");
  } 
    });
 // update rec row on edit button click
 $(document).on("click", ".update", function(){
  var id = $(this).attr("id");
  var string = id;
        var txtfName = $("#txtfName").val();
  var txtlName = $("#txtlName").val();
  var txtgrade = $("#txtgrade").val();
  $.post("ajax_update.php", { string: string,txtfName: txtfName, txtlName: txtlName, txtgrade: txtgrade}, function(data) {
   $("#displaymessage").html(data);
  });
    });
 // Edit row on edit button click
 $(document).on("click", ".edit", function(){  
        $(this).parents("tr").find("td:not(:last-child)").each(function(i){
   if (i=='0'){
    var idname = 'txtfName';
   }else if (i=='1'){
    var idname = 'txtlName';
   }else if (i=='2'){
    var idname = 'txtgrade';
   }else{} 
   $(this).html('<input type="text" name="updaterec" id="' + idname + '" class="form-control" value="' + $(this).text() + '">');
  });  
  $(this).parents("tr").find(".add, .edit").toggle();
  $(".add-new").attr("disabled", "disabled");
  $(this).parents("tr").find(".add").removeClass("add").addClass("update");
    });
});
</script> 
</head>
<body>
    <div class="container"><p><h1 align="center">Assignments</h1><div id="displaymessage"></div></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2><b>Grades</b></h2></div>
                </div>
            </div>
   <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php 
include"dbConnection.php"; 
$contentId = ($_GET['contentId']);
$sql_id = "SELECT * FROM assignment WHERE contentId='$contentId'";
$result_id = mysqli_query($conn, $sql_id);
$row_id=mysqli_fetch_assoc($result_id);


$assigmentId = $row_id['assignmentId'];
 // elle girdim düzeltilecek
$assignments = "SELECT user.fName, user.lName,assignmentresults.id, assignmentresults.grade 
                    FROM user INNER JOIN assignmentresults ON user.userId = assignmentresults.userId 
                    WHERE assignmentresults.assignmentId = $assigmentId ORDER BY assignmentresults.grade DESC";
$result_assignments = mysqli_query($conn,$assignments);

while($row_assignments = mysqli_fetch_assoc($result_assignments)) {
 $id=$row_assignments['id']; 
 $fName=$row_assignments['fName']; 
 $lName=$row_assignments['lName']; 
 $grade=$row_assignments['grade']; 
?>
                    <tr>
                        <td><?php echo $fName; ?></td>
                        <td><?php echo $lName; ?></td>
                        <td><?php echo $grade; ?></td>
                        <td>
                            <a class="add" title="Add" data-toggle="tooltip" id="<?php echo $id; ?>"><i class="fa fa-user-plus"></i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip" id="<?php echo $id; ?>"><i class="fa fa-pencil"></i></a>
                        </td>
                    </tr>   
<?php } ?>     
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>