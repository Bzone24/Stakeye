<?php
include "header.php";
?>
  <div class='content-wrapper'>
    <div class='content-header'>
      <div class='container-fluid'>
        <div class='row mb-2'>
          <div class='col-sm-6'>
            <h1 class='m-0 text-dark'>Manage Guess</h1>
          </div><!-- /.col -->
         <div class='col-sm-6'>
            <ol class='breadcrumb float-sm-right'>
              <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
              <li class='breadcrumb-item active'>Manage Guess</li>
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
<br>
<?php
$stmt1 = $db->query("select ID, NAME from GAMES;");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$game=$row1['NAME'] ?? '';
$id=$row1['ID'] ?? '';
$open1="";$open2="";$open3="";$open4="";$jodi1="";$jodi2="";$jodi3="";$jodi4="";$jodi5="";$jodi6="";$jodi7="";$jodi8="";$patti1="";$patti2="";$patti3="";$patti4="";
$stmt2 = $db->query("select ID, FIRST, SECOND, THIRD, FORTH from FREE_GAME where GAME_ID='$id' and WHICH_ONE='OPEN';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$open1=$row2['FIRST'] ?? '';
$open2=$row2['SECOND'] ?? '';
$open3=$row2['THIRD'] ?? '';
$open4=$row2['FORTH'] ?? '';
}
$stmt2 = $db->query("select ID, FIRST, SECOND, THIRD, FORTH, FIFTH, SIXTH, SEVEN, EIGHT from FREE_GAME where GAME_ID='$id' and  WHICH_ONE='JODI';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$jodi1=$row2['FIRST'] ?? '';
$jodi2=$row2['SECOND'] ?? '';
$jodi3=$row2['THIRD'] ?? '';
$jodi4=$row2['FORTH'] ?? '';
}
$stmt2 = $db->query("select ID, FIRST, SECOND, THIRD, FORTH from FREE_GAME where GAME_ID='$id' and  WHICH_ONE='PATTI';");
while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
{
$patti1=$row2['FIRST'] ?? '';
$patti2=$row2['SECOND'] ?? '';
$patti3=$row2['THIRD'] ?? '';
$patti4=$row2['FORTH'] ?? '';
}
echo "<div class='col-lg-12'>";
echo "$game<br>
</div>
<div class='col-lg-3'>
<form class='container'  method='POST' action='guess_check.php'>
<input type='hidden' name='id' value='$id'>
<input type='number' name='open1' value='$open1' placeholder='Andar' class='form-control'><br>
</div>
<div class='col-lg-3'>
<input type='number' name='open2' value='$open2' placeholder='Andar' class='form-control'><br>
</div>
<div class='col-lg-3'>
<input type='number' name='open3' value='$open3' placeholder='Andar' class='form-control'><br>
</div>
<div class='col-lg-3'>
<input type='number' name='open4' value='$open4' placeholder='Andar' class='form-control'><br>
</div>
<br>
<div class='col-lg-3'>
<input type='number' name='jodi1' value='$jodi1' placeholder='Jodi' class='form-control'><br>
</div>
<div class='col-lg-3'>
<input type='number' name='jodi2' value='$jodi2' placeholder='Jodi' class='form-control'><br>
</div>
<div class='col-lg-3'>
<input type='number' name='jodi3' value='$jodi3' placeholder='Jodi' class='form-control'><br>
</div>
<div class='col-lg-3'>
<input type='number' name='jodi4' value='$jodi4' placeholder='Jodi' class='form-control'><br>
</div>
<br>
<div class='col-lg-3'>
<input type='number' name='patti1' value='$patti1' placeholder='Bahar' class='form-control'><br>
</div>
<div class='col-lg-3'>
<input type='number' name='patti2' value='$patti2' placeholder='Bahar' class='form-control'><br>
</div>
<div class='col-lg-3'>
<input type='number' name='patti3' value='$patti3' placeholder='Bahar' class='form-control'><br>
</div>
<div class='col-lg-3'>
<input type='number' name='patti4' value='$patti4' placeholder='Bahar' class='form-control'><br>
</div>
";
echo "<div class='col-lg-12'>";
echo "<input type='submit' value='Update' class='btn btn-primary'>";
echo "</div>";
echo "<div class='col-lg-12'>";
echo "</form><br>";
echo "</div>";
}
?>
</div></section></div>
<?php
include "footer.php";
?>
