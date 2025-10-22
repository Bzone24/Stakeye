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
              <li class='breadcrumb-item'><a href='manage_result.php'>Manage Result</a></li>
              <li class='breadcrumb-item active'>Edit Result</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class='content'>
      <div class='container-fluid'>
        <div class='row'>

<?php
$id=$_GET['id'] ?? '';
if(is_numeric($id)){
$stmt1 = $db->query("select NAME from GAMES where ID='$id';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$game=$row1['NAME'] ?? '';
}
$stmt1 = $db->query("select ID, RESULT1, REMARK from RESULT where GAME_ID='$id' and DATE=CURDATE();");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$result1=$row1['RESULT1'] ?? '';
$r_id=$row1['ID'] ?? '';
$text=$row1['REMARK'] ?? '';
}
}
?>
<br>
<div class='col-lg-2'>
<form method="post" action='result_check.php'>
<b>Game</b>
<?php
echo "<select name='id' class='form-control select2' onchange=\"window.location='?id='+this.value+'&pos='+this.selectedIndex\" required>";
if($id==""){
echo "<option value='' disabled selected>Select Game</option>";
}else{
$stmt1 = $db->query("select ID, NAME from GAMES where ID='$id';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$game=$row1['NAME'] ?? '';
echo "<option value='$id'>$game</option>";
}
}
$stmt1 = $db->query("select ID, NAME from GAMES where ID!='$id';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$game=$row1['NAME'] ?? '';
$new_id=$row1['ID'] ?? '';
echo "<option value='$new_id'>$game</option>";
}
echo "</select>
<input type='hidden' name='r_id' value='$r_id'>
</div>";
?>
<div class='col-lg-2'>
<b>Result 1</b>
<select name='result1' class="form-control select2" required>
<?php
if($result1!=""){
echo "<option value='$result1'>$result1</option>";
}else{
echo "<option value='' disabled selected>Result 1</option>";
}
$stmt1 = $db->query("select OPEN_CLOSE_PATTI from OPEN_CLOSE_PATTI where OPEN_CLOSE_PATTI!='$result1' order by OPEN_CLOSE_PATTI;");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$new_result=$row1['OPEN_CLOSE_PATTI'] ?? '';
echo "<option value='$new_result'>$new_result</option>";
}
?>
</select>
<br>
</div>
</div>
<div class='row'>
<div class='col-lg-4'>
<input class="btn btn-success" type="submit" value="Update" />
</form>
</div>

</div>
</section>
</div>
<?php
include "footer.php";
?>
