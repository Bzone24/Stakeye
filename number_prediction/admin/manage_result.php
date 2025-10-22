<?php
include "header.php";
?>
  <div class='content-wrapper'>
    <div class='content-header'>
      <div class='container-fluid'>
        <div class='row mb-2'>
          <div class='col-sm-6'>
            <h1 class='m-0 text-dark'>Manage Result</h1>
          </div><!-- /.col -->
         <div class='col-sm-6'>
            <ol class='breadcrumb float-sm-right'>
              <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
              <li class='breadcrumb-item active'>Manage Result</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class='content'>
      <div class='container-fluid'>
        <div class='row'>
<?php
$msg=$_GET['msg'] ?? '';
if($msg!=""){
echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> $msg !</div>";
}
?>
<div class='col-lg-12'>
<a href='edit_result.php' class='btn btn-primary'>Add result</a>
</div>
<br>
<br>
<div class='col-lg-12'>
<table border='1' style='width:100%;'>
<tr style='background-color:blue;color:white;text-align:center;'><td>Game</td><td>Result</td><td>Today's<br>Result</td><td>Old<br>Result</td></tr>
<?php
$stmt1 = $db->query("select ID, NAME from GAMES order by TIME1;");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$id=$row1['ID'] ?? '';
$name=$row1['NAME'] ?? '';
$result1="";
$result2="";
$stmt2 = $db->query("select RESULT1 from RESULT where DATE=CURDATE() and GAME_ID='$id';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$result1=$row2['RESULT1'] ?? '';
}
echo "<tr><td>$name</td><td>$result1</td><td style='text-align:center;'><a href='edit_result.php?id=$id'><i class='fa fa-pen'></i></a></td><td style='text-align:center;'><a href='update_result.php?id=$id'><i class='fa fa-pen'></i></a></td></tr>";
}
?>
</table>
<br>
</div>
<br><br>
</div>
</section>
</div>
<?php
include "footer.php";
?>
