<?php
include "header.php";
$user_id=$_SESSION['USER_ID'] ?? '';
$game_name=$_GET['game_name'] ?? '';
$date1=$_GET['from_date'] ?? '';
$date2=$_GET['to_date'] ?? '';
if($date1=="" || $date2==""){
$date1=date("Y-m-d");
$date2=date("Y-m-d");
}
$stmt1 = $db->query("select ID, NAME from GAMES where PAGE='$game_name';");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$game_id=$row1['ID'] ?? '';
$game=$row1['NAME'] ?? '';
}
?>

<div class="container-fluid">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<center><h2><?php echo @$game;?> Chart</h2></center>
</div>
</div>
<div class="row">
<div class="col-lg-3 col-xs-6">
<form>
<input type='hidden' name='game_name' value="<?php echo $game_name;?>">
<input type='date' name='from_date' value="<?php echo $date1;?>" class='form-control'>
</div>
<div class="col-lg-3 col-xs-6">
<input type='date' name='to_date' value="<?php echo $date2;?>" class='form-control'>
</div>
<div class="col-lg-3 col-xs-6">
<input type='submit' value='Submit' class='btn btn-danger'>
</form>
</div>
</div>
<br><br>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="time-table">
<table>
<tr>
<th>DATE</th>
<th>RESULT</th>
</tr>
<?php
$stmt1 = $db->query("select RESULT1, DATE_FORMAT(DATE, '%d/%M/%Y') as DATE1 from RESULT where GAME_ID='$game_id' and DATE >= '$date1' and DATE <= '$date2' order by DATE;");
while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
{
$date=$row1['DATE1'] ?? '';
$result1=$row1['RESULT1'] ?? '';
if($result1==""){
$result1="**";
}
echo "<tr>
<td>$date</td>
<td>$result1</td>
</tr>";	
}
?>
</table>
<br><br><br>
</div>
</div>
</div>
</div>
</div>

<?php
include "footer.php";
?>
