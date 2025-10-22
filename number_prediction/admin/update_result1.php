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
              <li class='breadcrumb-item active'>Update Result</li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class='content'>
      <div class='container-fluid'>
        <div class='row'>
<?php
$id=$_POST['id'] ?? '';
$date=$_POST['date'] ?? '';
$stmt1 = $db->query("select NAME from GAMES where ID='$id';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$game=$row1['NAME'] ?? '';
}
$stmt1 = $db->query("select ID, RESULT1, RESULT2 from RESULT where GAME_ID='$id' and DATE='$date';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$result1=$row1['RESULT1'] ?? '';
$result2=$row1['RESULT2'] ?? '';
$r_id=$row1['ID'] ?? '';
}
?>
<div class='col-lg-12'>
<form method="post" action='result_check1.php'>
<?php
$date1=date("d/m/Y", strtotime($date));
echo "<input type='hidden' name='id' value='$id'>
<input type='hidden' name='date' value='$date'>
<input type='hidden' name='r_id' value='$r_id'>
<h4>$game (Result of $date1)</h4>";
?>
</div>
<div class='col-lg-6'>
<b>Result 1</b>
<input class="form-control" type="number" min='0' name="result1" value="<?php echo $result1; ?>" placeholder='Result 1' />
<br>
</div>
<div class='col-lg-6'>
<b>Result 2</b>
<input class="form-control" type="number" min='0' name="result2" value="<?php echo $result2; ?>" placeholder='Result 2' />
<br>
</div>
<div class='col-lg-l2'>
<input class="btn btn-primary" type="submit" value="Update">
</form>
</div>

</div>
</section>
</div>
<?php
include "footer.php";
?>
